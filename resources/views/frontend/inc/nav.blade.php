<?php 
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
?>@php
    $header_logo = get_setting('header_logo');
    $business = App\Models\GeneralSetting::first();
    $categories = \App\Category::where('level', 0)->orderBy('order_level', 'asc')->get();
   
    $brands = App\Models\Brand::orderBy('created_at', 'desc')->get();
@endphp
<!--style="background-color:{{ get_setting('footer1_bg_color') }}; color:{{ get_setting('footer1_font_color') }};"-->
@if(get_setting('promo_bar') == 1 )
    @if($business->promo_line != '')
        @if($business->promo_option == 'color')
            <div class="bgcolor" style="background-color: {{ $business->promo_bgcolor }}" id="promo-box-wrapper">
        @else
            <div class="bgcolor" style="background-image: url({{ static_asset('assets/img/promo-topline-bg.png') }});" id="promo-box-wrapper">
        @endif
            <div class="promo-topline" >
                <div class="container">
                    <!--<div class="promo-topline-item"><b>GET 20% OFF YOUR FIRST ORDER WITH CODE <span style="color: #000">VSARV</span>&nbsp;<span class="hidden-xs">&nbsp;|&nbsp;&nbsp; FREE GROUND SHIPPING OVER Rs. 500</span></b></div>-->
                    <div class="promo-topline-item" style="color: {{ $business->promo_fontcolor }}"><b>{{ $business->promo_line }}</b></div>
                </div><a href="#" class="promo-topline-close js-promo-topline-close close-promo-box"><i class="icon-cross"></i></a>
            </div>
        </div>
         <!--/Promo TopLine -->
    @endif
@endif

<div id="mySidepanel" class="mySidepanel sidepanel" style="z-index:10000;">
    <a href="javascript:void(0)" class="closebtn sidemenu-close" onclick="closeNav()">
        <span class="float-right mr-4">CLOSE</span>
    </a>
    <div class="sidenav-wrapper" style="height: auto;">

        <ul style="nav list-style-type:none;  padding-left: 0; display:block; background-color:white;margin-top:-5px !important;">
            <!--<li style="cursor:pointer">-->
            <!--            <a class="nav-level-1 py-3" data-toggle="collapse" href="#all-cat" role="button" aria-expanded="false" aria-controls="all-cat">-->
            <!--             ALL CATEGORIES-->
            <!--              <span class="arrow">-->
            <!--                <i class="icon icon-angle-right"></i>-->
            <!--              </span>-->
            <!--            </a>-->
                         <!--sub categories-->
            <!--            <div class="collapse" id="all-cat">-->
            <!--                <ul style="list-style-type:none;">-->
            <!--                      @foreach ($categories as $key => $category)-->
            <!--                    <li style="cursor:pointer">-->
            <!--                        <a href="{{ route('products.category', $category->slug) }}">-->
            <!--                            {{ $category->name }}-->
            <!--                         </a>-->
            <!--                    </li>-->
            <!--                     @endforeach-->
            <!--                </ul>-->
            <!--            </div>-->
            <!--        </li>-->
                   
            @foreach ($categories as $key => $category)
                @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                    <li style="cursor:pointer">
                        <a class="nav-level-1 py-3" data-toggle="collapse" href="#menu-{{ $category->id }}" role="button" aria-expanded="false" aria-controls="menu-{{ $category->id }}">
                          {{ $category->name }}
                          <span class="arrow">
                            <i class="icon icon-angle-right"></i>
                          </span>
                        </a>
                        <!-- sub categories-->
                        <div class="collapse" id="menu-{{ $category->id }}">
                            <ul style="list-style-type:none;">
                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                <li>
                                    <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>    
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @else
                      <li style="cursor:pointer"><a href="{{ route('products.category', $category->slug) }}" >
                          {{ $category->name }}
                          
                        </a>
                       
                    </li>
                @endif
            @endforeach
              <!--<li style="cursor:pointer">-->
              <!--          <a class="nav-level-1 py-3" data-toggle="collapse" href="#all-brand" role="button" aria-expanded="false" aria-controls="all-brand">-->
              <!--            All Brands-->
              <!--            <span class="arrow">-->
              <!--              <i class="icon icon-angle-right"></i>-->
              <!--          </a>-->
              <!--              <div class="collapse" id="all-brand">-->
              <!--              <ul style="list-style-type:none;">-->
              <!--                   @foreach($brands as $brand)-->
              <!--                  <li style="cursor:pointer">-->
              <!--                       <a href="{{ route('products.brand', $brand->slug) }}">-->
              <!--                          {{ $brand->name }}-->
              <!--                      </a>-->
              <!--                  </li>-->
              <!--                   @endforeach-->
              <!--              </ul>-->
              <!--          </div>-->
              <!--       </li>-->
                     <!--<li style="cursor:pointer">-->
                     <!--   <a class="nav-level-1 py-3" href="#menu">-->
                     <!--     FLASH SALE-->
                     <!--     <span class="menu-label menu-label--color3">Hurry Up!</span>-->
                     <!--   </a>-->
                     <!--</li>-->
                     <!--<li style="cursor:pointer">-->
                     <!--   <a class="nav-level-1 py-3" href="#menu">-->
                     <!--    BLOGS-->
                     <!--   </a>-->
                     <!--</li>-->
             
      </ul>
    </div>
    <!--<div class="menu-bottom">-->
    <!--    <div class="menu-currency">-->
    <!--        <div class="dropdn dropdn_caret">-->
    <!--            <a hre="#" class="dropdn-link">$ USD</a>-->
    <!--            <div class="dropdn-content">-->
    <!--                <div class="container">-->
    <!--                    <ul>-->
    <!--                        <li class="active">-->
    <!--                            <a href="#">-->
    <!--                                <span>$ USD</span>-->
    <!--                                <span>UD Dollars</span>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li>-->
    <!--                            <a href="#">-->
    <!--                                <span>€ EUR</span>-->
    <!--                                <span>Euro</span>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                         <li >-->
    <!--                            <a href="#">-->
    <!--                                <span> £ GBP</span>-->
    <!--                                <span>UK Pounds</span>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                         <li >-->
    <!--                            <a href="#">-->
    <!--                                <span>$ CAD</span>-->
    <!--                                <span>Canadian Dollars</span>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--            </div>-->
                
    <!--        </div>-->
            
    <!--    </div>-->
    <!--    <div class="menu-language">-->
    <!--          <div class="dropdn dropdn_caret">-->
    <!--            <a hre="#" class="dropdn-link">ENG</a>-->
    <!--            <div class="dropdn-content">-->
    <!--                <div class="container">-->
    <!--                    <ul>-->
    <!--                        <li class="active">-->
    <!--                            <a href="#">-->
    <!--                                <img src="{{ static_asset('assets/img/flags/en1.png') }}"/>-->
    <!--                                English-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li>-->
    <!--                            <a href="#">-->
    <!--                               <img src="{{ static_asset('assets/img/flags/sp.png') }}"/>-->
    <!--                                Spanish-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                         <li >-->
    <!--                            <a href="#">-->
    <!--                               <img src="{{ static_asset('assets/img/flags/de1.png') }}"/>-->
    <!--                                German-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                         <li >-->
    <!--                            <a href="#">-->
    <!--                                <img src="{{ static_asset('assets/img/flags/fr1.png') }}"/>-->
    <!--                                French-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--            </div>-->
                
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="social-icons" style="cursor:pointer;display:flex;">-->
             <!--<span style="margin-left:17px;font-weight:bold;color:black;">Find Us on</span> -->
    <!--         <a href="https://facebook.com/" target="_blank" class="icon icon-facebook"></a>-->
    <!--         <a href="https://www.twitter.com" target="_blank" class="icon icon-twitter"></a>-->
    <!--         <a href="www.instagram.com" target="_blank" class="icon icon-instagram"></a>-->
    <!--         <a href="https://www.youtube.com" target="_blank" ><i class="icon-youtube"></i></a>-->
    <!--         <a href="https://www.linkedin.com" target="_blank" class="icon icon-linkedin"></a>-->
                <!--<a href="#menu">-->
                <!--    <i class="icon-facebook"></i> -->
                <!--</a>-->
                <!--<a  href="#menu">-->
                <!--    <i class="icon-pinterest"></i> -->
                <!--</a>-->
                <!-- <a  href="#menu">-->
                <!--    <i class="icon-instagram"></i> -->
                <!--</a>-->
    <!--    </div>-->
    <!--</div>-->
</div>


<header class="hdr global_width hdr_sticky hdr-mobile-style2 ">
     <!--Promo TopLine -->
    
    <div class="hdr-mobile show-mobile">
        <div class="hdr-content">
            <div class="container">
               
                 <!--Menu Toggle -->
                <div class="menu-toggle"><a href="#" class="mobilemenu-toggle openbtn" onclick="openNav()"><i class="icon icon-menu"></i></a></div>
                 <!--/Menu Toggle -->
                 
                <div class="logo-holder">
                    <a href="{{ route('home') }}" class="logo">
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                        @endif
                    </a>
                </div>
                
                <div class="hdr-mobile-right">
                    <div class="hdr-topline-right links-holder"> 
                             <div class="dropdn dropdn_wishlist1">
                                
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="input-group">
                                            <input type="text" class="border-0 border-lg form-control" name="q" placeholder="{{translate('I am shopping for ...')}}" autocomplete="off">
                                            <div class="d-none d-lg-block">
                                                <button class="btn" type="submit">
                                                    <i class="la la-search la-flip-horizontal fs-19"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="dropdn dropdn_wishlist">
                                <a href="{{ route('wishlists.index') }}" class="dropdn-link">
                                    <i class="icon icon-heart-1"></i><span>Wishlist</span>
                                </a>
                            </div>
                            <div class="dropdn dropdn_wishlist">
                                 <a href="{{ route('cart') }}" class="text-reset flex-grow-1 text-center py-3 {{ areActiveRoutes(['cart'],'bg-soft-primary')}}">
                                <span class="d-inline-block position-relative px-2">
                                    <i class="icon icon-handbag la-2x"></i>
                                    @if(Session::has('cart'))
                                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
                                    @else
                                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">0</span>
                                    @endif
                                </span>
                            </a>
                                
                            </div>
                              <div class="dropdn dropdn_account">
                                @if(Auth::check())
                                <a href="{{route('dashboard')}}" class="dropdn-link">
                                    <i class="icon icon-person"></i><span>My Account</span>
                                </a>
                                @else
                                <a href="{{route('user.login')}}" class="dropdn-link">
                                    <i class="icon icon-person"></i><span>My Account</span>
                                </a>
                                @endif
                                <!--<div class="dropdn-content">-->
                                <!--<div class="container">-->
                                <!--    <div class="dropdn-close">CLOSE</div>-->
                                <!--        <ul>-->
                                <!--            <li><a href="account-details.html"><i class="icon icon-person-fill"></i><span>My Account</span></a></li>-->
                                <!--            <li><a href="login.html"><i class="icon icon-lock"></i><span>Log In</span></a></li>-->
                                <!--            <li><a href="account-create.html"><i class="icon icon-person-fill-add"></i><span>Register</span></a></li>-->
                                <!--            <li><a href="checkout.html"><i class="icon icon-check-box"></i><span>Checkout</span></a></li>-->
                                <!--        </ul>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            
                    </div>
                    
                </div>
                
                
            </div>
             <div class="dropdn1 dropdn_wishlist d-flex justify-content-center">
                                
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="position-relative align-items-center">
                                        <div class="input-group">
                                            <input type="text" class="border-0 border-lg form-control" name="q" placeholder="{{translate('I am shopping for ...')}}" autocomplete="off">
                                            <div class=" d-lg-block srch-ico">
                                                <button class="btn" type="submit" style="background-color:{{ get_setting('global_color') }};">
                                                    <i class="la la-search la-flip-horizontal fs-19"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                </div>

                
        </div>
     
    </div>
    
     <!--top header for desktop -->
    <div class="hdr-desktop hide-mobile sticky-top">
        
        <div class="hdr-topline">
            <div class="container">
                <div class="row">
                    <div class="col-auto hdr-topline-left">
                        
                        @if(get_setting('header_language') == 1)
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
                         @endif
                         
                         @if(get_setting('header_currency') == 1)
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
                         @endif
                    </div>
                    <div class="col hdr-topline-center">
                        <div class="custom-text">{{ $business->header_msg }}</div>
                        @if($business->phone != null)
                            <div class="custom-text"><i class="icon icon-mobile"></i><b>{{ $business->phone }}</b></div>
                        @endif
                    </div>
                    <div class="col-auto hdr-topline-right links-holder">
                        @if(get_setting('header_wishlist') == 1)
                         <!--Header Wishlist -->
                        <div class="dropdn dropdn_wishlist"><a href="{{ route('wishlists.index') }}" class="dropdn-link"><i class="icon icon-heart-1"></i><span>Wishlist</span></a></div>
                         <!--/Header Wishlist -->
                         @endif
                         
                         @if(get_setting('header_compare') == 1)
                         <!--Header Wishlist -->
                            <div class="dropdn dropdn_wishlist"><a href="{{ route('compare') }}" class="dropdn-link"><i class="icon icon-return"></i><span>{{translate('Compare')}}</span></a></div>
                         <!--/Header Wishlist -->
                         @endif
                        
                         <!--Header Account -->
                        @auth
                            @if(isAdmin())
                                <div class="dropdn dropdn_wishlist"><a href="{{ route('admin.dashboard') }}" class="dropdn-link"><i class="icon icon-person"></i><span>{{ translate('My Panel')}}</span></a></div>
                            @else
                                <div class="dropdn dropdn_wishlist"><a href="{{ route('dashboard') }}" class="dropdn-link"><i class="icon icon-person"></i><span>{{ translate('My Panel')}}</span></a></div>
                            @endif
                            
                            <div class="dropdn "><a href="{{ route('logout') }}" class="dropdn-link"><span class="fw-600">{{ translate('Logout') }}</span></a></div>
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
                   
                   @if(get_setting('header_delivery_location_btn') == 1)
                    <div class="col-auto ml-auto" >
                        <button class="btn shadow delivery-btn" data-toggle="modal" data-target="#myLocationModal" style="background-color:{{ get_setting('global_color') }};">
                            <span style="text-transform:none; letter-spacing:normal;">
                                <i class="icon-location1"></i>
                                    Select Delivery Location
                                <i class="icon-angle-right" style="font-size:10px; margin-top:1px;"></i>
                            </span>
                        </button>
                    </div>
                    @endif
                    
                    @if(get_setting('header_searchbar') == 1)
                    <div class="col-auto  flex-grow-1 front-header-search d-flex align-items-center bg-white">
                        <div class="position-relative flex-grow-1">
                            <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                                <div class="d-flex position-relative align-items-center">
                                    <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                        <button class="btn px-2" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="border-0 border-lg form-control" id="search" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off" style="top:41px;">
                                        <div class="input-group-append d-none d-lg-block">
                                            <button class="btn" type="submit" style="background-color:{{ get_setting('global_color') }};">
                                                <i class="la la-search la-flip-horizontal fs-19"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100">
                                <div class="search-preloader absolute-top-center">
                                    <div class="dot-loader"><div></div><div></div><div></div></div>
                                </div>
                                <div class="search-nothing d-none text-center fs-12">
    
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
                    @endif
                    
                    @if(get_setting('header_shoppingcart') == 1)
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
                    <div class="col-auto minicart-holder">
                        <div class="minicart minicart-js" id="cart_items">
                            @include('frontend.partials.cart')
                        </div>
                    </div>
                    @endif
                    
                    @if(get_setting('vendor_system_activation') == 1)
                     <div class="col-auto">
                        <a href="/shops/create" class="be-seller-btn" style="background-color:{{ get_setting('global_color') }};">
                            <i class="icon icon-handbag mr-1"></i> 
                            {{translate('Be a Seller')}} 
                        </a>
                    </div>
                    @endif
                    
                </div>
            </div>
            </div>
        </div>

    </div>
     @php
        $slug = basename(Request::url());
        $parent_category = App\Category::where('slug',$slug)->first();
    @endphp
    
    @if($parent_category != null)
    @if(\App\Utility\CategoryUtility::get_immediate_children_ids($parent_category->id) != null)
    <div class="hide-mobile" style="min-height: 45px; border-top-width:1px; border-top-style:solid; border-color:#f7f7f7; background-color:#fff;">
        <!--<div class="container">-->
            <!--<div class="row">-->
                
                <!--<div class="col-10">-->
                    <div style=" cursor:pointer; text-decoration: none;">
                        
          
                            <div class="owl-carousel owl-carousel-category owl-theme d-flex flex-row">
                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($parent_category->id) as $key => $first_level_id)
                                    <!-- for col outer box-->
                                    <div class="p-2">
                                        <!-- inner box -->
                                        <div class="inner-box">
                                            <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}" title="{{ \App\Category::find($first_level_id)->getTranslation('name') }}" class="category-text-link">
                                                <!-- for image only -->
                                                <div class="image-only-wrapper" style="background-color:{{ \App\Category::find($first_level_id)->bg_color }};">
                                                    <img src="{{ uploaded_asset(\App\Category::find($first_level_id)->banner) }}" alt="{{ \App\Category::find($first_level_id)->getTranslation('name') }}" class="img-fluid mx-auto" style="width:100%; ">
                                                </div>
                                                <div class="text-only-box" style="margin-left: 18px !important;">
                                                    <span class="category-text opacity-90">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        
                    <!--</div>-->
                    
                <!--</div>-->
            <!--</div>-->
            
        </div>
    </div>
    @endif
    @endif
{{-- @php
        $slug = basename(Request::url());
        $parent_category = App\Category::where('slug',$slug)->first();
    @endphp
    
    @if($parent_category != null)
    @if(\App\Utility\CategoryUtility::get_immediate_children_ids($parent_category->id) != null)
    <div class="hide-mobile" style="min-height: 45px; border-top-width:1px; border-top-style:solid; border-color:#f7f7f7; background-color:#fff;">
        <div class="container">
            <div class="row">
                
                <div class="col-10">
                    <div style="line-height: 50px; cursor:pointer; text-decoration: none; margin-left:340px;">
                        
                        @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($parent_category->id) as $key => $first_level_id)
                            <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}" class="pr-4 navigation-text" >{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
                        @endforeach
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    @endif
    @endif --}}
    
    @if(get_setting('header_categories_bar') == 1 )
        @if ( get_setting('header_menu_labels') !=  null )
            <div class="hide-mobile" style="min-height: 45px; border-top-width:1px; border-top-style:solid; border-color:#f7f7f7; background-color:#fff;">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            @if(get_setting('header_allCategories') == 1)
                            <ul class="list-inline mb-0 pr-0 mobile-hor-swipe">
                                <li class="list-inline-item mr-0"> 
                                    <a href="#" class="mobilemenu-toggle openbtn" onclick="openNav()">
                                       <i class="icon icon-menu"></i>
                                       <span>All</span>   
                                    </a>
                                </li>
                            </ul>
                            @endif
                        </div>
                        
                        <div class="col-8">
                            <div style="line-height: 50px; cursor:pointer; text-decoration: none; margin-left:150px;">
                                @if ( get_setting('header_menu_labels') !=  null )
                                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                        <a class="pr-4 navigation-text" href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}">{{ translate($value) }}</a>
                                    @endforeach
                                @endif
                                
                                @if(get_setting('header_all_categories_dropdown') == 1)
                                    @if(isset($categories) && count($categories)>0)
                                        <div class="dropdown" style="position:relative;">
                                        <a class="dropbtn pr-4 navigation-text">
                                            All Categories
                                            <i class="icon icon-angle-down ml-1"></i>
                                        </a>
                                        <div class="dropdown-content">
                                            <div class="container">  
                                              <div class="row">
                                                @foreach($categories->get() as $category)
                                                    <div class="col menu-col">
                                                        <h3 class="submenu-title mb-2">
                                                          <a href="{{ route('products.category', $category->slug) }}">
                                                              {{ $category->name }}
                                                          </a>
                                                        </h3>
                                                          @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                                            <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}" class="submenu-text">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
                                                          @endforeach
                                                          
                                                        @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                                                            <a href="{{ route('products.category', $category->slug) }}" class="submenu-text-link">View More</a>
                                                        @endif
                                                        
                                                    </div>
                                                @endforeach
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                
                                @if(get_setting('header_all_brands_dropdown') == 1)
                                <div class="dropdown" style="position:relative;">
                                    <a class="dropbtn navigation-text">
                                        All Brands
                                        <i class="icon icon-angle-down ml-1"></i>
                                    </a>
                                    <div class="dropdown-content" style="width:230px !important; left:300px !important;">
                                        <div class="container">  
                                          <div class="row">
                                            <div class="col menu-col">
                                                @foreach($brands as $brand)
                                                    <h3 class="submenu-title mb-2">
                                                      <a href="{{ route('products.brand', $brand->slug) }}">
                                                          {{ $brand->name }}
                                                      </a>
                                                    </h3>
                                                @endforeach
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        @endif
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
        <form action="{{ route('update.address') }}" method="POST"> 
            @csrf
             <!--Modal body -->
            <div class="modal-body">
                
                <div class="d-flex justify-content-center mb-4">
                    <a class="btn btn-success px-5 delivery-address-btn" onclick="onDeliveryAddressBtnClick()" style="background: #fff !important; color: #27C7D8 !important; border: 2px solid #27C7D8;">
                        City
                    </a>
                    <a class="btn btn-success px-5" onclick="onDeliveryPincodeBtnClick()" style="background: #27C7D8 !important; color: #fff !important;" >
                        Pincode
                    </a>
                </div>
                <span class="d-block mb-2">Where would you like to get the product delivered?</span>
             
                  <div class="form-group">
                      <span class="show" id="delivery-address-input"><input type="text" name="address" value="@if(Auth::check()) {{ Auth::user()->address }} @endif" class="form-control" placeholder="Enter City"></span>
                  </div>
                  <div class="form-group">
                      <span class="hide" id="delivery-pincode-input"><input type="text" name="postal_code" value="@if(Auth::check()) {{ Auth::user()->postal_code }} @endif" class="form-control" placeholder="Enter Pincode"></span>
                  </div>
            </div>
            
            <input type="hidden" name="key" value="daddress" id="daddress">
            
             <!--Modal footer -->
            <div class="modal-footer">
                @if(Auth::check())
                    <button type="submit" class="btn btn-primary">Continue</button>
                @else
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="myUnAuthDeliveryFunction()">Continue</button>
                @endif
            </div>
        </form>
      </div>
    </div>
  </div>

