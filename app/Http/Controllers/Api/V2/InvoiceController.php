<?php

namespace App\Http\Controllers\Api\V2;;

use Illuminate\Http\Request;
use App\Order;
use Session;
use PDF;
use Auth;
use Config;

class InvoiceController extends Controller
{
    //download invoice
    public function invoice_download($id)
    {
        

        $order = Order::findOrFail($id);
        	$logo = get_setting('header_logo');
        if(!empty($order)){
             $data = array();
             $order_details = array();
             
             foreach ($order->orderDetails as $key => $orderDetail){
                 $varient = null;
                
                 $delevery_type = null;
                 $pickuppointname = null;
                 
                 if ($orderDetail->product != null){
                       if($orderDetail->variation != null){
                     
                    $varient = $orderDetail->variation; 
                 }
                     
                     if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery'){
                         $delevery_type = 'Home Delivery';
                     }elseif($orderDetail->shipping_type == 'pickup_point'){
                         if ($orderDetail->pickup_point != null){
                             $delevery_type = 'Pickup point';
                             $pickuppointname = $orderDetail->pickup_point->getTranslation('name');
                             
                         }
                     }
									
                          $order_details[] = array(
                     
                     'product_name'=>$orderDetail->product->name,
                     'varient'=>$varient,
                     'delevery_type'=>$delevery_type,
                     'pickup_point_name'=>$pickuppointname,
                     'quantity'=> $orderDetail->quantity,
                     'unit_price'=>single_price($orderDetail->price/$orderDetail->quantity),
                     'tax'=>single_price($orderDetail->tax/$orderDetail->quantity),
                     'total'=>single_price($orderDetail->price+$orderDetail->tax),
                     
                     );
                     }
                
                 
             }
        
        $data= array(
            'logo'=>uploaded_asset($logo),
            'address'=>get_setting('contact_address'),
            'email'=>get_setting('contact_email'),
            'order_id'=>$order->code,
            'date'=>date('d-m-Y', $order->date),
            'shipping_address'=>json_decode($order->shipping_address),
            'order_details'=>$order_details,
            'sub_total'=> single_price($order->orderDetails->sum('price')),
            // 'shipping_cost'=> single_price($order->orderDetails->sum('shipping_cost')),
            'shipping_cost' => single_price(get_setting('flat_rate_shipping_cost')),
            'total_tax'=> single_price($order->orderDetails->sum('tax')),
            'discount'=> single_price($order->coupon_discount),
            'grand_total'=> single_price($order->grand_total),
            
            
            );
            
          return response()->json(['result' => $data, 'message' =>'Order Data list']);
        }else{
         return response()->json(['result' => false, 'message' =>'Order not found']);
        }
        
       
        // return PDF::loadView('backend.invoices.invoice',[
        //     'order' => $order,
        //     'font_family' => $font_family,
        //     'direction' => $direction,
        //     'text_align' => $text_align,
        //     'not_text_align' => $not_text_align
        // ], [], [])->download('order-'.$order->code.'.pdf');
    }
}
