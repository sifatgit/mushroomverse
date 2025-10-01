<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Division;
use App\Models\District;
use App\Models\Notification;

class AdminOrdersController extends Controller
{


    public function update(Request $request,$id){


    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone_no' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'division_id' => 'required|integer',
        'district_id' => 'required|integer',
        'address' => 'required|string|max:500',
        'amount' => 'required|integer|min:1',
        'total_items' => 'required|integer|min:1',
        'payment_method' => 'required|in:cash,card,bkash,rocket', 
        'invoice_no' => 'required|string|max:100',
    ]);
  

        $division = Division::find($request->division_id);
        $district = District::find($request->district_id);

        $order = Order::find($id);

        $order->name = $request->name;
        $order->phone_no = $request->phone_no;
        $order->email = $request->email;
        $order->division_name = $division->name;
        $order->district_name = $district->name;
        $order->address = $request->address;
        $order->zip = $request->zip;
        $order->amount = $request->amount;
        $order->total_items = $request->total_items;
        $order->payment_method = $request->payment_method;
        $order->invoice_no = $request->invoice_no;
        $order->status = 1; //default


        $order->save();


        return redirect()->route('admin.orders')->with('success','Order updated successfully!');

    }

    public function delete($id){

            $order = order::find($id);

            foreach($order->carts as $cart){

                $cart->delete();
            }


            $order->delete();
            
            return back()->with('success','Order removed successfully!');

    }

    public function status(Request $request,$id){

            $order =  Order::find($id);
            $order->status = $request->status;
            if($request->status == 1){
                $order->paid = 1;
            }
            $order->save();

            return response()->json(['status'=>'success']);

    }

    public function new_orders(){

        $data = Order::where('status', 4)->get();
        $notifications = Notification::where('seen', 0)->get();

        foreach($notifications as $noti){

            $noti->seen = 1;
            $noti->save();

        }

        return view('backend.pages.orders.index',compact('data'));


    }
}
