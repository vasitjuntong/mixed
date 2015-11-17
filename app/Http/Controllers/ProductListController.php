<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('productLists.index', compact('products'));
    }
}
