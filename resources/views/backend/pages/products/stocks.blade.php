@extends('backend.index')
@section('content')
	<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($data as $stock)
                  	<tr>
                  		<td>{{$stock->id}}</td>
                  		<td>{{$stock->product->title}}</td>
                  		<td>{{$stock->color->color}}</td>
                  		<td>{{$stock->size->size}}</td>
                  		<td>{{$stock->quantity}}</td>
                  		<td>
  <a data-toggle="modal" data-target="#modal-default1{{$stock->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
  </svg></a><a id="delete" href="{{route('admin.stock.delete',['id'=> $stock->id,'identity' => $stock->identity])}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a></td>
    <!--edit stock modal-->
      <div class="modal fade" id="modal-default1{{$stock->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Stock</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>{{$stock->title}}</h2></div>
                 <div class="card-body">
          <div class="container">
            <form action="{{route('admin.stock.update',$stock->id)}}" method="Post" enctype="multipart/form-data">
                            @csrf
                             <div class="form-group">
                               <label for="exampleInputPassword1">Quantity</label>
                               <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{$stock->quantity}}" name="stock_quantity" >

                               @error('stock_quantity')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                        
                           <strong>Color:</strong><span>{{$stock->color->color}}</span><br>                                
                           <strong>Size:</strong><span>{{$stock->size->size}}</span><br>
                             <button type="submit" class="btn btn-success btn-block">Update</button>
                           </form>
          </div>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
         
                  	</tr>
                  	@endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
@endsection