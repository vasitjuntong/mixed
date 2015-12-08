<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Product;
use App\ProductType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->all();
        $limit = 20;

        $products = Product::whereByFilter($filter, $limit);

        return view('products.index', [
            'products' => $products,
            'filter' => $filter,
        ]);
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

        if($request->file('file') != null){
            $data = $this->makePic(
                $request->file('file'),
                $data
            );
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
        $product = Product::find($id);

        $productTypes = ProductType::orderBy('id', 'desc')
            ->lists('name', 'id');
        $units = Unit::orderBy('id', 'desc')
            ->lists('name', 'id');

        return view('products.edit', compact(
            'product',
            'productTypes',
            'units'
        ));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        $data = array_except($request->all(), array(
            '_method',
            '_token',
        ));

        if($request->file('file') != null){
            $product->removePic();

            $data = $this->makePic(
                $request->file('file'),
                $data
            );
        }

        $product
            ->update($data);

        return redirect('/products');
    }

    public function destroy(Request $request, $id)
    {
        $response = Product::deleteByCondition($id);


        if($request->ajax())
            return $response;

        if($response['status']){
            flash()
                ->success(
                    trans('product.label.name'),
                    $response['message']
                );
        }else{
            flash()
                ->success(
                    trans('product.label.name'),
                    $response['message']
                );
        }


        return redirect('/products');
    }

    protected function makePic($file, $data)
    {
        $responseFile = Product::named($file->getClientOriginalName())
            ->move($file);

        $data['pic_name'] = $responseFile->pic_name;
        $data['pic_path'] = $responseFile->pic_path;
        $data['thumbnail_path'] = $responseFile->thumbnail_path;

        return $data;
    }
}
