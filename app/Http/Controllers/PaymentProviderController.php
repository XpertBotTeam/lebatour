<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\guiderequest;
use App\Models\guideinfo;
use App\Models\trip;
use App\Models\order;
use DB;

class PaymentProviderController extends Controller
{  
    function request(Request $request,$price,$trip_id) {
        
     $price =floatval($price)*$request->quantity;
     $quantity=$request->quantity;
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" .$price .
                    "&currency=EUR" .
                    "&paymentType=DB";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
     $res = json_decode($responseData,true);
      return view('dashboards.users.paymentform')->with(['res' => $res , 'id' => $trip_id , 'quantity' => $quantity ]);
    }
    

    function request2($quantity,$trip_id) {
      
      $id =request('id');
      $resourcePath =request('resourcePath');

      $url = "https://eu-test.oppwa.com/";
      $url .= $resourcePath;
      $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData,true);
        if(isset($res['id'])){
            //save in order table and take him a page saying that the order was  complete
            $order = new order;
           $order->total_amount  =$res['amount'];
           $order->bank_transaction_id  =$res['id'];
           $order->trip_id  = $trip_id;
           $order->number_of_person  = $quantity;
           $order->user_id  = auth()->user()->id;
           $order->save();
            return redirect()->route('User.spetrip',[$trip_id])->with('status','booked Added Successfully');


        }else{
            //take him to apage saying the transfer was not complete
            return redirect()->route('User.spetrip',[$trip_id])->with('status','unSuccessfully transaction');
        }
      
    }





}
