@php
    $header_logo = get_setting('header_logo');
@endphp

<div id="mySidepanel" class="sidepanel" style="z-index:10000;">
    <a href="javascript:void(0)" class="closebtn sidemenu-close" onclick="closeNav()">
        <span class="float-right mr-4">CLOSE</span>
    </a>
    <div class="sidenav-wrapper mt-5" style="height: auto;">
        <ul style="nav list-style-type:none;  padding-left: 0; display:block; background-color:white;">

          <li style="cursor:pointer">
            <a class="nav-level-1 py-3" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
              Menu 1
              <span class="arrow">
                <i class="icon icon-angle-right"></i>
              </span>
            </a>
            <div class="collapse" id="menu1">
                    <ul style="list-style-type:none;">
                        <li>
                            <a href="#">Category One</a>    
                        </li>
                        <li>
                            <a href="#">Category Two</a>    
                        </li>
                        <li>
                            <a href="#">Category Three</a>    
                        </li>
                        <li>
                            <a href="#">Category Four</a>    
                        </li>
                    </ul>
                </div>
          </li>
          
          <li>
            <a class="nav-level-1 py-3" data-toggle="collapse" href="#menu2" role="button" aria-expanded="false" aria-controls="menu2">
              Menu 2
              <span class="arrow">
                <i class="icon icon-angle-right"></i>
              </span>
            </a>
            <div class="collapse" id="menu2">
                    <ul style="list-style-type:none;">
                        <li>
                            <a href="#">Category One</a>    
                        </li>
                        <li>
                            <a href="#">Category Two</a>    
                        </li>
                        <li>
                            <a href="#">Category Three</a>    
                        </li>
                        <li>
                            <a href="#">Category Four</a>    
                        </li>
                    </ul>
                </div>
          </li>
          
          <li style="cursor:pointer">
            <a class="nav-level-1 py-3" data-toggle="collapse" href="#menu3" role="button" aria-expanded="false" aria-controls="menu3">
              Menu 3
              <span class="arrow">
                <i class="icon icon-angle-right"></i>
              </span>
            </a>
            <div class="collapse" id="menu3">
                    <ul style="list-style-type:none;">
                        <li>
                            <a href="#">Category One</a>    
                        </li>
                        <li>
                            <a href="#">Category Two</a>    
                        </li>
                        <li>
                            <a href="#">Category Three</a>    
                        </li>
                        <li>
                            <a href="#">Category Four</a>    
                        </li>
                    </ul>
                </div>
          </li>
          
          <li style="cursor:pointer">
            <a class="nav-level-1 py-3">
              Menu 4
            </a>
          </li>
          
          <li style="cursor:pointer">
            <a class="nav-level-1 py-3">
              Menu 5
            </a>
          </li>
      </ul>
    </div>
</div>


<header class="hdr global_width hdr_sticky hdr-mobile-style2 ">
     <!--Promo TopLine -->
    @if($business->promo_line != '')
        @if($business->promo_option == 'color')
            <div class="bgcolor" style="background-color: {{ $business->promo_bgcolor }}" id="promo-box-wrapper">
        @else
            <div class="bgcolor" style="background-image: url({{ static_asset('assets/img/promo-topline-bg.png') }});" id="promo-box-wrapper">
        @endif
            <div class="promo-topline">
                <div class="container">
                    <!--<div class="promo-topline-item"><b>GET 20% OFF YOUR FIRST ORDER WITH CODE <span style="color: #000">VSARV</span>&nbsp;<span class="hidden-xs">&nbsp;|&nbsp;&nbsp; FREE GROUND SHIPPING OVER Rs. 500</span></b></div>-->
                    <div class="promo-topline-item" style="color: {{ $business->promo_fontcolor }}"><b>{{ $business->promo_line }}</b></div>
                </div><a href="#" class="promo-topline-close js-promo-topline-close close-promo-box"><i class="icon-cross"></i></a>
            </div>
        </div>
         <!--/Promo TopLine -->
    @endif
    
    <div class="hdr-mobile show-mobile">
        <div class="hdr-content">
            <div class="container">
                 <!--Menu Toggle -->
                <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
                 <!--/Menu Toggle -->
                <div class="logo-holder">
                    <a href="#" class="logo">
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                        @endif
                    </a>
                </div>
                <div class="hdr-mobile-right">
                    <div class="hdr-topline-right links-holder"></div>
                    <div class="minicart-holder"></div>
                </div>
            </div>
        </div>
    </div>
    
     <!--top header for desktop -->
    <div class="hdr-desktop hide-mobile sticky-top">
        
        <div class="hdr-topline">
            <div class="container">
                <div class="row">
                    <div class="col-auto hdr-topline-left">
                         <!--Header Language -->
                        @php
                            if(Session::has('locale')){
                                $locale = Session::get('locale', Config::get('app.locale'));
                            }
                            else{
                                $locale = 'en';
                            }
                        @endphp
                        
                        <div class="dropdown">
                            <div class="dropdn dropdn_caret dropdown" id="lang-change">
                                <a  href="javascript:void(0)" class="dropdn-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                {{ \App\Language::where('code', $locale)->first()->name }}
                            </a>
                            <div class="dropdown-menu z-1035" aria-labelledby="dropdownMenuButton">
                                    @foreach (\App\Language::all() as $key => $language)
                                    <a href="javascript:void(0)" class="dropdown-item @if($locale == $language) active @endif"  data-flag="{{ $language->code }}" href="#">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                    <span class="language">{{ $language->name }}</span>
                                    </a>
                                    @endforeach
                            </div>
                            </div>
                        </div>
                         <!--/Header Language -->
                         <!--Header Currency -->
                            @php
                            if(Session::has('currency_code')){
                                $currency_code = Session::get('currency_code');
                            }
                            else{
                                $currency_code = \App\Models\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                            }
                            @endphp 
                            <div class="dropdown">
                            <div class="dropdn dropdn_caret dropdown" id="lang-change">
                                <a  href="javascript:void(0)" class="dropdn-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                {{ \App\Models\Currency::where('code', $currency_code)->first()->name }} {{ (\App\Models\Currency::where('code', $currency_code)->first()->symbol) }}
                            </a>
                            <ul class="z-1035 dropdown-menu menu-item animate-dropdown" aria-labelledby="dropdownMenuButton" style="min-width: 17rem !important;">
                                    @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                    <form method="post" action="{{route('currencies',$currency->code)}}">
                                    @csrf
                                    <li class="menu-item animate-dropdown @if($currency_code == $currency->code) active @endif">
                                    <a onClick="this.closest('form').submit()" class="dropdown-item"  data-currency="{{ $currency->code }}" href="#">
                                    {{ $currency->name }} ({{ $currency->symbol }})
                                    </a>
                                    </li>
                                </form>
                                    @endforeach
                            </ul>
                            </div>
                        </div>
                        
                         <!--/Header Currency -->
                    </div>
                    <div class="col hdr-topline-center">
                        <div class="custom-text">{{ $business->header_msg }}</div>
                        @if($business->phone != null)
                            <div class="custom-text"><i class="icon icon-mobile"></i><b>{{ $business->phone }}</b></div>
                        @endif
                    </div>
                    <div class="col-auto hdr-topline-right links-holder">

                         <!--Header Wishlist -->
                        <div class="dropdn dropdn_wishlist"><a href="{{ route('wishlists.index') }}" class="dropdn-link"><i class="icon icon-heart-1"></i><span>Wishlist</span></a></div>
                         <!--/Header Wishlist -->
                         <!--Header Wishlist -->
                        <div class="dropdn dropdn_wishlist"><a href="{{ route('compare') }}" class="dropdn-link"><i class="icon icon-return"></i><span>{{translate('Compare')}}</span></a></div>
                         <!--/Header Wishlist -->
                        
                         <!--Header Account -->
                        @auth
                            @if(isAdmin())
                                <div class="dropdn dropdn_wishlist"><a href="{{ route('admin.dashboard') }}" class="dropdn-link"><i class="icon icon-person"></i><span>{{ translate('My Panel')}}</span></a></div>
                            @else
                                <div class="dropdn dropdn_wishlist"><a href="{{ route('dashboard') }}" class="dropdn-link"><i class="icon icon-person"></i><span>{{ translate('My Panel')}}</span></a></div>
                            @endif
                            <!--route for logout-->
                        @else
                            <div class="dropdn dropdn_wishlist"><a href="{{ route('user.login') }}" class="dropdn-link"><i class="icon icon-person"></i><span>{{ translate('Login') }}</span></a></div>
                        @endauth                        
                         <!--/Header Account -->
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="sticky-top z-1020  hdr-content hide-mobile" style="background-color:white;color:#656565; height:120px; line-height:120px;">
            <div class="position-relative logo-bar-area z-1">
                <div class="container">
                <div class="row">
                    
                    <div class="col-auto logo-holder mr-3">
                        <a href="{{ route('home') }}" class="logo">
                            @if($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" style="height:90px;">
                            @else
                                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                            @endif
                        </a>
                    </div>
                   
                    <div class="col-auto ml-auto">
                        <button class="btn shadow delivery-btn" data-toggle="modal" data-target="#myLocationModal">
                            <span style="text-transform:none; letter-spacing:normal;">
                                <i class="icon-location1"></i>
                                    Select Delivery Location
                                <i class="icon-angle-right" style="font-size:10px; margin-top:1px;"></i>
                            </span>
                        </button>
                    </div>

                    <div class="col-auto  flex-grow-1 front-header-search d-flex align-items-center bg-white">
                        <div class="position-relative flex-grow-1">
                            <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                <div class="d-flex position-relative align-items-center">
                                    <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                        <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="border-0 border-lg form-control" id="search" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off" style="top:40px;">
                                        <div class="input-group-append d-none d-lg-block">
                                            <button class="btn" type="submit">
                                                <i class="la la-search la-flip-horizontal fs-10"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                                <div class="search-preloader absolute-top-center">
                                    <div class="dot-loader"><div></div><div></div><div></div></div>
                                </div>
                                <div class="search-nothing d-none p-3 text-center fs-16">
    
                                </div>
                                <div id="search-content" class="text-left">
    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-none d-lg-none ml-3 mr-0 mt-1">
                        <div class="nav-search-box">
                            <a href="#" class="nav-box-link">
                                <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-auto minicart-holder">
                        <div class="minicart minicart-js">
                            <a href="javascript:void(0)" class="minicart-link" data-toggle="dropdown" data-display="static">
                                <i class="icon icon-handbag"></i> 
                                @if(Session::has('cart'))
                                    <span class="minicart-qty">{{ count(Session::get('cart'))}}</span> 
                                    <span class="minicart-title">{{translate('Shopping Cart')}}</span> 
                                    @if(count($cart = Session::get('cart')) > 0)
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($cart as $key => $cartItem)
                                            @php
                                                $total = $total + $cartItem['price']*$cartItem['quantity'];
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
                                @if(Session::has('cart'))
                                    @if(count($cart = Session::get('cart')) > 0)
                                        <div class="container">
                                            <div class="minicart-drop-close">CLOSE</div>
                                            <div class="minicart-drop-content">
                                                <h3>{{translate('Recently added items:')}}</h3>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach($cart as $key => $cartItem)
                                                
                                                    @php
                                                        $product = \App\Product::find($cartItem['id']);
                                                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                    @endphp
                                                    
                                                    @if ($product != null)
                                                    
                                                        <div class="minicart-prd mt-2">
                                                            <div class="minicart-prd-image">
                                                                <a href="#">
                                                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}" 
                                                                         data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                         class="lazyload" 
                                                                         alt="{{  $product->getTranslation('name')  }}">
                                                                </a></div>
                                                                <div class="minicart-prd-name">
                                                                    <h5><a href="#">{{  $product->getTranslation('name')  }}</a></h5>
                                                                    <h2><a href="#">{{  $product->getTranslation('name')  }}</a></h2>
                                                                </div>
                                                                <div class="minicart-prd-qty"><span>qty:</span> <b>{{ $cartItem['quantity'] }} x</b></div>
                                                                <div class="minicart-prd-price"><span>price:</span> <b>{{ single_price($cartItem['price']) }}</b></div>
                                                                <div class="minicart-prd-action">
                                                                    <!--<a href="#" class="icon-heart js-label-wishlist"></a> -->
                                                                    <!--<a href="product.html" class="icon-pencil"></a> -->
                                                                    <a href="#" class="icon-cross js-product-remove stop-propagation" onclick="removeFromCart({{ $key }})"></a>
                                                                </div>
                                                        </div>
                                                        
                                                    @endif
                                                    
                                                @endforeach
                                                        
                                                        <div class="minicart-drop-total mt-2">
                                                            <div class="float-right"><span class="minicart-drop-summa"><span>{{translate('Subtotal:')}}</span> <b>{{ single_price($total) }}</b></span>
                                                                <div class="minicart-drop-btns-wrap">
                                                                    <a href="{{ route('checkout.shipping_info') }}" class="btn">
                                                                        <i class="icon-check-box"></i><span>{{translate('Checkout')}}</span>
                                                                    </a> 
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
                        </div>
                    </div>
                    
                     <div class="col-auto">
                        <a href="/shops/create" class="be-seller-btn">
                            <i class="icon icon-handbag mr-1"></i> 
                            {{translate('Be a Seller')}} 
                        </a>
                    </div>
                    
                </div>
            </div>
            </div>
        </div>

    </div>
  
     @if ( get_setting('header_menu_labels') !=  null )
        <div class="hide-mobile" style="min-height: 45px; border-top-width:1px; border-top-style:solid; border-color:#f7f7f7; background-color:#fff;">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <ul class="list-inline mb-0 pr-0 mobile-hor-swipe">
                            <li class="list-inline-item mr-0"> 
                                <a href="#" class="mobilemenu-toggle openbtn" onclick="openNav()">
                                   <i class="icon icon-menu"></i>
                                   <span>All</span>   
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-8">
                        <div style="line-height: 50px; cursor:pointer; text-decoration: none; margin-left:150px;">
                            @if ( get_setting('header_menu_labels') !=  null )
                                @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                    <a class="pr-4 navigation-text" href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}">{{ translate($value) }}</a>
                                @endforeach
                            @endif
                            <div class="dropdown" style="position:relative;">
                                <a class="dropbtn pr-4 navigation-text">
                                    All Categories
                                    <i class="icon icon-angle-down ml-1"></i>
                                </a>
                                <div class="dropdown-content">
                                    <div class="container">  
                                      <div class="row">
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Shoes</h3>
                                          <a href="#" class="submenu-text">Boots</a>
                                          <a href="#" class="submenu-text">Flats</a>
                                          <a href="#" class="submenu-text">Sneakers</a>
                                          <a href="#" class="submenu-text-link">View More</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Tops</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Bottoms</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Accessories</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Bags</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown" style="position:relative;">
                                <a class="dropbtn navigation-text">
                                    All Brands
                                    <i class="icon icon-angle-down ml-1"></i>
                                </a>
                                <div class="dropdown-content">
                                    <div class="container">  
                                      <div class="row">
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Brand 1</h3>
                                          <a href="#" class="submenu-text">Boots</a>
                                          <a href="#" class="submenu-text">Flats</a>
                                          <a href="#" class="submenu-text">Sneakers</a>
                                          <a href="#" class="submenu-text-link">View More</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Tops</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Bottoms</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Accessories</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                        <div class="col menu-col">
                                          <h3 class="submenu-title mb-2">Bags</h3>
                                          <a href="#" class="submenu-text">Link 1</a>
                                          <a href="#" class="submenu-text">Link 2</a>
                                          <a href="#" class="submenu-text">Link 3</a>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    @endif
</header>

 <!--The Modal -->
 <div class="modal fade" id="myLocationModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content px-4 py-4">
      
         <!--Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select your delivery location</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
         <!--Modal body -->
        <div class="modal-body">
          <span class="d-block mb-2">Where would you like to get the product delivered?</span>
          <form>
              <div class="form-group mt-2">
                <input type="number" class="form-control" placeholder="Enter Pincode" id="pincode">
              </div>
          </form>
        </div>
        
         <!--Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-dismiss="modal">Continue</button>
        </div>
        
      </div>
    </div>
  </div>

