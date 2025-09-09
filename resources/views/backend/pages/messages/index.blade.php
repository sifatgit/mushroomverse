@extends('backend.index')
@section('content')

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Messages Table</h3><br>
                



              </div>

              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Seen</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($data as $message)
                    <tr  data-id="{{$message->id}}">
                      <td>{{$message->id}}</td>                           
                        <td>{{$message->ip_address}}</td>                                          
                        <td>{{$message->name}}</td>                                          
                        <td>{{$message->email}}</td>                                          
                        <td>{{$message->subject}}</td>                                          
                        <td>{{$message->message}}</td>                                          
                        <td>{{$message->created_at}}</td>                                          
                        <td id="seen_row{{$message->id}}" >@if($message->seen == 1)<p class="bg-success text-white">Yes</p>@else <p class="bg-warning text-white">No</p> @endif</td>                                          
                      <td>
        


        <a id="delete" href="{{route('admin.message.delete',$message->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>

              <a data-id="{{$message->id}}" data-toggle="modal" data-target="#modal-default2{{$message->id}}" href="" class="seen"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
                    <!--message view modal-->
      <div class="modal fade" id="modal-default2{{$message->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Message</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>{{$message->subject}}</h2></div>
                 <div class="card-body">
                
                   <p>{{$message->message}}</p>
                 </div>
                 <div class="card-footer"><p>From:{{$message->name}}</p><br>
                  <p>Email:{{$message->email}}</p><br></div>
                  <p>Date:{{$message->created_at}}</p><br></div>
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