<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        return view('home', compact('vehicles'));
    }
    public function contact(){
        return view('contact-us');
    }

    public function dashboard(){
        return view('dashboard');
    }
}
