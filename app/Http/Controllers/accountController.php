<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Payment_method;
use App\Models\Shipping_address;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function account(User $user)
    {
        $auth_user = Auth::user();
        $payment_methods = Payment_method::all();


        if($auth_user->id == $user->id){
            return view('account',['user'=>$user,
            'payment_methods' => $payment_methods,]);
        }

        return redirect()->route('index');
    }

    public function updateAccount(User $user, Request $request){
        $method = $request->input('payment_method');

        $changeUser = User::where('id', $user->id)->first();

        $changeUser->preferred_payment_id = $method;
        $changeUser->save();

        return redirect()->route('account',['user'=>$user]);

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
