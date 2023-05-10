<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class SliderController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $sliders = Slider::all();

        return response()->json([

            'data' =>$sliders
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
        $Slider = Slider::create($request->all());

        return response()->json([
            "data"=> $Slider
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Slider $Slider)
    {
        return response ()->json([
            'data' =>$Slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $Slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $Slider)
    {
        $Slider->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Slider
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $Slider)
    {
        $Slider->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
