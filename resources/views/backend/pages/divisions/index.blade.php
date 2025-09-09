@extends('backend.index')
@section('content')
@extends('backend.index')
@section('content')


      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Divisions Table</h3><br>
                <button class="btn btn-primary btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>


                <!--Product store modal-->


                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add New Division</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.division.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                               <label for="exampleInputPassword1">Division</label>
                               <input type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{old('division')}}" required>


                                @error('division')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                            
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Division Name</th>

                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  	@foreach(App\Models\Division::get() as $division)
                  	<tr>
                  		<td>{{$division->id}}</td>
                  		<td>{{$division->name}}</td>
                  		<td>
            <a id="delete" href="{{route('admin.division.delete',$division->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>
                  		</td>
                  	</tr>
                  	@endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

    <!-- /.content -->   

@endsection
@endsection