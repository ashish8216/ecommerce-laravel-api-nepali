

<div class="dropdown show">
    <a href="#" class="d-inline align-items-center text-reset">
        <span>
            <span class="nav-box-text fw-600 opacity-80 hov-opacity-100">{{translate('Home')}}</span>
        </span>
    </a>
    <a href="#" class="d-inline align-items-center text-reset ml-3">
        <span>
            <span class="nav-box-text fw-600 opacity-80 hov-opacity-100">{{translate('Flash Sale')}}</span>
        </span>
    </a>
    <a href="#" class="d-inline align-items-center text-reset ml-3">
        <span>
            <span class="nav-box-text fw-600 opacity-80 hov-opacity-100">{{translate('Blogs')}}</span>
        </span>
    </a>

    <a class="dropdown-toggle d-inline text-reset ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>
            <span class="nav-box-text fw-600 opacity-80 hov-opacity-100">{{translate('Categories')}}</span>
        </span>
    </a>
    
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">Category 1</a>
        <a class="dropdown-item" href="#">Category 2</a>
        <a class="dropdown-item" href="#">Category 3</a>
    </div>
    <a class="dropdown-toggle d-inline text-reset ml-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>
            <span class="nav-box-text fw-600 opacity-80 hov-opacity-100">{{translate('Brands')}}</span>
        </span>
    </a>
    
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">Category 1</a>
        <a class="dropdown-item" href="#">Category 2</a>
        <a class="dropdown-item" href="#">Category 3</a>
    </div>
</div>

<!--reference-->
 @if ( get_setting('header_menu_labels') !=  null )
        <!--<div class="bg-white border-top border-gray-200" >-->
        <!--    <div class="container">-->
        <!--        <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">-->
        <!--            @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)-->
        <!--            <li class="list-inline-item mr-0">-->
        <!--                <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="opacity-100 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">-->
        <!--                    {{ translate($value) }}-->
        <!--                </a>-->
        <!--            </li>-->
        <!--            @endforeach-->
        <!--        </ul>-->
        <!--    </div>-->
        <!--</div>-->
    @endif