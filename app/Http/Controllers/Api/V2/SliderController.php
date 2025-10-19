<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\SliderCollection;

class SliderController extends Controller
{
    public function index()
    {
        
     
        $images = get_setting('home_slider_images');
        $links =get_setting('home_slider_links');
        $object = array();
        foreach(json_decode(get_setting('home_slider_images')) as $key=>$val){
            $object[]= array(
                'image' => $val,
                 'url'=>json_decode(get_setting('home_slider_links'))[$key]
                );
        }
        
       return new SliderCollection($object, true);
        
    }
}
