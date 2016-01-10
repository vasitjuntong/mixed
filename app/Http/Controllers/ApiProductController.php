<?php

namespace App\Http\Controllers;

use Response;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function show($product_code)
    {
        $product = $this->product
            ->with([
                'stock' => function($query){
                    $query->sum('qty');
                },
                'unit',
            ])
            ->whereCode($product_code)
            ->first();

        if($product == null){
            return Response::json(['Product not found.'], 404);
        }

        $productArray = [];
        $productArray = $product->toArray();
        $productArray['stock_sum'] = $product->stock->sum('qty');

        return Response::json($productArray, 200);
    }

    public function typeahead()
    {
        $data = [];

        $products = $this->product->with([
            'unit',
        ])
            ->orderBy('code', 'desc')
            ->get(['id', 'unit_id', 'code', 'mix_no', 'description']);

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'name' => $product->code,
                'mix_no' => $product->mix_no,
                'description' => $product->description,
                'unit' => $product->unit->name,
            ];
        }

        return $data;
    }   
}
