<?php

namespace App\Http\Controllers\Api;
use App\User;
use App\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    
    public function login(Request $request,User $user)
    {

        $user = User::where('phone', $request->phone)->first();
            $otp = mt_rand(1111,9999);

            // login user if user existing
            if ($user) {
                $user->otp = $otp;

                $user->otp == $otp ? $user->otp : $user->otp = $otp  ;

                // send verification number to user phone number
                $this->otp($user);

                // update user otp
                $user->update($request->all());

                return response()->json([
                "error" => false,
                 "data" => $user,
                 "message" => "please verify your number with this code $user->otp",], 200);
                 

            } else {

                //register user if it's not existing
                $user = Validator::make($request->all(),[
                    'name' => ['required','min:3'],
                    'phone' => ['required','integer'],
                    'otp' => ['sometimes','nullable']
                 ]);
                
                $user = User::create($request->all());
                 
                 $user->otp = $otp;

                 // send verification number to user phone number
                 $this->otp($user);
                 $response = Http::post("https://mazinhost.com/smsv1/sms/api?action=send-sms&api_key=c2lkZWVnOjEyNzg0NTAzNjk=&to=249$user->phone&from=afia&sms=$user->otp");
                $user->update($request->all());
                
                
                
            }
        
    }

    public function otp($user)
    {
 
        $response = Http::post("https://mazinhost.com/smsv1/sms/api?action=send-sms&api_key=c2lkZWVnOjEyNzg0NTAzNjk=&to=249$user->phone&from=afia&sms=$user->otp");

    }

    public function verifyOtp(Request $request,$id)
    {
        $user = User::find($id);

        $otp = Validator::make($request->all(),[
            'otp' => ['sometimes','nullable']
         ]);

         
         if ($user->otp == $request->otp) {

            return response()->json([
            "error" => false,
            'data' => $user,
            'message' => "your number is verified now",], 200);

         } else {

            return response()->json([
                "error" => true,
                "data" => $user,
                "message" => "you enter invalid number ",], 200);
         }
    }


    public function Getorder($user_id)
    {

        $user = User::find($user_id);

        if ($user) {

            return response()->json([
            "error" => false,
            "data" => $user->orders,
            "message" => "user orders",], 200);

        } elseif (!$user) {
            return response()->json([
                "error" => true,
                "data" => $user,
                "message" => "there is no user with this id",], 200);
        } 
        
    }

    public function Postorder(Request $request)
    {
        Log::emergency($request);
        $order = Validator::make($request->all(),[
            'pation_name'           => ['required','string'],
            'phone'                 => ['required','integer'],
            'prescription_photo'    => ['sometimes','nullable','image','mimes:jepg,png,jpg,gif,svg', 'max:4096'],
            'medicine_name'         => ['sometimes','nullable'],
            'insurance_card_photo'  => ['sometimes','nullable','image','mimes:jepg,png,jpg,gif,svg', 'max:4096'],
            'insurance'             => ['in:1,0'],
            'user_id'               => ['required'],
            'order_status_id'       => ['nullable']
         ]);

        $request['order_status_id'] = 1;

        $order = Order::create($request->all());
        

        $images_names = ['prescription_photo','insurance_card_photo'];

        foreach($images_names as $image){

            if ($request->file($image)){

                $image_name = md5($order->id."app".$order->id . rand(1,1000));
            
                $image_ext = $request->file($image)->getClientOriginalExtension(); // example: png, jpg ... etc
                
                $image_full_name = $image_name . '.' . $image_ext;
        
                $uploads_folder =  getcwd() .'/images/';
        
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                 
                Log::emergency("image_ext + ".$image_ext."++image_name++".$image_full_name);
                $request->file($image)->move($uploads_folder, $image_name  . '.' . $image_ext);
                
    
               $order->{$image} =  $image_full_name;
            }
        }
        $order->save();
        return response()->json([
            'error' => false,
            'data' => $order,
            'message' => "order created successfully ",], 200);
    }


}