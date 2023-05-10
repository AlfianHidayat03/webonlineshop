<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class SubcategoryController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $subcategories = Subcategory::all();

        return response()->json([

            'data' =>$subcategories
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
        $Subcategory = Subcategory::create($request->all());

        return response()->json([
            "data"=> $Subcategory
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $Subcategory)
    {
        return response ()->json([
            'data' =>$Subcategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $Subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $Subcategory)
    {
        $Subcategory->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Subcategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $Subcategory)
    {
        $Subcategory->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
