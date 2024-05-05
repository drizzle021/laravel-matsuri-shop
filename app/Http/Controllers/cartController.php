<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Cart_item;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cart(Request $request)
    {
        $auth_user = Auth::user();
        if($auth_user != NULL){
            $user_cart = Cart::where('user_id',$auth_user->id)->first();
            if ($user_cart == NULL){
                $user_cart=new Cart;
                $user_cart->user_id = $auth_user->id;
                $user_cart->save();
            }
            return redirect()->route('userCart',['cart'=>$user_cart]);
        }
        elseif ($request->cookie('cart') != NULL) {
            $user_cart = $request->cookie('cart');

            

            return redirect()->route('userCart',['cart'=>$user_cart]);
        }
        else{
            $user_cart = new Cart;
            $user_cart->save();

            $duration = 120;

            return redirect()->route('userCart',['cart'=>$user_cart])->withCookie('cart', $user_cart->id, $duration);
        }
    }

    public function userCart(Cart $cart)
    {
        $cart_items = Cart_item::where('cart_id',$cart->id)->get();

        return view('cart',['cart_items'=>$cart_items]);
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
