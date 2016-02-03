<?php

namespace App\Http\Controllers;

use App\Product;
use App\Receive;
use App\Requesition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $receiveCount = Receive::count();
        $requisitionCount = Requesition::count();

        $receives = Receive::latest()->limit(5)->get();
        $requisitions = Requesition::latest()->limit(5)->get();

        return view('home.index', compact('productCount',
            'receiveCount',
            'requisitionCount',
            'receives',
            'requisitions'
        ));
    }
}
