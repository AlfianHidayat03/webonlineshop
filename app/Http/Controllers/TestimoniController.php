<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class TestimoniController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $testimonis = Testimoni::all();

        return response()->json([

            'data' =>$testimonis
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
        $Testimoni = Testimoni::create($request->all());

        return response()->json([
            "data"=> $Testimoni
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $Testimoni)
    {
        return response ()->json([
            'data' =>$Testimoni
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $Testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $Testimoni)
    {
        $Testimoni->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Testimoni
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $Testimoni)
    {
        $Testimoni->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
