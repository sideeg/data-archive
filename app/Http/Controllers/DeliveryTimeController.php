<?php

namespace App\Http\Controllers;

use App\Order;
use App\DeliveryTime;
use App\OrderStatus;
use Illuminate\Http\Request;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_times =DeliveryTime::all();

        return view('deliverytimes.index', compact('delivery_times'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'delivery_time' => ['sometimes', 'nullable'],
        ]);

        DeliveryTime::create($data);

        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryTime $deliverytime)
    {
        return view('deliverytimes.edit' , compact('deliverytime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryTime $deliverytime)
    {
        $data = $request->validate([
            'delivery_time' => ['sometimes', 'nullable']
        ]);

        $deliverytime->update($data);

        return redirect()->route('deliverytimes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryTime  $deliveryTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryTime $deliverytime)
    {
        $deliverytime->delete();

        return back();
    }

    public function filter(Request $request)
    {
            
        $orders = Order::latest();
        if (request('byDeliverytime')) {
            
            $delivery_times = DeliveryTime::where('id' ,request('byDeliverytime'))->firstOrFail();

            $orders =   $orders->where('delivery_time_id', $delivery_times->id);
        }

        if (request('byOrderstatus')) {  

            $order_statuses = OrderStatus::where('order_status' ,request('byOrderstatus'))->firstOrFail();

            $orders =   $orders->where('order_status_id', $order_statuses->id);
        }
        
        
        $orders = $orders->get();
        $delivery_times = DeliveryTime::all();
        $order_statuses = OrderStatus::all();
        return view('deliverytimes.filter', compact('orders', 'delivery_times','order_statuses'));
    }

    
}
