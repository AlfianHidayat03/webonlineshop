<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class ReviewController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $reviews = Review::all();

        return response()->json([

            'data' =>$reviews
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
        $Review = Review::create($request->all());

        return response()->json([
            "data"=> $Review
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Review $Review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $Review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $Review)
    {
        $Review->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $Review)
    {
        $Review->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
