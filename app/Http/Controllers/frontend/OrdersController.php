<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductWeight;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Division;
use App\Models\District;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;


class OrdersController extends Controller
{
    

    public function index(){

        return view('frontend.pages.my_orders');
    }
    
    public function store(Request $request){


    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_no' => 'required|string|max:14',
        'email' => 'required|email|max:255',
        'division_id' => 'required|integer',
        'district_id' => 'required|integer',
        'address' => 'required|string|max:500',
        'zip' => 'required|integer',
        'amount' => 'required|integer',
        'payment_method' => 'required|string|max:50',
        'transaction_id' => 'required|string|max:255',
    ]);


    if ($validator->fails()) {
        // Redirect back with errors and input
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

        if (session()->has('randomtoken')) {


            return redirect()->to('/')->with('warning','Order Already Placed!');
        }

        $carts = Cart::totalCarts();

        if(count($carts) > 0){

            $randomtoken = rand(100000, 999999);


            $orderDate = Carbon::now();

            // Calculate the delivery date (3 days after order placement)
            $deliveryDate = $orderDate->addDays(3);

            $division = Division::where('id',$request->division_id)->first();
            $district = District::where('id',$request->district_id)->first();

            $order = new Order;
            
            $order->name = $request->first_name.' '.$request->last_name;
            $order->phone_no = $request->phone_no;
            $order->email = $request->email;
            $order->division_name = $division->name;
            $order->district_name = $district->name;
            $order->address = $request->address;
            $order->zip = $request->zip;
            $order->ip_address = request()->ip();
            $order->total_items = 0;
            $order->amount = 0;            
            $order->payment_id = 1;
            $order->payment_method = $request->payment_method;
            $order->transaction_id = 1;
            $order->delivery_date = $deliveryDate;
            $order->delivery_charge = 60;
            $order->status = 4;

            $order->save();

            $total_items = 0;
            $amount = 0;

            foreach($carts as $cart){
                $total_items+= $cart->product_quantity;
                $amount+= $cart->productweight->price*$cart->product_quantity;
            }

            $order->total_items = $total_items;
            $order->amount = $amount;

            $date = $order->created_at;

            $dateParts = explode('-', $date); 

            $year = (int) $dateParts[0];  // e.g., 2024
            $month = (int) $dateParts[1]; // e.g., 10
            $day = (int) $dateParts[2];   // e.g., 14

            $order->invoice_no = $day.$month.$year.$order->id;

            $order->save();

            foreach($carts as $cart){

                if($cart->productweight->quantity > 0){
                    $cart->productweight->decrement('quantity',$cart->product_quantity);
                } 
                $cart->order_id = $order->id;
                $cart->save();
            }


            $notification = new Notification;

            $notification->message = $order->name.' has placed a new order';
            $notification->save();

            session(['randomtoken' => $randomtoken]);

            return view('frontend.pages.order_complete',compact('order'));            
        }
        else{

            return back()->with('warning','Carts no longer availabile!');
        }



        

    }

    public function order_placed(){

        return view('frontend.pages.order_complete');
    }

    public function single_order_store(Request $request){

        $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_no' => 'required|string|max:14',
        'email' => 'required|email|max:255',
        'division_id' => 'required|integer',
        'district_id' => 'required|integer',
        'address' => 'required|string|max:500',
        'zip' => 'required|integer',
        'product_id' => 'required|integer',
        'amount' => 'required|integer',
        'transaction_id' => 'required|string|max:255',
    ]);


    if ($validator->fails()) {
        // Redirect back with errors and input
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

        if (session()->has('randomtoken')) {


            return redirect()->to('/')->with('warning','Order Already Placed!');
        }
        $weight = ProductWeight::where('id',$request->measurement_id)->first();

        if($weight->quantity > 0 || $weight->availability == 1){

        $randomtoken = rand(100000, 999999);


        $orderDate = Carbon::now();

        // Calculate the delivery date (3 days after order placement)
        $deliveryDate = $orderDate->addDays(3);

        $product = Product::where('id',$request->product_id)->first();
        $division = Division::where('id',$request->division_id)->first();
        $district = District::where('id',$request->district_id)->first();
        $images = explode("|",$product->images);

        $order = new Order;
        
        $order->name = $request->first_name.' '.$request->last_name;
        $order->phone_no = $request->phone_no;
        $order->email = $request->email;
        $order->division_name = $division->name;
        $order->district_name = $district->name;
        $order->address = $request->address;
        $order->zip = $request->zip;
        $order->ip_address = request()->ip();
        $order->product_id = $product->id;
        $order->product_title = $product->title;
        $order->product_image = $images[0];
        $order->product_price = $request->product_price;
        $order->product_weight = $weight->measurement->weight;

        if($product->brand_id){

        $order->product_brand = $product->brand->name;    

        }

        $order->total_items = $request->total_items;
        $order->amount = $request->amount;
        $order->payment_id = 1;
        $order->payment_method = $request->payment_method;
        $order->transaction_id = 1;
        $order->delivery_date = $deliveryDate;
        $order->delivery_charge = 60;
        $order->status = 4;

        $order->save();

        $date = $order->created_at;

        $dateParts = explode('-', $date); 

        $year = (int) $dateParts[0];  // e.g., 2024
        $month = (int) $dateParts[1]; // e.g., 10
        $day = (int) $dateParts[2];   // e.g., 14

        $order->invoice_no = $day.$month.$year.$order->id;

        $order->save();

        
        $weight->decrement('quantity',$order->total_items);
        $weight->save();
        


        $notification = new Notification;

        $notification->message = $order->name.' has placed a new order';
        $notification->save();

        session(['randomtoken' => $randomtoken]);

        return view('frontend.pages.single_order_complete',compact('order'));

        }
        else{

        return redirect('/')->with('warning','Item No longer availabile!');
            
        }
    }


    public function single_order_placed(){

        return view('frontend.pages.single_order_complete');
    }

    public function generate_invoice_pdf($id){

        $order = Order::find($id);

        $data = [
            'order' => $order, // Assuming there's a relationship
        ];


        $pdf = PDF::loadView('frontend.pages.invoice', $data);


        return $pdf->download('invoice_' . $order->id . '.pdf');

    }
}
