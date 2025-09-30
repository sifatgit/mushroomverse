<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Admin\AdminSlidersController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminBrandsController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\AdminStocksController;
use App\Http\Controllers\Admin\AdminDivisionsController;
use App\Http\Controllers\Admin\AdminDistrictsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminBlogsController;
use App\Http\Controllers\Admin\AdminNotificationsController;
use App\Http\Controllers\Admin\AdminMessagesController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PagesController;
use App\Http\Controllers\frontend\ProductsController;
use App\Http\Controllers\frontend\WishlistsController;
use App\Http\Controllers\frontend\CartsController;
use App\Http\Controllers\frontend\CheckoutsController;
use App\Http\Controllers\frontend\OrdersController;
use App\Http\Controllers\frontend\BlogsController;
use App\Http\Controllers\frontend\MessagesController;
use App\Models\Order;


/* Auth Controller */

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/',[HomeController::class,'index']);


//search
Route::get('/search', [PagesController::class, 'search'])->name('search');
Route::get('/product/search',[PagesController::class,'product_search'])->name('product.search');
Route::get('/link/product/search/{search}',[PagesController::class,'link_product_search'])->name('product.link.search');

Route::get('/products',[ProductsController::class,'index'])->name('products');
Route::get('/product/{id}',[ProductsController::class,'view'])->name('product.view');
Route::get('/category/product/{id}',[ProductsController::class,'category_products'])->name('category.products');
Route::get('/products/sort',[ProductsController::class,'products_sort'])->name('products.sort');
Route::get('/product-price-filter',[ProductsController::class,'product_price_filter'])->name('product.price_filter');
Route::get('/wishlist',[WishlistsController::class,'index'])->name('wishlist');
Route::get('/wishlist/store/{product_id}', [WishlistsController::class, 'store'])->name('wishlist.store');
Route::get('/wishlist/remove/{id}',[WishlistsController::class,'remove'])->name('wishlist.remove');

Route::get('/detect-price/{id}',[CartsController::class,'detect_price']);
Route::get('/carts',[CartsController::class,'index'])->name('carts');
Route::post('/cart/update/{id}',[CartsController::class,'update'])->name('cart.update');
Route::get('/checkouts',[CheckoutsController::class,'index'])->name('checkouts');
Route::get('/single_order_checkout',[CheckoutsController::class,'single_order_checkout'])->name('single_product.checkout');
Route::get('/detect-availability/{id}',[ProductsController::class,'get_availability']);
Route::get('/cart_remove/{id}',[CartsController::class,'remove'])->name('cart.remove');
Route::get('/blog/view/{id}',[BlogsController::class,'view'])->name('blog.view');
Route::get('/contact_us',[PagesController::class,'contact_us']);
Route::get('/about_us',[PagesController::class,'about_us']);
Route::get('/privacy_policy',[PagesController::class,'privacy_policy']);
Route::get('/terms_condition',[PagesController::class,'terms_condition']);
Route::get('/delivery_information',[PagesController::class,'delivery_information']);
Route::get('/location',[PagesController::class,'location']);
Route::post('/message-store',[MessagesController::class,'store'])->name('message.store');



//order routes start

Route::get('/orders',[OrdersController::class,'index'])->name('orders');
Route::post('/order/store',[OrdersController::class,'store'])->name('order.place');
Route::get('/order-placed',[OrdersController::class,'order_placed']);
Route::post('/single_order_store',[OrdersController::class,'single_order_store'])->name('single_order.place');
Route::get('/single-order-placed',[OrdersController::class,'single_order_placed']);
Route::get('/generate_invoice_pdf/{id}',[OrdersController::class,'generate_invoice_pdf'])->name('invoice.generator');

//order routes end


//Carts Routes start

Route::post('/cart/store',[CartsController::class,'store'])->name('cart.store');

//Admin Carts Routes end


//Route::get('/test_pdf',function(){

    //$order = Order::find(4);

    //return view('test',compact('order'));
//});




// Guest-only routes
Route::middleware(['admin_ip'])->group(function () {


    // Registration Routes
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    // Login Routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Password Reset Routes
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Authenticated-only routes
Route::middleware('auth')->group(function () {

        //dashboard routes


    Route::get('/admin-dashboard',function(){

    return view('backend.pages.dashboard');
});

//Admin Slider Routes

Route::get('/admin/sliders',[AdminController::class,'sliders'])->name('admin.sliders');
Route::post('/admin/sliders/store',[AdminSlidersController::class,'store'])->name('admin.slider.store');
Route::get('/admin/slider/delete/{id}',[AdminSlidersController::class,'delete'])->name('admin.slider.delete');
//Admin Slider Routes end

    //Admin Category Routes

Route::get('/admin/categories',[AdminController::class,'categories'])->name('admin.category');
Route::post('/category/store',[AdminCategoriesController::class,'store'])->name('category.store');
Route::post('/category/update/{id}',[AdminCategoriesController::class,'update'])->name('category.update');
Route::get('/category/delete/{id}',[AdminCategoriesController::class,'delete'])->name('category.delete');


//Admin Category Routes end


//Admin Product Routes

Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
Route::get('/product/add',[AdminProductsController::class,'add'])->name('admin.product.add');
Route::post('/product/store',[AdminProductsController::class,'store'])->name('admin.product.store');
Route::post('/product/update/{id}',[AdminProductsController::class,'update'])->name('admin.product.update');
Route::get('/product/delete/{id}',[AdminProductsController::class,'delete'])->name('admin.product.delete');
Route::get('/admin/product/weights',[AdminProductsController::class,'manage_weights'])->name('admin.product.weights');
Route::post('/admin/product/weight/store',[AdminProductsController::class,'weight_store'])->name('admin.weight.store');
Route::get('/admin/product/weight/delete/{id}',[AdminProductsController::class,'weight_delete'])->name('admin.weight.delete');
Route::get('/admin/product/units',[AdminProductsController::class,'manage_units'])->name('admin.product.units');
Route::post('/admin/product/unit/store',[AdminProductsController::class,'unit_store'])->name('admin.unit.store');
Route::get('/admin/product/unit/delete/{id}',[AdminProductsController::class,'unit_delete'])->name('admin.unit.delete');
Route::post('/admin/product/stock/update/{id}',[AdminProductsController::class,'update_stock'])->name('admin.product.stock.update');


//Admin Product Routes end


//Admin Order Routes

Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');
Route::get('/admin/new/orders',[AdminOrdersController::class,'new_orders'])->name('admin.new_orders');
Route::post('/order/update/{id}',[AdminOrdersController::class,'update'])->name('admin.order.update');
Route::post('/order/status/update/{id}',[AdminOrdersController::class,'status'])->name('admin.order.status.update');
Route::get('/order/delete/{id}',[AdminOrdersController::class,'delete'])->name('admin.order.delete');
Route::get('/notice/{id}',[AdminNotificationsController::class,'notice']);
Route::get('/notice/alert',[AdminNotificationsController::class,'alert']);


//Admin Order Routes end


//Admin Brand Routes

Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
Route::get('/brand/add',[AdminBrandsController::class,'add'])->name('admin.brand.add');
Route::post('/brand/store',[AdminBrandsController::class,'store'])->name('admin.brand.store');
Route::post('/brand/update/{id}',[AdminBrandsController::class,'update'])->name('admin.brand.update');
Route::get('/brand/delete/{id}',[AdminBrandsController::class,'delete'])->name('admin.brand.delete');



//Admin Brand Routes end


//Admin Division Routes

Route::get('/admin/divisions',[AdminController::class,'divisions'])->name('admin.divisions');
Route::post('/admin/division/store',[AdminDivisionsController::class,'store'])->name('admin.division.store');
Route::get('/admin/division/delete/{id}',[AdminDivisionsController::class,'delete'])->name('admin.division.delete');



//Admin Division Routes end


//Admin District Routes

Route::get('/admin/districts',[AdminController::class,'districts'])->name('admin.districts');
Route::post('/admin/district/store',[AdminDistrictsController::class,'store'])->name('admin.district.store');
Route::get('/admin/district/delete/{id}',[AdminDistrictsController::class,'delete'])->name('admin.district.delete');



//Admin District Routes end

//Admin setting routes start
Route::get('/admin/settings',[AdminSettingsController::class,'index'])->name('admin.settings');
Route::post('/admin/setting/store',[AdminSettingsController::class,'store'])->name('admin.setting.store');
Route::post('/admin/setting/update',[AdminSettingsController::class,'update'])->name('admin.setting.update');
//Admin setting routes end


//Admin Blogs Routes Start
Route::get('/admin/blogs',[AdminController::class,'blogs'])->name('admin.blogs');
Route::post('/admin/blog/store',[AdminBlogsController::class,'store'])->name('admin.blog.store');
Route::post('/admin/blog/update/{id}',[AdminBlogsController::class,'update'])->name('admin.blog.update');
Route::get('/admin/blog/delete/{id}',[AdminBlogsController::class,'delete'])->name('admin.blog.delete');
//Admin Blogs Routes End


//Admin Notification Routes Start
Route::get('/admin/notifications',[AdminController::class,'notifications'])->name('admin.notifications');
Route::get('/admin/notification/delete/{id}',[AdminNotificationsController::class,'delete'])->name('admin.notification.delete');
Route::get('/noti_seen/{id}',[AdminNotificationsController::class,'seen']);


//Admin Messages Routes Start
Route::get('/admin/messages',[AdminController::class,'messages'])->name('admin.messages');
Route::get('/admin/check_new_message/{id}',[AdminMessagesController::class,'check_new_message']);
Route::get('/admin/check_new_pending_messages',[AdminMessagesController::class,'check_pending_message']);
Route::get('/admin/seen/message/{id}',[AdminMessagesController::class,'seen']);
Route::get('/admin/message/delete/{id}',[AdminMessagesController::class,'delete'])->name('admin.message.delete');
//Admin Messages Routes End

//Admin Notification Routes End
    // Logout Route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});