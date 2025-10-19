@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
@php
    $qty = 0;
    if($detailedProduct->variant_product){
        foreach ($detailedProduct->stocks as $key => $stock) {
            $qty += $stock->qty;
        }
    }
    else{
        $qty = $detailedProduct->stocks->first()->qty;
    }
@endphp
    <section class="mb-4 pt-2 mt-5 mt-lg-0 mb-nav-fix-cat">
        <div class="container sm-px-0 mt-4 mt-lg-0">
            
            <div class="holder mt-0">
                <div class="container">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li><span>{{ $detailedProduct->getTranslation('name') }}</span></li>
                    </ul>
                </div>
            </div>
            
            
            <div class="bg-white shadow-sm rounded p-4">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-4">
                        <div class="sticky-top z-3 row gutters-10">
                            @php
                                $photos = explode(',', $detailedProduct->photos);
                            @endphp
                            <div class="col order-1 order-md-2">
                                <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="imgBox">
                                                <img
                                                    class="img-fluid lazyload  "
                                                    src="{{ uploaded_asset($photo) }}"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                     data-origin="{{ uploaded_asset($photo) }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            <!--   <span><a href="javascript:void(0)" onclick="show_chat_modal()" data-toggle="tooltip" data-title="{{ translate('Messsage Seller') }}"><i class="icon icon-mail-envelope wishlist-icon ml-5" style="cursor:pointer;"></i></a></span>-->
                                            <!--<span><a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}"><i class="icon icon-heart-1 wishlist-icon ml-5" style="cursor:pointer;"></i></a></span>-->
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach ($photos as $key => $photo)
                                        <div class="imgBox">
                                            <img
                                                class="img-fluid lazyload  "
                                                src="{{ uploaded_asset($photo) }}"
                                                data-src="{{ uploaded_asset($photo) }}"
                                                data-origin="{{ uploaded_asset($photo) }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-md-auto w-md-80px order-2 order-md-1 mt-3 mt-md-0">
                                <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>
                                    @foreach ($detailedProduct->stocks as $key => $stock)
                                        @if ($stock->image != null)
                                            <div class="carousel-box c-pointer border p-1 rounded " data-variation="{{ $stock->variant }}">
                                                <img
                                                    class="lazyload mw-100 size-50px mx-auto  "
                                                    src="{{ uploaded_asset($stock->image)}}"
                                                    data-src="{{ uploaded_asset($stock->image) }}"
                                                      data-origin="{{ uploaded_asset($stock->image)}}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach ($photos as $key => $photo)
                                    <div class="carousel-box c-pointer border p-1 rounded ">
                                        <img
                                            class="lazyload mw-100 size-50px mx-auto  "
                                            src="{{ uploaded_asset($photo) }}"
                                            data-src="{{ uploaded_asset($photo) }}"
                                              data-origin="{{ uploaded_asset($photo) }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                        >
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-5 mb-4" style="border-right: 1px solid #e2e5ec;">
                        <div class="text-left">
                            
                            <div class="row">
                                <div class="col-9">
                                    <span class="opacity-80">Seller:</span>
                                    <span>
                                        @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                            {{ $detailedProduct->user->shop->name }}
                                        @else
                                            {{  translate('Inhouse product') }}
                                        @endif
                                    </span> 
                                    @if($detailedProduct->country_id != null)
                                    <br/>
                                    <span>Made in 
                                    <a href="javascript:void(0)">
                                        {{ \App\Country::find($detailedProduct->country_id)->name }}
                                    </a></span>
                                    @endif
                                </div>
                                <div class="col-3">
                                    <span><a href="javascript:void(0)" onclick="show_chat_modal()" data-toggle="tooltip" data-title="{{ translate('Messsage Seller') }}"><i class="icon icon-mail-envelope wishlist-icon ml-5" style="cursor:pointer;"></i></a></span>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h1 class="fs-20 fw-600 center">
                                {{ $detailedProduct->getTranslation('name') }}
                            </h1>
                            
                            <div class="row mb-4">
                                <div class="col-12 center">
                                    @php
                                        $total = 0;
                                        $total += $detailedProduct->reviews->count();
                                    @endphp
                                    <span class="rating">
                                        {{ renderStarRating($detailedProduct->rating) }}
                                    </span>
                                    <span class="ml-1 opacity-50">({{ $total }} {{ translate('reviews')}})</span>
                                </div>
                               
                            </div>
                            
                            @if ($detailedProduct->brand != null)
                            <div class="row">
                                <div class="col-9">
                                    <span class=" opacity-80">Brand:</span> <span>{{ $detailedProduct->brand->getTranslation('name') }}</span> <br/>
                                    <span>More items from <a href="{{ route('products.brand',$detailedProduct->brand->slug) }}">{{ $detailedProduct->brand->getTranslation('name') }}</a></span>
                                </div>
                                 <div class="col-3">
                                    <!--<span><i class="icon icon-share mr-1 fs-14" style="cursor:pointer;"></i></span>-->
                                    <span><a href="javascript:void(0)" onclick="addToWishList({{ $detailedProduct->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}"><i class="icon icon-heart-1 wishlist-icon ml-5" style="cursor:pointer;"></i></a></span>
                                </div>
                            </div>
                            @endif
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-12">
                                    @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))
                                        <p class="ml-1 d-inline" style="font-size:24px; font-weight:bold; color:#27C7D8;">
                                            {{ home_discounted_price($detailedProduct->id) }}
                                            @if($detailedProduct->unit != null)
                                                <span style="font-size:16px !important;">/ {{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif
                                        </p> 
                                        <span><small>(Exc. of Tax)</small></span><br/>
                                        <span class="ml-1" style="text-decoration:line-through;">{{ home_price($detailedProduct->id) }}</span>  
                                        
                                        <br>(You Save:   @if($detailedProduct->discount_type =="percent")
                                            <span class="ml-1" style="color: #42c406;">{{ $detailedProduct->discount }}%</span>
                                        @else
                                            <span class="ml-1" style="color: #42c406">Rs. {{ $detailedProduct->discount }}</span>
                                        @endif
                                        )
                                    @else
                                        <p class="ml-1 d-inline" style="font-size:28px; font-weight:bold; color:#27C7D8;">
                                            {{ home_price($detailedProduct->id) }}
                                            @if($detailedProduct->unit != null)
                                                <span style="font-size:16px !important;">/ {{ $detailedProduct->getTranslation('unit') }}</span>
                                            @endif
                                        </p> 
                                        <span><small>(Inclusive of all Taxes)</small></span><br/>
                                    @endif

                                </div>
                            </div>
                            
                            
                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $detailedProduct->earn_point > 0)
                                 
                                <div class="row">
                                    <!-- size -->
                                    <div class="col-3 d-inline mt-3">
                                        <span class="ml-1 opacity-80">{{  translate('Club Point') }}</span>
                                    </div>
                                    <div class="col-9 d-inline mb-3 mt-3">
                                         <span>{{ $detailedProduct->earn_point }}</span>
                                    </div>
                                    <!-- size/ -->
                                </div>
                            @endif
                            
                            <hr>
                            
                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                                <div class="row">
                                
                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                <!-- color family -->
                                <div class="col-3 d-inline">
                                    <span class="ml-1 opacity-80">Color</span>
                                </div>
                                <div class="col-9 d-inline mb-3">
                                     <span>Choose Variation</span>
                                </div>
                                <!-- color family/ -->
                                
                                <div class="col-3">&nbsp;</div>
                                
                                <!-- color -->
                                <div class="col-9">
                                    <div class="aiz-radio-inline">
                                        @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ \App\Color::where('code', $color)->first()->name }}">
                                            <input
                                                type="radio"
                                                name="color"
                                                value="{{ \App\Color::where('code', $color)->first()->name }}"
                                                @if($key == 0) checked @endif
                                            >
                                            <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                <span class="size-30px d-inline-block rounded" style="background: {{ $color }};"></span>
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- color/ -->
                                @endif
                                
                                @if ($detailedProduct->choice_options != null)
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                    <!-- size -->
                                    <div class="col-3 d-inline mt-3">
                                        <span class="ml-1 opacity-80" style="text-transform:capitalize; font-weight:bold">{{ \App\Attribute::find($choice->attribute_id)->getTranslation('name') }}:</span>
                                    </div>
                                    <div class="col-9 d-inline mb-3 mt-3">
                                         <span style="text-transform:capitalize; font-weight:bold; color:#27c7d8">Size chart</span>
                                    </div>
                                    <!-- size/ -->
                                    
                                    <div class="col-3 mb-4">&nbsp;</div>
                                    
                                    <!-- size -->
                                    <div class="col-9 mb-4">
                                        <div class="aiz-radio-inline">
                                            @foreach ($choice->values as $key => $value)
                                            <label class="aiz-megabox pl-0 mr-2">
                                                <input
                                                    type="radio"
                                                    name="attribute_id_{{ $choice->attribute_id }}"
                                                    value="{{ $value }}"
                                                    @if($key == 0) checked @endif
                                                >
                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2 ">
                                                    {{ $value }}
                                                </span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- size/ -->
                                
                                    @endforeach
                                @endif
                                
                                <!-- quantity -->
                                <div class="col-12 pb">
                                    <span class="ml-1 opacity-80" style="font-weight:bold;">{{ translate('Quantity')}}</span>
                                </div>
                                <div class="col-12 d-inline mb-3 d-flex justify-content-center">
                                     <div class="product-quantity d-flex align-items-center">
                                        <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                            <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                                <i class="las la-minus"></i>
                                            </button>
                                            <input type="text" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="10" readonly>
                                            <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                <i class="las la-plus"></i>
                                            </button>
                                        </div>
                                        <div class="avialable-amount opacity-60">
                                            @if($detailedProduct->stock_visibility_state != 'hide')
                                            (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- quantity/ -->
                                
                            </div> <!--row end -->
                            
                            </form>
                            
                          <div class="d-flex align-content-around mb-5 mt-4 action-btns">
                                 <div class="p-2">
                               <button type="button" class="add-to-cart-buy-now-btn add-to-cart-btn buy-now" onclick="addToCart()">{{ translate('Add to cart')}}</button>
                                </div>
                                <div class="p-2">
                               <button type="button" class="add-to-cart-buy-now-btn buy-now-btn add-to-cart" onclick="buyNow()">{{ translate('Buy Now')}}</button>
                                </div>
                                <div class="p-2">
                               
                                <button class="add-to-cart-buy-now-btn out-of-stock d-none" disabled>{{ translate('Out of Stock')}}</button>
                                </div>
                            </div>
                            
                            
                            <!--<div class="d-flex align-content-around mb-5 mt-4 action-btns">-->
                            <!--    @if ($qty > 0)-->
                            <!--        <div class="p-2">-->
                            <!--            <button type="button" class="add-to-cart-buy-now-btn buy-now-btn add-to-cart" onclick="buyNow()">{{ translate('Buy Now')}}</button>-->
                            <!--        </div>-->
                            <!--        <div class="p-2">-->
                            <!--            <button type="button" class="add-to-cart-buy-now-btn add-to-cart-btn buy-now" onclick="addToCart()">{{ translate('Add to cart')}}</button>-->
                            <!--        </div>-->
                            <!--    @else-->
                            <!--        <div class="p-2">-->
                            <!--            <button class="add-to-cart-buy-now-btn buy-now-btn" disabled>{{ translate('Out of Stock')}}</button>-->
                            <!--        </div>-->
                            <!--    @endif-->
                            <!--</div>-->
                            <hr/>
                              
                            @if ( get_setting('payment_method_images') !=  null )
                            <div class="row">
                                <div class="col-12">
                                    <div class="prd-safecheckout topline">
                                        <h3 class="h2-style">guaranteed safe checkout</h3>
                                        @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                            <img src="{{ uploaded_asset($value) }}" alt="" class="img-fluid" style="max-height: 40px; width:auto;" >
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            
                        </div>
                    </div> <!-- middle part -->
                    
                    <div class="col-xl-3 col-lg-3 mb-4">
                        <div class="delivery-options">
                            <div class="delivery">
                                <div class="delivery-header opacity-90">
                                    Delivery Options
                                </div>
                                <!--<div class="delivery-box pb-3">-->
                                <!--    <div class="delivery-content row mt-4">-->
                                        <!--<div class="delivery-icon col-1 text-start ml-0">-->
                                        <!--    <i class="icon-location1" style="font-size:24px;"></i>-->
                                        <!--</div>-->
                                <!--        <div class="delivery-pincode col-8">-->
                                <!--            <input class="hide" type="text" id="textInput" placeholder="Enter address..." title="Input address & press enter" />-->
                                <!--            @if(Auth::check())-->
                                <!--                <span id="change-address">{{ App\User::where('id', Auth::user()->id)->first()->address }}</span>-->
                                <!--            @else-->
                                <!--                <span id="change-address">Your Address</span>-->
                                <!--            @endif-->
                                <!--        </div>-->
                                        
                                        <!--<div class="change-pincode-option col-2">-->
                                        <!--    <a href="javascript:void(0)" name="answer" id="change-btn" onclick="onChangeButtonClick()" style="cursor:pointer;">EDIT</a>-->
                                        <!--    <a href="javascript:void(0)" name="save" class="hide" id="save-btn" onclick="onSaveButtonClick()" style="cursor:pointer;">-->
                                        <!--        <i class="icon icon-check-box"></i>-->
                                        <!--    </a>-->
                                        <!--    <a href="javascript:void(0)" name="cancel" class="hide" id="cancel-btn" onclick="onCancelButtonClick()" style="cursor:pointer;">-->
                                        <!--        <i class="icon icon-cross"></i>-->
                                        <!--    </a>-->
                                        <!--</div>-->
                                <!--    </div>-->
                                <!--    <div class="delivery-content row mt-4">-->
                                <!--        <div class="delivery-icon col-1 text-start ml-0">-->
                                <!--            <i class="icon-pencil" style="font-size:18px; cursor:pointer;"></i>-->
                                <!--        </div>-->
                                <!--        <div class="delivery-pincode col-8">-->
                                <!--            <span id="pincode-header">Pincode</span>-->
                                <!--            <div class="delivery-pincode opacity-80">-->
                                <!--                <input class="hide" type="text" id="pincodeInput" placeholder="Enter pincode..." title="Input pincode & press enter" />-->
                                <!--                @if(Auth::check())-->
                                <!--        	        <span id="change-pincode">{{ App\User::where('id', Auth::user()->id)->first()->postal_code }}</span>-->
                                <!--        	    @else-->
                                <!--        	        <span id="change-pincode">Your Pincode</span>-->
                                <!--        	    @endif-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--        <div class="change-pincode-option col-2">-->
                                <!--            <a href="javascript:void(0)" name="answer" id="pincode-change-btn" onclick="onPincodeChangeButtonClick()" style="cursor:pointer;">EDIT</a>-->
                                            
                                <!--            <a href="javascript:void(0)" name="save" class="hide" id="pincode-save-btn" onclick="onPincodeSaveButtonClick()" style="cursor:pointer;">-->
                                <!--                <i class="icon icon-check-box"></i>-->
                                <!--            </a>-->
                                <!--            <a href="javascript:void(0)" name="cancel" class="hide" id="pincode-cancel-btn" onclick="onPincodeCancelButtonClick()" style="cursor:pointer;">-->
                                <!--                <i class="icon icon-cross"></i>-->
                                <!--            </a>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="delivery-box pb-3">
                                    @if ($detailedProduct->est_shipping_days)
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-global" style="font-size:20px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	{{ translate('Est. Shipping Time')}}
                                        	<div class="delivery-pincode opacity-80">
                                        	    {{ $detailedProduct->est_shipping_days }} days
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($detailedProduct->cash_on_delivery == 1)
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-box3" style="font-size:20px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	Cash on Delivery Available
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($detailedProduct->customer_support == 1)
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-call" style="font-size:20px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	24/7 Customer Support
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                            </div>
                            
                            @php
                                $wholesale = App\Models\Wholesale::where('product_id', $detailedProduct->id)->first();
                            @endphp
                            
                            @if($detailedProduct->wholeseller_id == 1 && $wholesale != null)
                            <div class="delivery">
                                <div class="delivery-header opacity-90 mt-4">
                                    Wholesale
                                </div>
                                <div class="delivery-box table-responsive mt-2 mb-4">
                                    <table class="table table-sm table-hover table-warning">
                                        <tbody>
                                            <tr>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Discount</th>
                                              </tr>
                                                @if($wholesale->quantity_f1 != '' & $wholesale->discount_f1 != '')
                                                <tr scope="row">
                                                    <td style="height:10px">{{ $wholesale->quantity_f1 }}+</td>
                                                    <td>{{ $wholesale->discount_f1 }}% Off</td>
                                                </tr>
                                                @endif
                                                @if($wholesale->quantity_f2 != '' & $wholesale->discount_f2 != '')
                                                <tr scope="row">
                                                    <td>{{ $wholesale->quantity_f2 }}+</td>
                                                    <td>{{ $wholesale->discount_f2 }}% Off</td>
                                                </tr>
                                                @endif
                                                @if($wholesale->quantity_f3 != '' & $wholesale->discount_f3 != '')
                                                <tr scope="row">
                                                    <td>{{ $wholesale->quantity_f3 }}+</td>
                                                    <td>{{ $wholesale->discount_f3 }}% Off</td>
                                                 </tr>
                                                 @endif
                                                 @if($wholesale->quantity_f4 != '' & $wholesale->discount_f4 != '')
                                                <tr scope="row">
                                                    <td>{{ $wholesale->quantity_f4 }}+</td>
                                                    <td>{{ $wholesale->discount_f4 }}% Off</td>
                                                </tr>
                                                @endif
                                        </tbody>
                                    </table>
                                    
                                </div>
                                
                            </div>
                            @endif
                            
                            <div class="delivery">
                                <div class="delivery-header opacity-90 mt-4">
                                    Return & Warranty
                                </div>
                                <div class="delivery-box pb-3">
                                    @if($detailedProduct->customer_support == 1)
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-check-box" style="font-size:16px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	100% Genuine
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($detailedProduct->return_days != null && $detailedProduct->return_days != '')
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-check-box" style="font-size:16px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	{{$detailedProduct->return_days}}
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($detailedProduct->warranty_time != null && $detailedProduct->warranty_time != '')
                                    <div class="delivery-content row mt-4">
                                        <div class="delivery-icon col-1 text-start ml-0">
                                            <i class="icon-check-box" style="font-size:16px;"></i>
                                        </div>
                                        <div class="delivery-pincode col-11">
                                        	{{ $detailedProduct->warranty_time }}
                                        </div>
                                    </div>
                                    @endif
                                    
                                </div>
                                
                            </div>
                            
                            <div class="delivery">
                                <div class="delivery-header opacity-90 mt-4">
                                    {{ translate('Seller Information')}}
                                </div>
                                <div class="delivery-box pb-1 mt-3" style="border:none !important;">
                                    <div class="delivery-content row">
                                        <div class="seller-name_title col text-start ml-0">
                                            {{ translate('Sold by')}}
                                        </div>
                                        
                                        @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                        <div class="change-pincode-option col" style="right:-20px;">
                                            <a href="javascript:void(0)" onclick="show_chat_modal()">{{ translate('MESSAGE SELLER')}}</a>
                                        </div>
                                        @endif
                                        
                                        <div class="seller-name__title col-12 text-start ml-0">
                                            @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                                {{ $detailedProduct->user->shop->name }}
                                            @else
                                                {{  translate('Inhouse product') }}
                                            @endif
                                        </div>
                                    </div>
                                    @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                    <div class="delivery-content row">
                                        <div class="delivery-icon col text-start ml-0" style="color:green; font-size:10px;">
                                            Authorized Seller
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="delivery-box pb-3">
                                     @php
                                        $total = 0;
                                        $rating = 0;
                                        foreach ($detailedProduct->user->products as $key => $seller_product) {
                                            $total += $seller_product->reviews->count();
                                            $rating += $seller_product->reviews->sum('rating');
                                        }
                                    @endphp

                                    <div class="text-center border rounded p-2 mt-3">
                                        <div class="rating">
                                            @if ($total > 0)
                                                {{ renderStarRating($rating/$total) }}
                                            @else
                                                {{ renderStarRating(0) }}
                                            @endif
                                        </div>
                                        <div class="opacity-60 fs-12">({{ $total }} {{ translate('customer reviews')}})</div>
                                    </div>
                                </div>
                                
                                @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                <div class="delivery-box pb-3 mt-3">
                                    <div class="delivery-content row">
                                        <div class="visit-store-link col-12">
                                        	<a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">VISIT STORE</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                <div class="col-xl-3 order-1 order-xl-0">
                    <div class="bg-white rounded shadow-sm mb-3">
                        <div class="p-3 border-bottom fs-16 fw-600">
                            {{ translate('Top Selling Products')}}
                        </div>
                        <div class="p-3">
                            <ul class="list-group list-group-flush">
                                @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                                <li class="py-3 px-0 list-group-item border-light">
                                    <div class="row gutters-10 align-items-center">
                                        <div class="col-5">
                                            <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">
                                                <img
                                                    class="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                    alt="{{ $top_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                        </div>
                                        <div class="col-7 text-left">
                                            <h4 class="fs-12 text-truncate-2 mb-0">
                                                <a href="{{ route('product', $top_product->slug) }}" class="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                            </h4>
                                            <div class="rating rating-sm">
                                                {{ renderStarRating($top_product->rating) }}
                                            </div>
                                            <div class="mt-2">
                                                <span class="fs-17 fw-600 text-primary">{{ home_discounted_base_price($top_product->id) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
              
                <div class="col-xl-9 order-0 order-xl-1">
                    <div class="bg-white mb-3 shadow-sm rounded">
                        <div class="nav border-bottom aiz-nav-tabs">
                            <a href="#tab_default_1" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset active show">{{ translate('Description')}}</a>
                            @if($detailedProduct->video_link != null)
                                <a href="#tab_default_2" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Video')}}</a>
                            @endif
                            @if($detailedProduct->pdf != null)
                                <a href="#tab_default_3" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Downloads')}}</a>
                            @endif
                                <a href="#tab_default_4" data-toggle="tab" class="p-3 fs-16 fw-600 text-reset">{{ translate('Reviews')}}</a>
                        </div>

                        <div class="tab-content pt-0">
                            <div class="tab-pane fade active show" id="tab_default_1">
                                <div class="p-4">
                                    <div class="mw-100 overflow-hidden text-left">
                                        <?php echo $detailedProduct->getTranslation('description'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_default_2">
                                <div class="p-4">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                                            <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                        @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                                            <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_3">
                                <div class="p-4 text-center ">
                                    <a href="{{ uploaded_asset($detailedProduct->pdf) }}" class="btn btn-primary">{{  translate('Download') }}</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_default_4">
                                <div class="p-4">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            @if($review->user != null)
                                            <li class="media list-group-item d-flex">
                                                <span class="avatar avatar-md mr-3">
                                                    <img
                                                        class="lazyload"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                        @if($review->user->avatar_original !=null)
                                                            data-src="{{ uploaded_asset($review->user->avatar_original) }}"
                                                        @else
                                                            data-src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        @endif
                                                    >
                                                </span>
                                                <div class="media-body text-left">
                                                    <div class="d-flex justify-content-between">
                                                        <h3 class="fs-15 fw-600 mb-0">{{ $review->user->name }}</h3>
                                                        <span class="rating rating-sm">
                                                            @for ($i=0; $i < $review->rating; $i++)
                                                                <i class="las la-star active"></i>
                                                            @endfor
                                                            @for ($i=0; $i < 5-$review->rating; $i++)
                                                                <i class="las la-star"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                    <div class="opacity-60 mb-2">{{ date('d-m-Y', strtotime($review->created_at)) }}</div>
                                                    <p class="comment-text">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    @if(count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{  translate('There have been no reviews for this product yet.') }}
                                        </div>
                                    @endif

                                    @if(Auth::check())
                                        @php
                                            $commentable = false;
                                        @endphp
                                        @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($commentable)
                                            <div class="pt-4">
                                                <div class="border-bottom mb-4">
                                                    <h3 class="fs-17 fw-600">
                                                        {{ translate('Write a review')}}
                                                    </h3>
                                                </div>
                                                <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="opacity-60">{{ translate('Rating')}}</label>
                                                        <div class="rating rating-input">
                                                            <label>
                                                                <input type="radio" name="rating" value="1">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="2">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="3">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="4">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="5">
                                                                <i class="las la-star"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="opacity-60">{{ translate('Comment')}}</label>
                                                        <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary mt-3">
                                                            {{ translate('Submit review')}}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white rounded shadow-sm">
                        <div class="border-bottom p-3">
                            <h3 class="fs-16 fw-600 mb-0">
                                <span class="mr-4">{{ translate('Related products')}}</span>
                            </h3>
                        </div>
                        <div class="p-3">
                            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                                @foreach (filter_products(\App\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                <div class="carousel-box">
                                    <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                                        <div class="">
                                            <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                                <img
                                                    class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($related_product->thumbnail_img) }}"
                                                    alt="{{ $related_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                        </div>
                                        <div class="p-md-3 p-2 text-left">
                                            <div class="fs-15">
                                                @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($related_product->id) }}</del>
                                                @endif
                                                <span class="fw-700 text-primary">{{ home_discounted_base_price($related_product->id) }}</span>
                                
                                                @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                    <br>
                                                    <span class="fw-600 text-secondary">{{ translate('Club Point') }}: {{ $related_product->earn_point }}</span>
                                                @endif
                                                
                                            </div>
                                            <div class="rating rating-sm mt-1">
                                                {{ renderStarRating($related_product->rating) }}
                                            </div>
                                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset">{{ $related_product->getTranslation('name') }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('modal')
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <span class="opacity-60">{{  translate('Use country code before number') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class=opacity-60>{{  translate('Remember Me') }}</span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('password.request') }}" class="text-reset opacity-60 fs-14">{{ translate('Forgot password?')}}</a>
                                </div>
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="btn btn-primary btn-block fw-600">{{  translate('Login') }}</button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-0">{{ translate('Dont have an account?')}}</p>
                            <a href="{{ route('user.registration') }}">{{ translate('Register Now')}}</a>
                        </div>
                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <div class="separator mb-3">
                                <span class="bg-white px-3 opacity-60">{{ translate('Or Login With')}}</span>
                            </div>
                            <ul class="list-inline social colored text-center mb-5">
                                @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                            <i class="lab la-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                            <i class="lab la-google"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                    <li class="list-inline-item">
                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                            <i class="lab la-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascritp">
        // function getUserAddress(){
        //     $.post('{{ route('cart.nav_cart') }}', {_token: AIZ.data.csrf }, function(data){
        //         $('#cart_items').html(data);
        //     });
        // }
    </script>
    <script type="text/javascript">
        $("#save-btn").click(function(e) {
           console.log("here");
           e.preventDefault();
           updateAddress();
        });
        
        function updateAddress(){
          console.log("Update address function");
            $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url: '{{ route('update.deliveryAddress') }}',
                data: "address="+$('#textInput').val(),
                cache: false,
                datatype: 'JSON',
                processData: false,
                success: function(data){
                   if(data != 0){
                        document.getElementById('textInput').className="hide";
                        document.getElementById('change-address').className="show";
                        document.getElementById('cancel-btn').className="hide";
                        document.getElementById('save-btn').className="hide";
                        document.getElementById('change-btn').className="show";
                        
                        $('#change-address').replaceWith(data);
                        
                        setTimeout(function(){// wait for 5 secs(2)
                               location.reload(); // then reload the page.(3)
                        }, 1000);
                        
                        AIZ.plugins.notify('success', 'Your delivery address has been changed!');
                   }
                   else{
                        document.getElementById('textInput').className="hide";
                        document.getElementById('change-address').className="show";
                        document.getElementById('cancel-btn').className="hide";
                        document.getElementById('save-btn').className="hide";
                        document.getElementById('change-btn').className="show";
                        AIZ.plugins.notify('warning', 'Please login first!');
                   }
                }
            });
        }
    </script>
    
    <script type="text/javascript">
        $("#pincode-save-btn").click(function(e) {
           e.preventDefault();
           updatePincode();
          
        });
        
        function updatePincode(){
          console.log("Update pincode function");
            $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url: '{{ route('update.deliveryPincode') }}',
                data: "pincode="+$('#pincodeInput').val(),
                cache: false,
                datatype: 'JSON',
                processData: false,
                success: function(data){
                   if(data != 0){
                        document.getElementById('pincodeInput').className="hide";
                        document.getElementById('change-pincode').className="show";
                        document.getElementById('pincode-cancel-btn').className="hide";
                        document.getElementById('pincode-save-btn').className="hide";
                        document.getElementById('pincode-change-btn').className="show";
                        document.getElementById('pincode-header').className="show";
                        
                        $('#change-pincode').replaceWith(data);
                        
                        setTimeout(function(){// wait for 5 secs(2)
                               location.reload(); // then reload the page.(3)
                        }, 1000); 
                        
                        AIZ.plugins.notify('success', 'Your delivery pincode has been changed!');
                   }
                   else{
                        document.getElementById('pincodeInput').className="hide";
                        document.getElementById('change-pincode').className="show";
                        document.getElementById('pincode-cancel-btn').className="hide";
                        document.getElementById('pincode-save-btn').className="hide";
                        document.getElementById('pincode-change-btn').className="show";
                        document.getElementById('pincode-header').className="show";
                        AIZ.plugins.notify('warning', 'Please login first!');
                   }
                }
            });
        }
    </script>
    
    <script type="text/javascript">
        function onChangeButtonClick(){
          document.getElementById('textInput').className="show";
          document.getElementById('change-address').className="hide";
          document.getElementById('cancel-btn').className="show";
          document.getElementById('change-btn').className="hide";
          document.getElementById('save-btn').className="show";
        }
        
        function onSaveButtonClick(){
            document.getElementById('textInput').className="hide";
            document.getElementById('change-address').className="show";
            document.getElementById('cancel-btn').className="hide";
            document.getElementById('change-btn').className="show";
            document.getElementById('save-btn').className="hide";
        }
        
        function onCancelButtonClick(){
            document.getElementById('textInput').className="hide";
            document.getElementById('change-address').className="show";
            document.getElementById('cancel-btn').className="hide";
            document.getElementById('change-btn').className="show";
            document.getElementById('save-btn').className="hide";
        }
    </script>
    
    <script type="text/javascript">
        function onPincodeChangeButtonClick(){
          document.getElementById('pincodeInput').className="show";
          document.getElementById('change-pincode').className="hide";
          document.getElementById('pincode-cancel-btn').className="show";
          document.getElementById('pincode-change-btn').className="hide";
          document.getElementById('pincode-header').className="hide";
          document.getElementById('pincode-save-btn').className="show";
        }
        
        function onPincodeSaveButtonClick(){
            document.getElementById('pincodeInput').className="hide";
            document.getElementById('change-pincode').className="show";
            document.getElementById('pincode-cancel-btn').className="hide";
            document.getElementById('pincode-change-btn').className="show";
            document.getElementById('pincode-header').className="show";
            document.getElementById('pincode-save-btn').className="hide";   
        }
        
        function onPincodeCancelButtonClick(){
            document.getElementById('pincodeInput').className="hide";
            document.getElementById('change-pincode').className="show";
            document.getElementById('pincode-cancel-btn').className="hide";
            document.getElementById('pincode-change-btn').className="show";
            document.getElementById('pincode-header').className="show";
            document.getElementById('pincode-save-btn').className="hide";
        }
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            getVariantPrice();
    	});

        function CopyToClipboard(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
            // if (document.selection) {
            //     var range = document.body.createTextRange();
            //     range.moveToElementText(document.getElementById(containerid));
            //     range.select().createTextRange();
            //     document.execCommand("Copy");

            // } else if (window.getSelection) {
            //     var range = document.createRange();
            //     document.getElementById(containerid).style.display = "block";
            //     range.selectNode(document.getElementById(containerid));
            //     window.getSelection().addRange(range);
            //     document.execCommand("Copy");
            //     document.getElementById(containerid).style.display = "none";

            // }
            // AIZ.plugins.notify('success', 'Copied');
        }
        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }

    </script>
    
    
    <script src="{{ static_asset('assets/js/jquery.imgzoom.js') }}"></script>
    
    <script type="text/javascript">
        $('.imgBox').imgZoom({
           
            origin: 'data-origin'
        });
    </script>
   
@endsection
 
