<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Product;
use App\ProductType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->paginate(20);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $productTypes = ProductType::orderBy('id', 'desc')
            ->lists('name', 'id');
        $units = Unit::orderBy('id', 'desc')
            ->lists('name', 'id');

        return view('products.create',compact(
            'productTypes',
            'units'
        ));
    }

    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        $file = $request->file('file');

        if($file != null){
            $responseFile = Product::named($file->getClientOriginalName())
                ->move($file);

            $data['pic_name'] = $responseFile->pic_name;
            $data['pic_path'] = $responseFile->pic_path;
            $data['thumbnail_path'] = $responseFile->thumbnail_path;
        }

        Product::create($data);

        flash()
            ->success(
                trans('product.label.name'),
                trans('product.message_alert.create_success')
            );

        return redirect('/products');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
