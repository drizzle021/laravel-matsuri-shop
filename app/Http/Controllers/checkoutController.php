<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Payment_method;
use App\Models\Shipping_method;
use App\Models\Shipping_address;

class checkoutController extends Controller
{
    public function checkout(Cart $cart)
    {
        $cart_items=Cart::with('cart_items.product')->where('id',$cart->id)->get();
        $payment_methods=Payment_method::all();
        $shipping_methods=Shipping_method::all();

        $auth_user = Auth::user();


        if($auth_user == NULL){
            $cart_items = $cart_items[0]->cart_items;
            return view("checkout",[
                "cart_items" => $cart_items,
                "ship_methods" => $shipping_methods,
                "payment_methods" => $payment_methods,
            ]);
        }
        $user=User::where('id',$cart_items[0]->user_id)->first();

            $lastOrder=Order::where('user_id',$user->id)->first();
            if($lastOrder!=NULL){
                $shipping_address=Shipping_address::where('id',$lastOrder->address_id)->first();
            }
            
            $cart_items = $cart_items[0]->cart_items;
        
        if ($lastOrder != NULL && $shipping_address != NULL){
            return view("checkout",[
                "cart_items" => $cart_items,
                "user" => $user,
                "ship_methods" => $shipping_methods,
                "payment_methods" => $payment_methods,
                "address" => $shipping_address,
            ]);
        }
        else{
            return view("checkout",[
                "cart_items" => $cart_items,
                "user" => $user,
                "ship_methods" => $shipping_methods,
                "payment_methods" => $payment_methods,
            ]);
        }
        
    }

    public function sendOrder(Cart $cart, Request $request)
    {
        $request->phone = str_replace(' ', '', $request->phone);

        $validated = $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:320'],
            'first_name' => 'required|max:50|alpha_dash',
            'last_name' => 'required|max:50|alpha_dash',
            'city' => 'required|max:26|alpha_dash',
            'zip' => 'required|digits_between:5,6|integer',
            'phone' => 'required|max:15|alpha_num',
            'address' => 'required|max:35|alpha_num'
        ]);

        $cart_items=Cart::with('cart_items.product')->where('id',$cart->id)->get();

        $auth_user = Auth::user();
        if($auth_user!=NULL){
            $matsuri_points = $auth_user->matsuri_points;
        }

        $newOrder = new Order;
        $newAddress = new Shipping_address;


        $newAddress->first_name = $request->input("first_name");
        $newAddress->last_name = $request->input("last_name");
        $newAddress->country = $request->input("country");
        $newAddress->city = $request->input("city");
        $newAddress->zip = $request->input("zip");
        $newAddress->phone = $request->input("phone");
        $newAddress->address = $request->input("address");

        $newAddress->save();

        if($auth_user != NULL){
            $newOrder->user_id = $auth_user->id;
        }
        else{
            $newOrder->user_id = NULL;
        }
        $newOrder->address_id = $newAddress->id;
        $newOrder->payment_method_id = $request->input("payment_method");
        $newOrder->shipping_method_id = $request->input("shipping_method");
        $newOrder->total = 0;
        $newOrder->order_status = "PENDING";

        $newOrder->save();

        $cart_items = $cart_items[0]->cart_items;

        foreach($cart_items as $item){
            $order_item = new Order_item;

            $order_item->order_id = $newOrder->id;
            $order_item->product_id = $item->product_id;
            $order_item->quantity = $item->quantity;
            $order_item->save();

            $newOrder->total += ($item->product->price - $item->product->price*$item->product->discount)*$item->quantity;

            $newOrder->save();
            $item->delete();
        }

        $payment_price=Payment_method::where('id',$newOrder->payment_method_id)->first()->price;
        $shipping_price=Shipping_method::where('id',$newOrder->shipping_method_id)->first()->price;

        $newOrder->total += $payment_price + $shipping_price;
        

        if($request->has('points') && $auth_user!=NULL && $auth_user->matsuri_points > 100){
            $auth_user->matsuri_points -= 100;
            $newOrder->total = $newOrder->total - $newOrder->total*0.1;
        }

        if($auth_user!=NULL){
            $auth_user->matsuri_points += round($newOrder->total*2);
            $auth_user->save();
        }
    
        $newOrder->save();



        
        return redirect()->route('index')->with('success',"Order Successful, Thank you for your purchase!");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
