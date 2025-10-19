<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cashOnDelivery(Request $request)
    {
        if($request->payment_type == 'esewa'){
           $order = new OrderController;
        return $order->store($request,'paid');
            
    }else{
        $order = new OrderController;
        return $order->store($request);
    }
        
    }
}
