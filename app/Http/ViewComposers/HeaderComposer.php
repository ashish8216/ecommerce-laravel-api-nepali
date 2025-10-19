<?php

namespace App\Http\ViewComposers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Session;
use Auth;
use Hash;
use Cookie;
use App\Models\GeneralSetting;
use App\Models\Category;

class HeaderComposer
{
    /**
     * @var GeneralSetting
     */
    private $settings;
    /**
     * @var Category
     */
    private $category;
    
    /**
     * HeaderComposer constructor.
     * @param GeneralSetting $settings
     * * 
     */
     public function __construct(GeneralSetting $settings, Category $category)
     {
         $this->settings = $settings;
         $this->category = $category;
     }
     
     
     public function compose(View $view)
     {
         $business = $this->settings->first();
         $categories = $this->category->get();
         
         return $view->with([
            'business' => $business, 
            'categories' => $categories
        ]);
     }
}