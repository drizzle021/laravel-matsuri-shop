<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:320', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'matsuri_points' => 0,
            'role' => 'CUSTOMER',
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($request->cookie('cart') != NULL) {
            $user_cart = $request->cookie('cart');
            $cart = Cart::where('id',$user_cart)->first();
            $cart->user_id = $user->id;
            $cart->save();
        }

        return redirect(route('index', absolute: false));
    }
}
