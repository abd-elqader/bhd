<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class MobileView extends Component
{
    use WithFileUploads;
    
    public $AllTabsItems;
    public $AllHomeItems;
    public $HomeItems;
    public $TabsItems;
    
    public $Cart;
    public $Notification;
    public $Navbar;
    public $Color;
    public $Products;
    public $ProductsType;
    public $Offers;

    public $Active;

    public function mount()
    {
        $mobile = DB::table('mobile')->first();
        $this->Active = 'home';
        $this->HomeItems = collect();

        $this->Color = setting('color');
        $this->Cart = $mobile->cart;
        $this->Navbar = $mobile->navbar;
        $this->Notification = $mobile->notification;
        $this->Products = $mobile->products;
        $this->Offers = $mobile->offers;
        
        $this->AllHomeItems  = collect([
            ['display' => 1,'icon' => 'fa-solid fa-tag','key' => 'categories'],
            
            ['display' => 1,'icon' => 'fa-solid fa-tag','key' => 'most_selling'],
            ['display' => 1,'icon' => 'fa-solid fa-tag','key' => 'newest'],
            ['display' => 1,'icon' => 'fa-solid fa-tag','key' => 'offers'],
            
            ['display' => 1,'icon' => 'fa-solid fa-photo-film','key' => 'slider'],
        ]);
        $this->HomeItems  = collect(json_decode($mobile->mobile_home,true));
        $this->TabsItems = $this->AllTabsItems = collect([
            ['display' => $mobile->tabs_home,'icon' => 'fa-solid fa-house','key' => 'home'],
            ['display' => $mobile->tabs_categories,'icon' => 'fa-solid fa-table-cells','key' => 'categories'],
            ['display' => $mobile->tabs_cart,'icon' => 'fa-solid fa-cart-arrow-down','key' => 'cart'],
            ['display' => $mobile->tabs_profile_page,'icon' => 'fa-regular fa-circle-user','key' => 'profile_page'],
            ['display' => $mobile->tabs_notification,'icon' => 'fa-solid fa-bell','key' => 'notification'],
            ['display' => $mobile->tabs_orders,'icon' => 'fa-solid fa-list-check','key' => 'orders'],
        ]);
    }
    
    public function render()
    {
        return view('Tenant.Admin.mobile-app.mobile-view');
    }
    
    public function AddToHomeItems($item)
    {
        $this->HomeItems->push($this->AllHomeItems->where('key',$item)->first());
        DB::table('mobile')->update([
            'mobile_home' => $this->HomeItems
        ]);
    }
    
    public function DeleteItem($item)
    {
        $this->HomeItems = collect(\Arr::except($this->HomeItems->toarray(),$item));
        DB::table('mobile')->update([
            'mobile_home' => $this->HomeItems
        ]);
    }
    public function ToggleCart($val)
    {
        $this->Cart = $val;
        DB::table('mobile')->update([
            'cart' => $val
        ]);
    }
    public function ToggleNavbar($val)
    {
        $this->Navbar = $val;
        DB::table('mobile')->update([
            'navbar' => $val
        ]);
    }
    public function ToggleNotification($val)
    {
        $this->Notification = $val;
        DB::table('mobile')->update([
            'notification' => $val
        ]);
    }
    public function ToggleProducts($val)
    {
        $this->Products = $val;
        DB::table('mobile')->update([
            'products' => $val
        ]);
    }
    public function ToggleProductsType($val)
    {
        $this->ProductsType = $val;
        DB::table('mobile')->update([
            'products_type' => $val
        ]);
    }
    public function ToggleOffers($val)
    {
        $this->Offers = $val;
        DB::table('mobile')->update([
            'offers' => $val
        ]);
    }
    
    public function ToggleHomeItem($index,$key,$val)
    {
        DB::table('mobile')->update([
            'tabs_'.$key => $val
        ]);
        $mobile = DB::table('mobile')->first();
        $this->TabsItems = $this->AllTabsItems = collect([
            ['display' => $mobile->tabs_home,'icon' => 'fa-solid fa-house','key' => 'home'],
            ['display' => $mobile->tabs_categories,'icon' => 'fa-solid fa-table-cells','key' => 'categories'],
            ['display' => $mobile->tabs_cart,'icon' => 'fa-solid fa-cart-arrow-down','key' => 'cart'],
            ['display' => $mobile->tabs_profile_page,'icon' => 'fa-regular fa-circle-user','key' => 'profile_page'],
            ['display' => $mobile->tabs_notification,'icon' => 'fa-solid fa-bell','key' => 'notification'],
            ['display' => $mobile->tabs_orders,'icon' => 'fa-solid fa-list-check','key' => 'orders'],
        ]);
    }
    
    public function SetActive($val)
    {
        $this->Active = $val;
    }
    
    public function updatedColor($val)
    {
        \App\Models\Setting::where('key','color')->update(['value'=>$val]);
    }
    
    

 

}
