<?php


namespace App\Http\Controllers;




use Illuminate\Support\Facades\Session;

class HomeController
{
    public function index(){
        Session::flash('success', 'hello Ivan');
     //return response()->view('home.main')->with('success', 'hello Ivan');
        return view('home.main');
    }
}
