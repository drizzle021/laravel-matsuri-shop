<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

use Illuminate\Support\Facades\DB;

class product_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function detail(string $product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        $author = $product->author;
        $series = $product->series_id;

        $recommendations = DB::table('products')->where(function ($query) use ($author, $series, $product) {
            $query->where('series_id', $series);
        })->whereNot('id', $product->id)->inRandomOrder()->take(3)->get();


        return view('product_detail', ['product'=>$product, 'recommendations'=>$recommendations]);
    }


    public function addToCart(string $product_id, Request $request)
    {
        // FIND CART OF USER
        $saveCookie = false;
        $auth_user = Auth::user();

        // LOGGED IN USER
        if($auth_user != NULL){
            $user_cart = Cart::where('user_id',$auth_user->id)->first();
            // IF USER DOESNT HAVE A CART CREATE ONE
            if ($user_cart == NULL){
                $user_cart=new Cart;
                $user_cart->user_id = $auth_user->id;
                $user_cart->save();
            }
        }
        // IF UNREGISTERED USER AND HAS A CART SAVED IN COOKIES, FIND IT
        elseif ($request->cookie('cart') != NULL) {
            $user_cart = $request->cookie('cart');
        }
        // IF UNREGISTERED USER AND DOESNT HAVE A CART SAVED IN COOKIES
        // CREATE CART AND SAVE ID TO COOKIES
        else{
            $saveCookie = true;
            $user_cart = new Cart;
            $user_cart->save();

            $duration = 30;
        }

        
        $product = Product::where('id',$product_id)->first();
        $stock = $product->stock;
        $cart_item = new Cart_item;
        $quantity = $request->input('quantity_select');

    

        if($quantity > 0 && $quantity <= $stock){
            $cart_item->quantity = $quantity;
            $cart_item->product_id = $product_id;
            if (gettype($user_cart)=="string"){
                $cart_item->cart_id = $user_cart;
            }
            else{
                $cart_item->cart_id = $user_cart->id;
            }
            
            $cart_item->save();

            $product->stock = $product->stock - $quantity;
            $product->save();
        }
        else{

            return redirect()->route('productDetail',['product_id'=>$product_id])->with('failure', 'Not enough stock');
        }
        
        if($saveCookie){
            return redirect()->route('productDetail',['product_id'=>$product_id])->withCookie('cart', $user_cart->id, $duration);
        }
        else{
            return redirect()->route('productDetail',['product_id'=>$product_id]);
        }
        
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
