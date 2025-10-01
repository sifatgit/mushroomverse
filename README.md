# 🍄 Mushroomverse — Full-Stack Laravel eCommerce

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![jQuery](https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white)
![AJAX](https://img.shields.io/badge/AJAX-005A9C?style=for-the-badge)
![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)

Mushroomverse is a Laravel-based eCommerce platform for delivering all types of mushrooms, built as my first complete full-stack project for a startup. It showcases my ability to design, develop, and deploy a real-world web application with product inventory, checkout workflows, and dynamic user interactions.

**Live Demo:** [Mushroomverse.store](https://mushroomverse.store) – Explore the fully functional eCommerce platform.

---

## Key Highlights
- **Responsive & Intuitive UI/UX:** Mobile-first design using Bootstrap and Blade templates, with category filtering, wishlist, and AJAX-powered live search.
- **Dynamic Shopping Experience:** Real-time cart updates, stock availability, price filtering, guest checkout with IP-based tracking, and **real-time audio notifications in the admin panel for new orders and visitor messages**.
- **Admin & Backend Expertise:** IP-restricted admin panel with Laravel Breeze, secure CRUD operations, inventory management, and order tracking.
- **Technical Skills Demonstrated:** Full-stack Laravel development, database schema design (MySQL), AJAX-driven interactivity, secure checkout workflows, and deployment on shared hosting.
- **Future-Ready:** Planned payment gateway integration (bKash/Stripe), user authentication with order history, and automated notifications.

---

## Impact
- Delivered a professional, functional eCommerce platform that handles real-world workflows and demonstrates end-to-end Laravel capabilities.
- Showcases problem-solving skills, such as live product filtering, AJAX interactions, IP-based admin security, and real-time admin notifications.

---

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Blade, Bootstrap, jQuery/AJAX
- **Database:** MySQL
- **Version Control:** Git / GitHub

---

## Database Setup

You can import the preloaded database using the exported SQL file:

[Download mushroomverse.sql](./database/mushroomverse.sql)

## Quick Start

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/mushroomverse.git
   
Install dependencies:
```bash
composer install
npm install && npm run dev
```

Configure environment variables:
```bash 
cp .env.example .env
```

Generate app key:
```bash
php artisan key:generate
```

Run migrations and seeders:
```bash 
php artisan migrate --seed
```


Notes:-
Cart Logic:
Uncomment the Cart-related logic in app/Models/Cart.php (lines 24–96) to enable stock adjustments for different product types and automatic item quantity correction.

```php
    public static function totalCarts(){


      $main_carts = Cart::where('ip_address',request()->ip())->where('order_id',NULL)->get();

      //if(count($main_carts) > 0){

              foreach($main_carts as $cart){

                if($cart->productweight->product->category->type == 2){

                   if($cart->productweight->quantity < $cart->product_quantity){
                      if($cart->productweight->quantity == 0){

                      $cart->delete(); 
                    
                    }
                      else{
                      $decrement = $cart->product_quantity - $cart->productweight->quantity;

                      $cart->decrement('product_quantity',$decrement);
                      $cart->save();  
                    }


                  }         
                }
                else{
                    
                      if($cart->productweight->availability == 0){
                        
                       $cart->delete();  
                      }            
                    
                }


              }       

      return $carts = $main_carts;        
      //}

    }

/**
 * total Items in the cart
 * @return integer total item
 */
  public static function totalItems()
  {
    $carts = Cart::totalCarts();

    $total_item = 0;

    foreach ($carts as $cart) {
      $total_item += $cart->product_quantity;
    }
    return $total_item;
  }

  public static function totalprice(){

    $carts = Cart::totalCarts();

    $total_price = 0;

    foreach($carts as $cart){

      $total_price += $cart->product->price * $cart->product_quantity;
    }

    return $total_price;
  }
```

AppServiceProvider:
Uncomment the code in app/Providers/AppServiceProvider.php (lines 26–32) to share global data like carts and settings with all views:

```php
$carts = Cart::totalCarts();
Paginator::useBootstrapFour();
$setting = Setting::first();
view()->share([
    'setting' => $setting,
    'carts' => $carts
]);
```

Start the development server:

```bash 
php artisan serve
```

Access the application

Frontend:
http://127.0.0.1:8000/

Admin Panel:
http://127.0.0.1:8000/login
(check database/seeders/UserSeeder.php for credentials)


Features
Responsive UI with Bootstrap and Blade templating

AJAX-powered live search, cart, wishlist, and product filtering

Real-time audio notifications for new orders and visitor messages

Guest checkout with IP-based tracking

Admin panel with IP-restricted access (Laravel Breeze)

Inventory management, order tracking, and CRUD operations

Future-ready for payment integration and user authentication

Cloning & Contribution
If you want to contribute or run a local copy for testing, follow the Quick Start instructions above.
