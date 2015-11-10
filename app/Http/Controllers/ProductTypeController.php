<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTypeCreateRequest;
use App\Http\Requests\ProductTypeUpdateRequest;

class ProductTypeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('productTypes.index', compact('productTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductTypeCreateRequest $request)
    {
        ProductType::create($request->all());

        flash()->success(
            trans('product_type.label.name'),
            trans('product_type.message_alert.create_success')
        );

        return redirect('/product-types');
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
        $productType = ProductType::find($id);

        return view('productTypes.edit', compact('productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductTypeUpdateRequest $request, $id)
    {
        $productType = new ProductType($request->all());

        ProductType::where('id', $id)
            ->update($productType->getAttributes());

        flash()
            ->success(
                trans('product_type.label.name'),
                trans('product_type.message_alert.update_success')
            );

        return redirect('/product-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $response = ProductType::deleteByCondition($id);


        if($request->ajax())
            return $response;

        if($response['status']){
            flash()
                ->success(
                    trans('product_type.label.name'),
                    $response['message']
                );
        }else{
            flash()
                ->success(
                    trans('product_type.label.name'),
                    $response['message']
                );
        }


        return redirect('/product-types');

    }
}
