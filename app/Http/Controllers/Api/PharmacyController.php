<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Pharmacy;
use App\PharmacyResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class PharmacyController extends ApiController
{
    public function register(Request $request, Pharmacy $pharmacy)
    {

        $pharmacy = Validator::make($request->all(),[
            'name'              => ['required', 'unique:pharmacies'],
            'owner'             => ['nullable'],
            'phone'             => ['nullable',],
            'password'          => ['required', 'password'],
            'license_number'    => ['nullable',],
            'long'              => ['nullable',],
            'lat'               => ['nullable',],
            'insurance'         => ['required','in:1,0'],
         ]);
        
       $pharmacy = Pharmacy::create($request->all());

       return response()
       ->json([
           'error' => false,
           'data' => $pharmacy,
           'message' => 'register successfully'],
           200);
    }


    public function login(Request $request, Pharmacy $pharmacy)
    {
        $pharmacy = Pharmacy::where(['password' => $request->password , 'name' => $request->name])->first();

        if ($pharmacy) {
            return response()
            ->json([
                'error' => false,
                'data' => ['name' => $pharmacy->name,'password' => $pharmacy->password],
                'message' => 'login successfully'],
                200);
        }

        return response()
        ->json([
            'error' => true,
            'data' => ['name' => $request->name,'password' => $request->password],
            'message' => 'user name or password not correct'],
            200);

    }

    
    public function response(Request $request)
    {  
        $data = Validator::make($request->all(),[
            'pharmacy_id'     => ['required'],
            'order_id'        => ['required'],
            'medicine_id'     => ['required'],
            'price'           => ['nullable'],
         ]);
            $pharmacy_response = PharmacyResponse::create($request->all());

            $order = Order::where(['id' => $request->order_id])->first();
 
            // check if the order exist
            if ($order != null) {

                // if order exist and the price more than 0 update order status to 3
                if ($request->price > 0) {
                    $order->order_status_id = 3;
                    $order->update($request->all());

                return response()
                ->json([
                    'error' => false,
                    'data' => $pharmacy_response,
                    'message' => 'medicine is available'],
                    200);
                }

                return response()
                ->json([
                    'error' => true,
                    'data' => $pharmacy_response,
                    'message' => 'medicine is not available'],
                    200);
            } else {

                return response()
                ->json([
                    'error' => true,
                    'data' => $pharmacy_response,
                    'message' => "order $pharmacy_response->order_id is not available"],
                    200);
            }
          


    }

}
