@php
    if(auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Cart::where('user_id', $user_id)->get();
    } else {
        $temp_user_id = Session()->get('temp_user_id');
        if($temp_user_id) {
            $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
        }
    }
@endphp

<a href="javascript:void(0)" class="minicart-link" data-toggle="dropdown" data-display="static">
    <i class="icon icon-handbag"></i> 
    @if(isset($cart) && $cart->count() > 0)
    
        <span class="minicart-qty">{{ $cart->count()}}</span> 
        <span class="minicart-title">{{translate('Shopping Cart')}}</span> 
        @if($cart->count() > 0)
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem->product_id);
                    $total = $total + $cartItem->price*$cartItem->quantity;
                @endphp
            @endforeach
            <span class="minicart-total">{{ single_price($total) }}</span>
        @endif
    @else
        <span class="minicart-qty">0</span>
        <span class="minicart-title">{{translate('Shopping Cart')}}</span> 
        <span class="minicart-total">Rs. 0</span>
    @endif
</a>
<div class="minicart-drop dropdown-menu py-4 px-4" style="width: 80%; max-height: auto; top: 120px; left: 16%;">
    
    @if(isset($cart) && $cart->count() > 0)
        @if($cart->count() > 0)
            <div class="container">
                <div class="minicart-drop-close">CLOSE</div>
                <div class="minicart-drop-content">
                    <h3>{{translate('Recently added items:')}}</h3>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $key => $cartItem)
                    
                        @php
                            $product = \App\Product::find($cartItem['product_id']);
                            $total = $total + $cartItem->price*$cartItem->quantity;
                        @endphp
                        
                        @if ($product != null)
                        
                            <div class="minicart-prd mt-2">
                                <div class="minicart-prd-image">
                                    <a href="#">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" 
                                             data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             class="lazyload" 
                                             alt="{{  $product->getTranslation('name')  }}">
                                    </a>
                                </div>
                                <div class="minicart-prd-name">
                                    <h5><a href="#">{{  $product->getTranslation('name')  }}</a></h5>
                                    <h2><a href="#">{{  $product->getTranslation('name')  }}</a></h2>
                                </div>
                                <div class="minicart-prd-qty"><span>qty:</span> <b>{{ $cartItem->quantity }} x</b></div>
                                <div class="minicart-prd-price"><span>price:</span> <b>{{ single_price($cartItem->price) }}</b></div>
                                <div class="minicart-prd-action">
                                    <!--<a href="#" class="icon-heart js-label-wishlist"></a> -->
                                    <!--<a href="product.html" class="icon-pencil"></a> -->
                                    <a href="#" class="icon-cross js-product-remove stop-propagation" onclick="removeFromCart({{ $cartItem['id'] }})"></a>
                                </div>
                            </div>
                            
                        @endif
                        
                    @endforeach
                            
                            <div class="minicart-drop-total mt-2">
                                <div class="float-right"><span class="minicart-drop-summa"><span>{{translate('Subtotal:')}}</span> <b>{{ single_price($total) }}</b></span>
                                    <div class="minicart-drop-btns-wrap">
                                         
                                         @if(Auth::check())
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600">
                                        {{ translate('Continue to Shipping')}}
                                    </a>
                                @else
                                    <button class="btn btn-primary fw-600" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                                @endif
                                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn--alt"><i class="icon-handbag"></i><span>{{translate('Checkout')}}</span></a></div>
                                </div>
                                <div class="float-left"><a href="{{ route('cart') }}" class="btn btn--alt"><i class="icon-handbag"></i><span>{{translate('View cart')}}</span></a></div>
                            </div>
                    
                </div>
                    
            </div>
        @else
            <div class="container text-center" >
                <div class="minicart-drop-close">CLOSE</div>
                <div class="minicart-drop-content">
                    <h3>Your cart is empty :( </h3>
                </div>
            </div>
        @endif
    @else
     <div class="container text-center">
        <div class="minicart-drop-close">CLOSE</div>
        <div class="minicart-drop-content">
            <h3>Your cart is empty :( </h3>
        </div>
    </div>
    @endif
</div>