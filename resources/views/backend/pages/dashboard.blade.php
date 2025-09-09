@extends('backend.index')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          </div>
          <!-- ./col -->

          @php $auth = Auth::user(); @endphp
          @if($auth && $auth->super_admin == 1)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h6>Add New Admin<sup style="font-size: 20px"></sup></h6>

                
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default1">Add <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
          
          
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->






@endsection

                


                <!-- Canned Mushroom Product store modal-->


                  <div class="modal fade" id="modal-default1">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add new admin</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('register')}}" method="Post" enctype="multipart/form-data">
                            @csrf

                             <div class="form-group">
                               <label>Name</label>
                               <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required autocomplete="name"> 

                               @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>                            

                             <div class="form-group">
                               <label>Email</label>
                               <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required autocomplete="username">

                               @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             <div class="form-group">
                               <label>Password</label>
                               <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">

                               @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>                                                                         <div class="form-group">
                               <label>Confirm Password</label>
                               <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password" >

                               @error('password_confirmation')
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

                                                