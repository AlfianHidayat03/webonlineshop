<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class MemberController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $members = Member::all();

        return response()->json([

            'data' =>$members
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
        $Member = Member::create($request->all());

        return response()->json([
            "data"=> $Member
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $Member = Member::create($input);

        return response()->json([
            "data"=> $Member
        ]);
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Member $Member)
    {
        return response ()->json([
            'data' =>$Member
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $Member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Member $Member)

    {
        $Member->update($request->all());


        return response()->json([
            'message' => 'success',
            'data' => $Member
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Member $Member)

    {
        $Member->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }

}