<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with([
                'productType',
                'unit',
                'stock',
            ])
            ->orderBy('mix_no', 'asc')
            ->paginate(20);

        return view('productLists.index', compact('products'));
    }
}
