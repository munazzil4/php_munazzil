@extends('sales.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sales Team</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('sales.create') }}"> Create New Sale Person</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Current Route</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($sales as $sale)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $sale->name }}</td>
            <td>{{ $sale->email }}</td>
            <td>{{ $sale->phone }}</td>
            <td>{{ $sale->route }}</td>
            <td>
                <form action="{{ route('sales.destroy',$sale->id) }}" method="POST">
   
                   
                    <a class="btn btn-success" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                                data-attr="{{ route('sales.show', $sale->id) }}" title="show">View
                                
                    </a>
                  
    
                    <a class="btn btn-primary" href="{{ route('sales.edit',$sale->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $sales->links() !!}

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    </script>
      
@endsection

