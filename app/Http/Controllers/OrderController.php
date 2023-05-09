<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class OrderController extends Controller
{


    public function construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index()
    {
        $orders = Order::all();

        return response()->json([

            'data' =>$orders
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
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
        ]);

        if ($validator->falls()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $Order = Order::create($input);

        for ($i = 0; $i < count($input['id_produk']); $i++) {
            OrderDetail::create([
                'id_order' => $Order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'size' => $input['size'][$i],
                'color' => $input['color'][$i],
                'total' => $input['total'][$i],
            ]);
        }
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Order $Order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $Order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $Order)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required',
        ]);

        if ($validator->falls()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        $Order ->update($input);

        OrderDetail::where('id_order',$Order['id'])->delete();

        for ($i = 0; $i < count($input['id_produk']); $i++) {
            OrderDetail::create([
                'id_order' => $Order['id'],
                'id_produk' => $input['id_produk'][$i],
                'jumlah' => $input['jumlah'][$i],
                'size' => $input['size'][$i],
                'color' => $input['color'][$i],
                'total' => $input['total'][$i],
            ]);
        }

        return response()->json([
            'message' => 'succes',
            'data' => $Order
        ]);
    }

    public function ubah_status(Request $request, Order $order){
        $order->update([
            'status' => $request->status
        ]);

        
        return response()->json([
            'message' => 'succes',
            'data' => $order
        ]);
    }

    public function dikonfirmasi()
{
    $orders = Order::where('status', 'Dikonfirmasi')->get();

    return response()->json([
        'data' => $orders
    ]);
}

public function dikemas()
{
    $orders = Order::where('status', 'Dikemas')->get();

    return response()->json([
        'data' => $orders
    ]);
}

public function dikirim()
{
    $orders = Order::where('status', 'Dikirim')->get();

    return response()->json([
        'data' => $orders
    ]);
}

public function diterima()
{
    $orders = Order::where('status', 'Diterima')->get();

    return response()->json([
        'data' => $orders
    ]);
}

public function selesai()
{
    $orders = Order::where('status', 'Selesai')->get();

    return response()->json([
        'data' => $orders
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $Order)
    {
 
      $Order->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
