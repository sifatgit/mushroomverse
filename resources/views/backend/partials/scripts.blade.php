  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="{{asset('admin_asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin_asset/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin_asset/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin_asset/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('admin_asset/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin_asset/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin_asset/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin_asset/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin_asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin_asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('admin_asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin_asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_asset/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_asset/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin_asset/dist/js/pages/dashboard.js')}}"></script>
<!--Fontawesome-->
<script src="https://kit.fontawesome.com/a736d91cf4.js" crossorigin="anonymous"></script>
<!--Sweetalert2-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!--cart_delete-->
<script type="text/javascript">

    $(document).ready(function(){

        $('.remove_link').on('click',function(e){
            e.preventDefault();

            var cart_id = $(this).data('id');

                   $.ajax({
                         url: "{{  url('/cart_remove/') }}/"+cart_id,
                         type:"GET",
                     }).done(function(data){
                        
                      $('.remove-pr-'+cart_id).remove();


                      toastr.info('Cart removed');  

                     });

        });
    });
</script>

<script>
  $(document).on("click", "#delete", function(e){
                e.preventDefault();
                 var link = $(this).attr("href");
                 swal({
                  title: "Are you sure?",
                  text: "You will not be able to recover data!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn bg-danger",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel!",
                },
                function(isConfirm) {
                  if (isConfirm) {
                    
                    window.location.href = link;
                  } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                  }
                });
               });
  
</script>
 
  @if(Session::has('success'))
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire("success!", "{{ Session::get('success') }}", "success"
            )
       </script>
       <!--Sweetalert2-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

   @elseif(Session::has('error'))
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire("error!", "{{ Session::get('error') }}", "error"
            )
       </script>
       <!--Sweetalert2-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>        
   @elseif(Session::has('warning'))
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire("warning!", "{{ Session::get('warning') }}", "warning"
            )
       </script>
       <!--Sweetalert2-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> 
  @endif         


<!--<script type="text/javascript">
      function toggleCheckbox(otherCheckboxId) {
      document.getElementById(otherCheckboxId).checked = false;
    }
</script>
-->


<script type="text/javascript">
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $(document).ready(function(){
        $('.wgt').submit(function(e){
          e.preventDefault();
          var url = $(this).attr("action");
          let formData = new FormData(this);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {

                    $('#notice'+response.productweight.id+'').show();
                    $('#notice'+response.productweight.id+'').text('stock updated!');
                    
                    if(response.productweight.availability == 1){$('#span'+response.productweight.id+'').removeClass('btn-warning').addClass('btn-success').html('available'); }

                    if(response.productweight.availability == 0){$('#span'+response.productweight.id+'').removeClass('btn-success').addClass('btn-warning').html('Currently unavailable');}
                                   

                    if(response.productweight.quantity > 0 ){$('#span'+response.productweight.id+'').removeClass('btn-warning').addClass('btn-success').html(response.productweight.quantity+''+' pieces available');}

                    if(response.productweight.quantity == 0){$('#span'+response.productweight.id+'').removeClass('btn-success').addClass('btn-warning').html('Currently unavailable');}

                    
                    

                     
                    

                },
            });

            });
  


      });
</script>
<script type="text/javascript">
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $(document).ready(function(){
        $(document).on('submit','.order-status',function(e){
          e.preventDefault();
          var url = $(this).attr("action");
          let formData = new FormData(this);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {

                    if(response.status == 'success'){

                        toastr.success('Order status has been changed successfully!');

                    }                    

                },
            });

            });
  


      });
</script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).ready(function() {
    setInterval(function() {
      var last_id = $('#last_notifications_id').val();

      $.ajax({
        url: "{{ url('/notice/') }}/" + last_id,
        type: "GET",
        dataType: "json",
        success: (response) => { 
          if (response.notifications == 0) {
            
          } else {
          const sound = new Audio("{{ asset('admin_asset/sounds/message-notification-190034.mp3')}}"); // Change sound dynamically
              sound.play();
            var count = response.notifications.length;
            var prev_count = parseInt($('#count').text());
            var new_count = count + prev_count;
            $('#count').text(new_count);
            $.each(response.notifications, function(key, value) {
              // Make sure to use the correct selector and get `created_at` in `diffForHumans()` format from the server response
              const timePassed = moment(value.created_at).fromNow();
              $('#notifications').append(`
                <a href="#" class="dropdown-item">
                  <div class="media">
                    <div class="media-body">
                      <p class="text-sm">` + value.message + `</p>
                      <p class="text-sm text-muted">
                        <i class="far fa-clock mr-1"></i>`+ timePassed +`
                      </p>
                    </div>
                  </div>
                </a>
              `);
            $('#last_notifications_id').val(value.id);  
            });

          }
        }
      });
    }, 1000); // Interval time in milliseconds
  });
</script>

<script type="text/javascript">
    
    $(document).ready(function(){

      $('.click-row').on('click',function(){

        var click_id = $(this).data('id')

        $.ajax({

          url: " {{url('/noti_seen/')}}/" +click_id,
          type: "GET",
          dataType: "json",
          success : (response) => {

            console.log('okay');

          }

        });
      });

    });

</script>
<script type="text/javascript">
  $(document).ready(function() {

    var url = "{{ url('/notice/alert') }}";
    var route = "{{ route('admin.new_orders') }}";

    $.ajax({
      url: url,
      type: "GET",
      dataType: "json",
      success: (response) => {
        if (response.notifications.length > 0) {

          var total_orders = response.notifications.length;
              const sound = new Audio("{{ asset('admin_asset/sounds/message-notification-190034.mp3')}}"); // Change sound dynamically
              sound.play();
          Swal.fire({
            title: 'Orders!',
            html: `
              <div style="position: relative; display: inline-block;">
                <i class="fas fa-file-invoice" style="font-size: 50px; color: #FFA500;"></i>
                <span style="
                  position: absolute;
                  top: -5px;
                  right: -5px;
                  background-color: red;
                  color: white;
                  font-size: 12px;
                  font-weight: bold;
                  border-radius: 50%;
                  padding: 5px 8px;
                  border: 2px solid white;
                ">
                  `+total_orders+`
                </span>
              </div>
              <p>You have new orders! <a href="` + route + `">View</a></p>
            `,
            showConfirmButton: true,
            confirmButtonText: 'Got it!',
            didRender: () => {
              const confirmButton = Swal.getConfirmButton();
              confirmButton.style.backgroundColor = '#041F22';
              confirmButton.style.color = '#ffffff';
              confirmButton.style.boxShadow = '0 0 10px #093f42'; /* Green glow */
              confirmButton.style.fontWeight = 'bold';
              confirmButton.style.padding = '10px 20px';
              confirmButton.style.borderRadius = '5px';
            }

          });

        }
      },
      error: (xhr, status, error) => {
        console.error("AJAX Error: ", error);
      }
    });

  });
</script>

<!--new_message_alert-->
<script type="text/javascript">
    
    $(document).ready(function(){
        setInterval(function(){

            var last_message_id = $('#last_message_id').val();
            var url = "{{ url('/admin/check_new_message/')}}/"+last_message_id;

            $.ajax({
                url: url,
                success: function(response){
                  var total_messages = response.messages.length;
                  var route = "{{ route('admin.messages') }}";

                  if(total_messages > 0){
                    const sound = new Audio("{{ asset('admin_asset/sounds/message-notification-190034.mp3')}}"); // Change sound dynamically
                    sound.play();
                    $('#last_message_id').val(response.last_message_id);
                            Swal.fire({
                              title: 'New Messages!',
                              html: `
                                <div style="position: relative; display: inline-block;">
                                  <i class="fas fa-file-invoice" style="font-size: 50px; color: #FFA500;"></i>
                                  <span style="
                                    position: absolute;
                                    top: -5px;
                                    right: -5px;
                                    background-color: red;
                                    color: white;
                                    font-size: 12px;
                                    font-weight: bold;
                                    border-radius: 50%;
                                    padding: 5px 8px;
                                    border: 2px solid white;
                                  ">
                                    `+total_messages+`
                                  </span>
                                </div>
                                <p>You have new messages! <a href="` + route + `">View</a></p>
                              `,
                              showConfirmButton: true,
                              confirmButtonText: 'Got it!',
                              didRender: () => {
                                const confirmButton = Swal.getConfirmButton();
                                confirmButton.style.backgroundColor = '#041F22';
                                confirmButton.style.color = '#ffffff';
                                confirmButton.style.boxShadow = '0 0 10px #093f42'; /* Green glow */
                                confirmButton.style.fontWeight = 'bold';
                                confirmButton.style.padding = '10px 20px';
                                confirmButton.style.borderRadius = '5px';
                              }

                            });                    
                  }




                }
            });

        }, 3000);
    });

</script>


<!--new_message_alert-->
<script type="text/javascript">
    
    $(document).ready(function(){
        setTimeout(function(){
            var last_message_id = $('#last_message_id').val();
            var url = "{{ url('/admin/check_new_pending_messages')}}";

            $.ajax({
                url: url,
                success: function(response){
                  var total_messages = response.messages.length;
                  var route = "{{ route('admin.messages') }}";

                  if(total_messages > 0){
                    const sound2 = new Audio("{{ asset('admin_asset/sounds/message-notification-190034.mp3')}}"); // Change sound dynamically
                    sound2.play();
                    //$('#last_message_id').val(response.last_message_id);
                            Swal.fire({
                              title: 'Messages!',
                              html: `
                                <div style="position: relative; display: inline-block;">
                                  <i class="fas fa-file-invoice" style="font-size: 50px; color: #FFA500;"></i>
                                  <span style="
                                    position: absolute;
                                    top: -5px;
                                    right: -5px;
                                    background-color: red;
                                    color: white;
                                    font-size: 12px;
                                    font-weight: bold;
                                    border-radius: 50%;
                                    padding: 5px 8px;
                                    border: 2px solid white;
                                  ">
                                    `+total_messages+`
                                  </span>
                                </div>
                                <p>You have new messages! <a href="` + route + `">View</a></p>
                              `,
                              showConfirmButton: true,
                              confirmButtonText: 'Got it!',
                              didRender: () => {
                                const confirmButton = Swal.getConfirmButton();
                                confirmButton.style.backgroundColor = '#041F22';
                                confirmButton.style.color = '#ffffff';
                                confirmButton.style.boxShadow = '0 0 10px #093f42'; /* Green glow */
                                confirmButton.style.fontWeight = 'bold';
                                confirmButton.style.padding = '10px 20px';
                                confirmButton.style.borderRadius = '5px';
                              }

                            });                    
                  }


                }
            });

        }, 3000);
    });

</script>
<script type="text/javascript">
  $(document).ready(function(){

    $('.seen').on('click', function() {
      var id = $(this).data('id');
      var url = "{{ url('/admin/seen/message/') }}/" + id;

      $.ajax({
        url: url,
        success: (response) => {
          $('#seen_row'+response.message.id).html('<p class="bg-success text-white">Yes</p>');
        },
      });
    });

  });
</script>
