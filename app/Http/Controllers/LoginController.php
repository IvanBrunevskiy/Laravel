<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registration(UserRegistrationRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return response()->redirectTo(route('main_page'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function checklogin(Request $request)
    {
        $user = User::query()->where('email', $request->input('email'))->firstOrFail();
//        if (!$user){
//            return back()->withErrors(['user not found']);
//        }
        if (Hash::check($request->input('password'), $user->password)){
            Auth::login($user);
        }
//        dump($user->password);
//        dump(Hash::check($request->input('password'), $user->password));
//dd($request->all());
    }
}
