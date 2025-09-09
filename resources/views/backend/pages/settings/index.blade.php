@extends('backend.index')
@section('content') 

      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h2>Settng</h2>
                @php $data = App\Models\Setting::first(); @endphp
                @if(is_null($data))
                <button class="btn btn-primary btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New Setting</button>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add New product</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
<form action="{{route('admin.setting.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Title" value="" required>

                    @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="exampleInputFile" required>

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                        @error('logo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">About us headline</label>
                    <textarea name="about_us_headline" class="form-control @error('about_us_headline') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" ></textarea>

                    @error('about_us_headline')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>


                  
                  <div class="form-group">
                    <label for="exampleInputFile">About us image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="about_us_image" class="custom-file-input @error('about_us_image') is-invalid @enderror" id="exampleInputFile">

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                        @error('about_us_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">About us description</label>
                    <textarea name="about_us_description" class="form-control @error('about_us_description') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" ></textarea>

                    @error('about_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact us description</label>
                    <textarea name="contact_us_description" class="form-control @error('contact_us_description') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" ></textarea>

                    @error('contact_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>                  

                  <div class="form-group">
                    <label for="examplephoneno">Phone No</label>
                    <input type="tel" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" required>
                  

                    @error('phone_no')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror                  
                    </div>

                  <div class="form-group">
                    <label for="examplephoneno">Phone No</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                  

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror                  
                    </div>

                    <div class="form-group">
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" required></textarea>

                    @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                    <textarea name="terms_conditions" class="form-control @error('terms_conditions') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter address" required></textarea>

                    @error('terms_conditions')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>


                    <div class="form-group">
                      <label>Privacy Policy</label>
                    <textarea name="privacy_policy" class="form-control @error('privacy_policy') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter privacy policy" required></textarea>

                    @error('privacy_policy')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>

                    <div class="form-group">
                      <label>Delivery Information</label>
                    <textarea name="delivery_information" class="form-control @error('delivery_information') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter delivery information" required></textarea>

                    @error('delivery_information')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>                                                            



                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Map link</label>
                    <input type="url" name="google_map_link" class="form-control @error('google_map_link') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter google map link" value="">

                    @error('google_map_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Plus link</label>
                    <input type="url" name="googleplus_address" class="form-control @error('googleplus_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter googleplus link" value="">

                    @error('googleplus_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook Address</label>
                    <input type="url" name="facebook_address" class="form-control @error('facebook_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter facebook address" value="">

                    @error('facebook_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram address</label>
                    <input type="url" name="instagram_address" class="form-control @error('instagram_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter instagram address" value="">

                    @error('instagram_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Twitter address</label>
                    <input type="url" name="twitter_address" class="form-control @error('twitter_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="">

                    @error('twitter_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pinterest address</label>
                    <input type="url" name="pinterest_address" class="form-control @error('pinterest_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="">

                    @error('pinterest_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">WhatsApp address</label>
                    <input type="url" name="whatsapp_address" class="form-control @error('whatsapp_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="">

                    @error('whatsapp_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>                                                                       
                                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">save</button>
                </div>
              </form>
                           
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                @endif
              </div>

              <!-- /.card-header -->
              <!--Setting Update Form -->
              <div class="card-body">
                @if($data)
               <form action="{{route('admin.setting.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Site Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Title" value="{{$data->title}}" required>

                    @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Current Logo</label><br>
                    <img src="{{URL::to($data->logo)}}" style="width: 60px; height: 50px;">
                    <input type="hidden" name="old_photo" value="{{$data->logo}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="exampleInputFile" required>

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                        @error('logo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">About us headline</label>
                    <textarea name="about_us_headline" class="form-control @error('about_us_headline') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" >{{$data->about_us_headline}}</textarea>

                    @error('about_us_headline')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>


                  <div class="form-group">
                    <label for="exampleInputFile">Current About us image</label><br>
                    <img src="{{URL::to($data->about_us_image)}}" style="width: 60px; height: 50px;">
                    <input type="hidden" name="old_about_us_image" value="{{$data->about_us_image}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">About us image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        
                        <input type="file" name="about_us_image" class="custom-file-input @error('about_us_image') is-invalid @enderror" id="exampleInputFile" >

                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                        @error('about_us_image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">About us description</label>
                    <textarea name="about_us_description" class="form-control @error('about_us_description') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" >{{$data->about_us_description}}</textarea>

                    @error('about_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact us description</label>
                    <textarea name="contact_us_description" class="form-control @error('contact_us_description') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" >{{$data->contact_us_description}}</textarea>

                    @error('contact_us_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>                  

                  <div class="form-group">
                    <label for="examplephoneno">Phone No</label>
                    <input type="tel" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" value="{{$data->phone_no}}" required>
                  

                    @error('phone_no')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror                  
                    </div>

                  <div class="form-group">
                    <label for="examplephoneno">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$data->email}}" required>
                  

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror                  
                    </div>

                    <div class="form-group">
                      <label>Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter returns" required>{{$data->address}}</textarea>

                    @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>
                    <div class="form-group">
                      <label>Terms & Conditions</label>
                    <textarea name="terms_conditions" class="form-control @error('terms_conditions') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter address" required>{{$data->terms_conditions}}</textarea>

                    @error('terms_conditions')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>


                    <div class="form-group">
                      <label>Privacy policy</label>
                    <textarea name="privacy_policy" class="form-control @error('privacy_policy') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter privacy policy" required>{{$data->privacy_policy}}</textarea>

                    @error('privacy_policy')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>

                    <div class="form-group">
                      <label>Delivery Information</label>
                    <textarea name="delivery_information" class="form-control @error('delivery_information') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter delivery information" required>{{$data->delivery_information}}</textarea>

                    @error('delivery_information')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                    </div>                                                            



                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Map link</label>
                    <input type="url" name="google_map_link" class="form-control @error('google_map_link') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter google map link" value="{{$data->google_map_link}}">

                    @error('google_map_link')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Plus link</label>
                    <input type="url" name="googleplus_address" class="form-control @error('googleplus_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter googleplus link" value="{{$data->googleplus_address}}">

                    @error('googleplus_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                    </div>                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook Address</label>
                    <input type="url" name="facebook_address" class="form-control @error('facebook_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter facebook address" value="{{$data->facebook_address}}">

                    @error('facebook_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram address</label>
                    <input type="url" name="instagram_address" class="form-control @error('instagram_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter instagram address" value="{{$data->instagram_address}}">

                    @error('instagram_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Twitter address</label>
                    <input type="url" name="twitter_address" class="form-control @error('twitter_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="{{$data->twitter_address}}">

                    @error('twitter_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pinterest address</label>
                    <input type="url" name="pinterest_address" class="form-control @error('pinterest_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="{{$data->pinterest_address}}">

                    @error('pinterest_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">WhatsApp address</label>
                    <input type="url" name="whatsapp_address" class="form-control @error('whatsapp_address') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter twitter address" value="{{$data->whatsapp_address}}">

                    @error('whatsapp_address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                  </div>                                  
                                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">save</button>
                </div>
              </form>
              @endif

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