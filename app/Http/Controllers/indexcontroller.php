<?php

namespace App\Http\Controllers;

use App\Models\mocimodel;
use Illuminate\Http\Request;

class indexcontroller extends Controller
{
    public function index()
{
    $products = mocimodel::all();
    return view('index', compact('products'));
}
}
