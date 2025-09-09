    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ALL JS FILES -->
    <script src="{{asset('public/frontend/asset/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/popper.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- ALL PLUGINS -->
    <script src="{{asset('public/frontend/asset/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/inewsticker.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/bootsnav.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/images-loded.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/isotope.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/form-validator.min.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/contact-form-script.js')}}"></script>
    <script src="{{asset('public/frontend/asset/js/custom.js')}}"></script>
<script type="text/javascript">
        // Setup for CSRF Token (optional for GET, but included if needed for security)
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });    
    $(document).ready(function(){
        $(document).on('change','.weight-dropdown', function() {
            // Get the data-id of the selected option
            var weight_id = $(this).find(':selected').attr('data-id');

                    if(weight_id){
                       $.ajax({
                             url: "{{  url('/detect-price/') }}/"+weight_id,
                             type:"GET",
                         }).done(function(data){

                            $('.product-price'+data.product_id).text('Tk ' + data.price);
                            $('.productweight_id'+data.product_id ).val(data.id);                        
                            //console.log(data.product_id)
                         });     
                    }
                    else{
                            $('.productweight_id'+data.product_id ).val(0);
                    }
                   
        });
    });
 
    $(document).ready(function(){
        $(document).on('change','.weight-dropdown-list', function() {
            // Get the data-id of the selected option
            var weight_id = $(this).find(':selected').attr('data-id');

                    if(weight_id){
                        $.ajax({
                         url: "{{  url('/detect-price/') }}/"+weight_id,
                         type:"GET",
                     }).done(function(data){

                        $('.product-price-list'+data.product_id).text('Tk ' + data.price);
                        $('.productweight_id-list'+data.product_id ).val(data.id);                        
                        //console.log(data.product_id)
                     });   
                    }
                    else{
                        $('.productweight_id-list'+data.product_id ).val(0);  
                    }

        });
    });    
</script>
   

    <script type="text/javascript">
        // Setup for CSRF Token (optional for GET, but included if needed for security)
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $(document).ready(function() {
            // Listen for change event on dropdown
            $(document).on('change','#weight_dropdown', function() {
                var selectedValue = $(this).find(':selected').attr('data-id'); // Get selected value from dropdown
                

                if (selectedValue) {
                   $.ajax({
                         url: "{{  url('/detect-availability/') }}/"+selectedValue,
                         type:"GET",
                     }).done(function(data){

                        if(data.quantity != null){

                            if(data.quantity > 0){

                                $('#cart-button').removeAttr('disabled');

                                $('#available-stock').html(data.quantity+' available /');
                                $('.product-price').text('Tk '+data.price);
                                $('#productweight_id').val(data.id);
                                $('#amount').val(data.price);
                                $('#product_quantity').val(1);
                                $('#qty').val(1);
                            }
                            else{
                                $('#cart-button').attr('disabled',true);
                                $('#available-stock').html('Currently unavailable!'); 
                            }

                            
                            
                        }
                        else{

                            if(data.availability == 1){

                                $('#cart-button').removeAttr('disabled');
                                $('.product-price').text('Tk '+data.price);
                                $('#productweight_id').val(data.id);
                                $('#amount').val(data.price);
                                

                            }
                            else{
                                $('#cart-button').attr('disabled',true);
                                $('#available-stock').html('Currently unavailable!');
                            }

                            

                        }

                        
                        
                        $('#brand_id').val(data.brand_id);
                        $('#measurement_id').val(data.measurement_id);
                        if(data.quantity != null){

                        $('#qty').attr('max',data.quantity);    

                        }

                        else{

                        $('#qty').attr('max','');
                            
                        }
                        

                     });
                }
            });
        });
    </script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#qty').on('input', function() {
            var quantity = $(this).val();


            if (quantity > 0) {
                $('#product_quantity').val(quantity);
                $('#product_qty').val(quantity);
            } else {
                $('#product_quantity').val(1);
                $('#product_qty').val(1);
            }

        });

    }); // Closing parenthesis for document.ready
</script>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('change','#weight_dropdown',function(){

            var dropdown_val = $(this).find(':selected').attr('data-id');;

            if(dropdown_val == 0 || dropdown_val == null){

                $('#cart-button').attr('disabled',true);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#weight_dropdown',function(){

            var weight_val = $(this).find(':selected').attr('data-id');;

            $('#weight_id').val(weight_val);

                if(weight_val == 0 || weight_val == null){

                    $('#buy_now').attr('disabled',true);

                }
                if(weight_val > 0){

                    $('#buy_now').removeAttr('disabled');
                }


        });
    });
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   


<script type="text/javascript">
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });



$(document).ready(function() {
    // Use event delegation
    $(document).on('submit', '.cartstore', function(e) {
        e.preventDefault(); // Prevent default form submission

        var url = $(this).attr("action");
        var data = $(this).serialize(); // Regular serialization of form data
        var prev_total_price = parseInt($('#prev_total_price').val());

        $.ajax({
            url: url,
            type: 'POST',
            data: data, // Send regular serialized data
            success: function(response) {

                //console.log(response); // To verify response
                if (response.status == 'success') {
                var new_price = response.latest_cart.product_price * response.latest_cart.product_quantity;
                var new_total_price = new_price + prev_total_price;
                $('#prev_total_price').val(new_total_price);                    
                    toastr.success(response.message);
                    $('.badge').html(response.total_carts);
                    var image = response.latest_cart.product_image;
                    var base_img_url = {!! json_encode(url('/')) !!};

                    $('.cart-list').append('<li><a href="#" class="photo"><img src="'+ base_img_url +'/'+ image + '" class="cart-thumb" alt="" /></a><h6><a href="#">' + response.latest_cart.product_title + '</a></h6><p>' + response.latest_cart.product_quantity + 'x - <span class="price">$' + response.latest_cart.product_price + '</span></p></li>');
                    $('.total').html('<a href="{{route('carts')}}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a> <span class="float-right"><strong>Total</strong>: '+new_total_price+'</span>');
                }
                if (response.status == 'warning') {
                    toastr.warning(response.message);
                }
                if (response.status == 'error') {
                    toastr.error(response.message);
                }                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error: " + textStatus + ": " + errorThrown);
            }
        });
    });
});


</script>
<script type="text/javascript">

    $(document).ready(function(){
        
          var measurement_id = $('#measurement_id').val(); 
          var product_quantity = $('#product_quantity').val();

          if(measurement_id == null){

            $('#invalid_measurement_id_feedback').html('please select a weight')
          }
          if(product_quantity == null){

            $('#invalid_quantity_feedback').html('please select a quantity');
          }

          if(product_quantity != null && measurement_id != null){}        

    });

</script>    

<script type="text/javascript">
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

      $(document).ready(function(){
        $(document).on('submit','.cartupdate',function(e){
          e.preventDefault();
          var url = $(this).attr("action");
          let formData = new FormData(this);
          var cart_id = $(this).data('id');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {

                    if(response.status == 'success'){

                        toastr.success(response.message);

                    }
                    if(response.status == 'warning'){

                        toastr.warning(response.message);

                    }
                    if(response.status == 'delete'){

                        $('.remove-pr-'+cart_id).remove();
                        Swal.fire("warning!","Item no longer available!", "warning");

                    }                                        

                },
            });

            });
  


      });
</script>




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

<!--manual search query-->
<script type="text/javascript">
    $(document).ready(function () {
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Use event delegation for both click and Enter key events
        $(document).on('click', '#search_fa', function (e) {
            e.preventDefault(); // Prevent default behavior

            // Fetch the search query
            var value1 = $('#button1').val();
            $('#button2').val(value1);

            // Submit the form
            $('#search_form').submit();
        });

        // Handle Enter key in the search input
        $('#button1').on('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent default form submission

                // Fetch the search query
                var value1 = $(this).val();
                $('#button2').val(value1);

                // Submit the form
                $('#search_form').submit();
            }
        });
    });
</script>

<!--manual search query end-->

<!--manual search query-->
<script type="text/javascript">
    $(document).ready(function () {
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Attach keyup event to the search input
        $('#button1').on('keyup', function (e) {
            e.preventDefault(); // Prevent default behavior

            let value1 = $(this).val(); // Get the input value

            if (value1.trim().length > 0) { // Perform search only if input is not empty
                $.ajax({
                    url: '{{ route("search") }}', // Query parameter route
                    type: 'GET',
                    data: { search: value1 }, // Send the search term as data
                    success: function (response) {
                        //console.log(response); // View the results in the console
                        // You can update the UI here with response.products
                        $('#product_results').css('display','');
                        if(response.products && response.products.length > 0) {
                        var base_url = {!! json_encode(url('/')) !!};  // Define the base URL once
                        var product_url = {!! json_encode(url('/product')) !!};  // Define the product URL once
                        var search = response.search;

                        // Check and display product 1
                        if(response.products[0]) {
                            var images1 = response.products[0].images.split('|');
                            if (images1[0]) {  // Ensure there's at least one image
                                $('#product-item1').css('display', '');
                                $('#product1_link').attr('href', product_url + "/" + response.products[0].id);
                                $('#product1_image').attr('src', base_url + "/" + images1[0]);
                                $('#product1_title').text(response.products[0].title);
                                $('#product1_price').text(response.products[0].price);
                            }
                        }
                        else{
                                $('#product-item1').css('display','none');
                                $('#product1_link').attr('href','');
                                $('#product1_image').attr('src', '');
                                $('#product1_title').empty();
                                $('#product1_price').empty();
                        }
                        

                        // Check and display product 2
                        if(response.products[1]) {
                            var images2 = response.products[1].images.split('|');
                            if (images2[0]) {  // Ensure there's at least one image
                                $('#product-item2').css('display', '');
                                $('#product2_link').attr('href', product_url + "/" + response.products[1].id);
                                $('#product2_image').attr('src', base_url + "/" + images2[0]);
                                $('#product2_title').text(response.products[1].title);
                                $('#product2_price').text(response.products[1].price);
                            }
                        }
                        else{
                                $('#product-item2').css('display','none');
                                $('#product2_link').attr('href','');
                                $('#product2_image').attr('src', '');
                                $('#product2_title').empty();
                                $('#product2_price').empty();
                        }                                                

                        // Check and display product 3
                        if(response.products[2]) {
                            var images3 = response.products[2].images.split('|');
                            if (images3[0]) {  // Ensure there's at least one image
                                $('#product-item3').css('display', '');
                                $('#product3_link').attr('href', product_url + "/" + response.products[2].id);
                                $('#product3_image').attr('src', base_url + "/" + images3[0]);
                                $('#product3_title').text(response.products[2].title);
                                $('#product3_price').text(response.products[2].price);
                            }
                        }
                        else{
                                $('#product-item3').css('display','none');
                                $('#product3_link').attr('href','');
                                $('#product3_image').attr('src', '');
                                $('#product3_title').empty();
                                $('#product3_price').empty();
                        }                        
                        // Check and display product 4
                        if(response.products[3]) {
                            var images4 = response.products[3].images.split('|');
                            if (images4[0]) {  // Ensure there's at least one image
                                $('#product-item4').css('display', '');
                                $('#product4_link').attr('href', product_url + "/" + response.products[3].id);
                                $('#product4_image').attr('src', base_url + "/" + images4[0]);
                                $('#product4_title').text(response.products[3].title);
                                $('#product4_price').text(response.products[3].price);
                            }
                        }
                        else{
                                $('#product-item4').css('display','none');
                                $('#product4_link').attr('href','');
                                $('#product4_image').attr('src', '');
                                $('#product4_title').empty();
                                $('#product4_price').empty();
                        }
                        if(response.products[4]) {
                            var images5 = response.products[4].images.split('|');
                            if (images5[0]) {  // Ensure there's at least one image
                                $('#product-item5').css('display', '');
                                $('#product5_link').attr('href', product_url + "/" + response.products[4].id);
                                $('#product5_image').attr('src', base_url + "/" + images5[0]);
                                $('#product5_title').text(response.products[4].title);
                                $('#product5_price').text(response.products[4].price);
                            }
                        }
                        else{
                                $('#product-item5').css('display','none');
                                $('#product5_link').attr('href','');
                                $('#product5_image').attr('src', '');
                                $('#product5_title').empty();
                                $('#product5_price').empty();
                        }                        
                        if(response.products.length > 5){

                                var product_search_url = {!! json_encode(url('/link/product/search')) !!};

                                

                                $('#product-item6').css('display','');
                                $('#product_link').attr('href',product_search_url + "/" + search);                            
                        }
                        else{
                                $('#product-item6').css('display','none');
                                $('#product_link').attr('href','');                            
                        }                        
                    }

                    else{
                                $('#product_results').css('display','none');

                                $('#product-item1').css('display','none');
                                $('#product1_link').attr('href','');
                                $('#product1_image').attr('src', '');
                                $('#product1_title').empty();
                                $('#product1_price').empty();

                                $('#product-item2').css('display','none');
                                $('#product2_link').attr('href','');
                                $('#product2_image').attr('src', '');
                                $('#product2_title').empty();
                                $('#product2_price').empty();

                                $('#product-item3').css('display','none');
                                $('#product3_link').attr('href','');
                                $('#product3_image').attr('src', '');
                                $('#product3_title').empty();
                                $('#product3_price').empty();


                                $('#product-item4').css('display','none');
                                $('#product4_link').attr('href','');
                                $('#product4_image').attr('src', '');
                                $('#product4_title').empty();
                                $('#product4_price').empty();                                


                                $('#product-item5').css('display','none');
                                $('#product5_link').attr('href','');
                                $('#product5_image').attr('src', '');
                                $('#product5_title').empty();
                                $('#product5_price').empty();

                                $('#product-item6').css('display','none');
                                $('#product5_price').empty();                                

                    }
                                                                        
                    },
                    error: function (xhr, status, error) {
                        console.error('Search failed:', error); // Handle errors
                    }
                });
            } else {

                $('#product_results').css('display','none');

                $('#product-item1').css('display','none');
                $('#product1_link').attr('href','');
                $('#product1_image').attr('src', '');
                $('#product1_title').empty();
                $('#product1_price').empty();

                $('#product-item2').css('display','none');
                $('#product2_link').attr('href','');
                $('#product2_image').attr('src', '');
                $('#product2_title').empty();
                $('#product2_price').empty();
                                                                 
                $('#product-item3').css('display','none');
                $('#product3_link').attr('href','');
                $('#product3_image').attr('src', '');
                $('#product3_title').empty();
                $('#product3_price').empty();


                $('#product-item4').css('display','none');
                $('#product4_link').attr('href','');
                $('#product4_image').attr('src', '');
                $('#product4_title').empty();
                $('#product4_price').empty();

                $('#product-item5').css('display','none');
                $('#product5_link').attr('href','');
                $('#product5_image').attr('src', '');
                $('#product5_title').empty();
                $('#product5_price').empty();

                $('#product-item6').css('display','none');
                $('#product5_price').empty();                                
 

                                 

                // Clear results if input is empty
            }
        });
    });
</script>


<!--manual search query end-->

<!--customer-message-submit-query-->
<script type="text/javascript">

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $(document).ready(function(){

    $('#message_submit').on('submit',function(e){
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

                    //$('#message_submit')[0].reset();
                    $('#message_submit').remove();
                    $('.contact-form-right').html('<h1>Please check your email inbox for reply</h1>')

                    if(response.status == 'success'){

                        toastr.success('Message submitted successfully!');

                    }


                },

        });
    });    
     



    });    
</script>
<!--customer-message-submit-query-->

<script>
    $(document).ready(function () {
        $(document).on('change','#sortOption', function () {
            let sortValue = $(this).val(); // Get the selected value

            if (sortValue) {
                // If a valid option is selected, submit the form
                $('#sortForm').submit();
            }
            // Do nothing if "Nothing" (empty value) is selected
        });
    });
</script>

<script type="text/javascript">
    //add to wish
    $(document).ready(function(){
        $(document).on('click','.addtowish', function(e){
            e.preventDefault(); // Prevents default link behavior

            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: (response) => {
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $(this).html('<i class="fas fa-heart"></i>');
                    }
                    if (response.status == 'info') {
                        toastr.info(response.message);
                        $(this).html('<i class="far fa-heart"></i>');
                    }                    
                },
                error: (xhr, status, error) => {
                    toastr.error('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
    //add to wish for product details page
        $(document).ready(function(){
        $('.addtowish2').on('click', function(e){
            e.preventDefault(); // Prevents default link behavior

            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: (response) => {
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $(this).html('<i class="fas fa-heart">'+'Added to wishlist</i>');
                    }
                    if (response.status == 'info') {
                        toastr.info(response.message);
                        $(this).html('<i class="far fa-heart">'+'Add to wishlist</i>');
                    }                    
                },
                error: (xhr, status, error) => {
                    toastr.error('An error occurred: ' + xhr.responseText);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(e){
        $('.wishlist').on('click',function(e){
            e.preventDefault();
             var id = $(this).data('id');
             var url = $(this).attr('href');
             var row = $('.wishlist-item'+id+'');

             $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: (response) =>{

                    if(response.status == 'success'){

                        row.remove();

                        toastr.info('Product removed from wishlist!');
                    }
                },
             });

        });

    });
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $(document).on('submit','#price-filter-form', function(e) {
            e.preventDefault();

            var url = $(this).attr('action');
            var formData = $(this).serialize(); // Serialize form data as a query string

            $.ajax({
                url: url,
                method: 'GET',
                data: formData, // Pass serialized data
                success: function(response) {
                    // Inject the rendered HTML into the target div
                    $('#product-list-container').html(response.html);
                    $('.product-list-container_2').html(response.html2);
                    let productIds = JSON.stringify(response.product_ids);
                    $('#sortForm input[name="products"]').val(productIds);
                    $('#pagination_links_price').html(response.price_pagination_links);                     
                    $('#pagination_links').empty();
                    $('#product-head').text('Showing mushroom by price');                    
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                }
            });
        });
    });


</script>

<script type="text/javascript">


    function product_sort_filter() {
    // Automatically submit the form when the dropdown option is changed
    $('#sortForm').submit();
}

$(document).ready(function() {
    $('#sortForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var url = $(this).attr('action'); // Get the form's action URL
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: url,
            method: 'GET',
            data: formData,
            dataType: 'json', // Expecting JSON response
            success: function(response) {
                if (response.html) {
                    // Replace the content in the product list container with the new HTML
                    $('#product-list-container').html(response.html); 
                    $('.product-list-container_2').html(response.html2); 
                     
                } else {
                    console.error("No HTML returned in the response.");
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: ", xhr.responseText || error);
            }
        });
    });
});

</script>

<!--live pagination using jquery-->
<script>
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');
    fetchPaginationData(url);
});

function fetchPaginationData(url) {
    $.ajax({
        url: url,
        success: function (response) {
            // Replace the content with the new data
            $('#product-list-container').html(response.html);
            $('.product-list-container_2').html(response.html2);
            
            if(response.price_pagination_links){
                $('#pagination_links_price').html(response.price_pagination_links);
            }
            if(response.pagination_links){
                $('#pagination_links').html(response.pagination_links);
            }
            
            
            let productIds = JSON.stringify(response.product_ids);
            $('#sortForm input[name="products"]').val(productIds);
                    // Set the value to 'nothing'
            $('#sortOption').val('nothing').selectpicker('refresh').trigger('change');           
        },
        error: function () {
            alert('Error fetching data');
        }
    });
}


</script>



@if(Session::has('success'))
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Swal.fire("success!","Cart successfully updated", "success");
    </script>
@endif
@if(Session::has('error'))
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Get the error message from the session
        const errorMessage = "{{ Session::get('error') }}";
        Swal.fire("Error!", errorMessage, "error");
    </script>
@endif

@if(Session::has('warning'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Get the warning message from the session
        const warningMessage = "{{ Session::get('warning') }}";
        Swal.fire("warning!", warningMessage, "warning");
    </script>
@endif