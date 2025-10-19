<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Order;
use App\BusinessSetting;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
class EsewaController extends Controller
{
    public function success(Request $request)
    {
         $orderController = new OrderController;
            $orderController->store($request);

            $request->session()->put('payment_type', 'cart_payment');
            
             if(Session::has('payment_type')){
    
            if(Session::get('payment_type') == 'cart_payment'){
                $order = Order::findOrFail(Session::get('order_id'));
                $amount = $order->grand_total;
            }
            elseif (Session::get('payment_type') == 'wallet_payment') {
                $amount = Session::get('payment_data')['amount'];
            }
            elseif (Session::get('payment_type') == 'customer_package_payment') {
                $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
                $amount = $customer_package->amount;
            }
            elseif (Session::get('payment_type') == 'seller_package_payment') {
                $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
                $amount = $seller_package->amount;
            }
        }
       
  
    	if( isset($request->oid) && isset($request->amt) && isset($request->refId))
    	{
    		//$order = Order::where('invoice_no', $request->oid)->first();
    		//dd($order);
    		if( $order)
    		{
    			$url = "https://uat.esewa.com.np/epay/transrec";
				$data =[
				    'amt'=> $amount,
				    'rid'=> $request->refId,
				    'pid'=> $request->oid,
				    'scd'=> 'NP-ES-TILICHO'
				];

			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_POST, true);
			    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    $response = curl_exec($curl);
			    //dd($response);
			    curl_close($curl);

			    $response_code = $this->get_xml_node_value('response_code',$response );
			  
			    if( trim($response_code) == 'Success')
			    {
			        // If call returns body in response, you can get the deserialized version from the result attribute of the response
            if($request->session()->has('payment_type')){
                if($request->session()->get('payment_type') == 'cart_payment'){
                    $checkoutController = new CheckoutController;
                    return $checkoutController->checkout_done($request->session()->get('order_id'), json_encode($response));
                }
                elseif ($request->session()->get('payment_type') == 'wallet_payment') {
                    $walletController = new WalletController;
                    return $walletController->wallet_payment_done($request->session()->get('payment_data'), json_encode($response));
                }
                elseif ($request->session()->get('payment_type') == 'customer_package_payment') {$customer_package_controller = new CustomerPackageController;
                    return $customer_package_controller->purchase_payment_done($request->session()->get('payment_data'), json_encode($response));
                }
                elseif ($request->session()->get('payment_type') == 'seller_package_payment') {$seller_package_controller = new SellerPackageController;
                    return $seller_package_controller->purchase_payment_done($request->session()->get('payment_data'), json_encode($response));
                }
            }
			    	// $order->status = 1;
			    	// $order->save();
			    	// return redirect()->route('payment.response')->with('success_message', 'Transaction completed.');
			    }
    		}	

    		
    	}

    }

     public function fail(Request $request)
     {
     	echo 'You have cancelled your transaction .';
     	dd($request->all());
     }

    public function get_xml_node_value($node, $xml) {
	    if ($xml == false) {
	        return false;
	    }
	    $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.
	            '</'.$node.'>#s', $xml, $matches);
	    if ($found != false) {
	        
	            return $matches[1]; 
	         
	    }	  

    return false;
	}

	public function payment_response()
	{
		return view('response-page');
	}
}
