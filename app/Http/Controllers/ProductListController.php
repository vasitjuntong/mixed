<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')
            ->get();

        return view('productLists.index', [
            'products' => $products,
        ]);
    }
}
