@extends('backend.index')
@section('content')
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories Table</h3><br>
                <button class="btn btn-success btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>


                <!--category store modal-->


                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Add New category</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
                           <form action="{{route('category.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                               <label for="exampleInputPassword1">Name</label>
                               <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>


                                @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>
                             
                             <div class="form-group">
                               <label for="exampleInputPassword1">Image</label>
                               <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  required >

                               @error('image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>


                             

                            <div class="form-group">
                               <label>Description</label>
                               <textarea name="description" class="form-control @error('description') is-invalid @enderror" required></textarea>


                                @error('description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>                 
                        
                              <div class="form-group">
                               <label for="exampleInputPassword1">Type</label>
                               <input type="number" class="form-control @error('type') is-invalid @enderror" name="type"  required >

                               @error('type')
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>

                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($data as $category)
                    <tr>
                      <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>                      
                        <td><img src="{{URL::to($category->image)}}" style="width:200px; height:150px;"></td>                      
                        <td>{{$category->description}}</td>                     
     

                      <td><a data-toggle="modal" data-target="#modal-default1{{$category->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
    <!--category update modal-->
      <div class="modal fade" id="modal-default1{{$category->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <form action="{{route('category.update',$category->id)}}" method="Post" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                   <label for="exampleInputPassword1">Name</label>
                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{$category->name}}">


                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                 </div>
                 
                 <div class="form-group">
                   <label for="exampleInputPassword1">Image</label>

                   @if($category->image)
                   Old Image: <img src="{{URL::to($category->image)}}" style="width:200px; height:150px;">
                   <input type="hidden" name="old_photo" value="{{$category->image}}">
                   @else
                   (No old Image available)
                   @endif
                   <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  >

                   @error('image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                 </div>


                 

                <div class="form-group">
                   <label>Description</label>
                   <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{$category->description}}</textarea>


                    @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                 </div>                 

                 

                   
                  <input type="hidden" name="data" value="categories">
          
                 <button type="submit" class="btn btn-success btn-block">Update</button>
               </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

        


        <a id="delete" href="{{route('category.delete',['id'=> $category->id])}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>
        
             

  <a data-toggle="modal" data-target="#modal-default2{{$category->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--category view modal-->
      <div class="modal fade" id="modal-default2{{$category->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header">{{$category->name}}</div>
                 <div class="card-body">
                  <img src="{{URL::to($category->image)}}" style="width:400px; height: 350px;"><br>
                   <p class="card-footer">{{$category->description}}</p>
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 

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