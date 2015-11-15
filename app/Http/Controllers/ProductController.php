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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();
        $data['pic_path'] = 'none';
        $data['pic_name'] = 'none';

        Product::create($data);

        flash()
            ->success(
                trans('product.label.name'),
                trans('product.message_alert.create_success')
            );

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
