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
        $filter = $request->all();
        $limit = $request->get('limit', 20);

        Cache::put('limit_per_page', $limit, 10);

        $products = Product::whereByFilterWithStock($filter, $limit);

        return view('productLists.index', [
            'products' => $products,
            'filter' => $filter,
        ]);
    }
}
