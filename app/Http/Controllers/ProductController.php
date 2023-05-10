<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $products = Product::all();

        return response()->json([

            'data' =>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Product = Product::create($request->all());

        return response()->json([
            "data"=> $Product
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        return response ()->json([
            'data' =>$Product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $Product)
    {
        $Product->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        $Product->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
