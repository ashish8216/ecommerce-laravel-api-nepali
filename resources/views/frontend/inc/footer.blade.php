<footer class="page-footer footer-style-1 global_width" style="background-color:#e3e4e6; color: {{ get_setting('footer_color') }};">
        <div class="holder bgcolor bgcolor-1 mt-0"  style="background-color:{{ get_setting('global_color') }};">
            <div class="container">
                <div class="row shop-features-style3">
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">{{ json_decode( get_setting('feature_title'), true)[0] }}</div>
                                <div class="text2">{{ json_decode( get_setting('feature_desc'), true)[0] }}</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">{{ json_decode( get_setting('feature_title'), true)[1] }}</div>
                                <div class="text2">{{ json_decode( get_setting('feature_desc'), true)[1] }}</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-call"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">{{ json_decode( get_setting('feature_title'), true)[2] }}</div>
                                <div class="text2">{{ json_decode( get_setting('feature_desc'), true)[2] }}</div>
                            </div>
                        </a></div>
                </div>
            </div>
        </div>
        <div class="holder bgcolor bgcolor-2 py-5 mt-0">
            <div class="container">
                <div class="subscribe-form subscribe-form--style1">
                    <form method="POST" action="{{ route('subscribers.store') }}">
                        @csrf
                        <div class="form-inline">
                            <div class="subscribe-form-title">{{ translate('Subscribe to newsletter') }}</div>
                            <div class="form-control-wrap"><input type="text" class="form-control" name="email" placeholder="{{ translate('Enter Your e-mail address') }}" required></div>
                            <button type="submit" class="btn-decor">{{ translate('Subscribe') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="footer-top container">
            <div class="row py-md-4">
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>{{ get_setting('footer_categories_widget') }}</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                 @if ( get_setting('categories_widget_labels') !=  null )
                                    @foreach (json_decode( get_setting('categories_widget_labels'), true) as $key => $value)
                                        <li><a href="{{ json_decode( get_setting('categories_widget_links'), true)[$key] }}">{{ $value }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>{{ get_setting('widget_one') }}</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                @if ( get_setting('widget_one_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                        <li><a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">{{ $value }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>{{ get_setting('widget_two') }}</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                @if ( get_setting('widget_two_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_two_labels'), true) as $key => $value)
                                        <li><a href="{{ json_decode( get_setting('widget_two_links'), true)[$key] }}">{{ $value }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>{{ get_setting('widget_three') }}</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                @if ( get_setting('widget_three_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_three_labels'), true) as $key => $value)
                                        <li><a href="{{ json_decode( get_setting('widget_three_links'), true)[$key] }}">{{ $value }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Contact us</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="contact-list">
                                <li><i class="icon-phone"></i><span><span class="h6-style">{{translate('Phone')}}:</span><span>{{ get_setting('contact_phone') }}</span></span></li>
                                <li><i class="icon-clock4"></i><span><span class="h6-style">{{translate('Hours')}}:</span><span>{{ get_setting('contact_hours') }}</span></span></li>
                                <li><i class="icon-mail-envelope1"></i><span><span class="h6-style">{{translate('E-mail')}}:</span><span><a href="{{ get_setting('contact_email') }}">{{ get_setting('contact_email') }}</a></span></span></li>
                                <li><i class="icon-location1"></i><span><span class="h6-style">{{ translate('Address') }}:</span><span>{{ get_setting('contact_address') }}</span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom container">
            <div class="row lined py-2 py-md-3">
                <div class="col-md-2 hidden-mobile">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    <a href="#">
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" class="img-fluid" alt="{{ env('APP_NAME') }}">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                        @endif
                    </a>
                </div>
                <div class="col-md-4 col-lg-4 footer-copyright">
                    <p class="footer-copyright-text"><span>{!! get_setting('frontend_copyright_text') !!}</span></p>
                    <p class="footer-copyright-links"><a href="{{ route('terms') }}">Terms &amp; conditions</a> <a href="{{ route('privacypolicy') }}">Privacy policy</a></p>
                </div>
                
                <div class="col-md-auto">
                    <div class="payment-icons">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <img src="{{ uploaded_asset($value) }}" height="30" class=" lazyloaded" style="max-height: 30px" alt="">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-auto ml-lg-auto mb-4 mb-md-0">
                    <ul class="social-list">
                        @if ( get_setting('facebook_link') !=  null )
                        <li>
                            <a href="{{ get_setting('facebook_link') }}" target="_blank" class="icon icon-facebook"></a>
                        </li>
                        @endif
                        @if ( get_setting('twitter_link') !=  null )
                        <li>
                            <a href="{{ get_setting('twitter_link') }}" target="_blank" class="icon icon-twitter"></a>
                        </li>
                        @endif
                        @if ( get_setting('instagram_link') !=  null )
                        <li>
                            <a href="{{ get_setting('instagram_link') }}" target="_blank" class="icon icon-instagram"></a>
                        </li>
                        @endif
                        @if ( get_setting('youtube_link') !=  null )
                        <li>
                            <a href="{{ get_setting('youtube_link') }}" target="_blank" class="icon icon-youtube"></a>
                        </li>
                        @endif
                        @if ( get_setting('linkedin_link') !=  null )
                        <li>
                            <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="icon icon-linkedin"></a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
<a id="back-to-top" class="back-to-top js-back-to-top compensate-for-scrollbar is-visible" style="background-color:{{ get_setting('global_color') }};" href="#" title="Scroll To Top"><i class="icon icon-angle-up"></i></a>


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top">
    <div class="d-flex justify-content-around align-items-center">
        <a href="{{ route('home') }}" class="text-reset flex-grow-1 text-center py-2 border-right {{ areActiveRoutes(['home'],'bg-soft-primary')}}">
            <i class="las la-home "></i>
        </a>
        <a href="{{ route('categories.all') }}" class="text-reset flex-grow-1 text-center py-2 border-right {{ areActiveRoutes(['categories.all'],'bg-soft-primary')}}">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-list-ul "></i>
            </span>
        </a>
        <a href="{{ route('cart') }}" class="text-reset flex-grow-1 text-center py-2 border-right {{ areActiveRoutes(['cart'],'bg-soft-primary')}}">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-shopping-cart "></i>
                @if(Session::has('cart'))
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
                @else
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right" id="cart_items_sidenav">0</span>
                @endif
            </span>
        </a>
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset flex-grow-1 text-center py-2">
                    <span class="avatar avatar-sm d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                        @endif
                    </span>
                </a>
            @else
                <a href="javascript:void(0)" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
                    <span class="avatar avatar-sm d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                        @endif
                    </span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset flex-grow-1 text-center py-2">
                <span class="avatar avatar-sm d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                </span>
            </a>
        @endif
    </div>
</div>

@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif
