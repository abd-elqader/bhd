<div class="row my-5">
    <div class="col-md-9">
        <h2 class="my-3">تصميم التطبيق</h2>
        <nav>
            <div class="nav nav-tabs nav-pills nav-fill justify-content-center" id="nav-tab" role="tablist">
                <button wire:click="SetActive('home')" class="nav-link {{ $Active == 'home' ? 'active' : '' }}" id="nav-home-page-tab" data-bs-toggle="tab" data-bs-target="#nav-home-page" type="button" role="tab" aria-controls="nav-home-page" aria-selected="true">الصفحة الرئيسية</button>
                <button wire:click="SetActive('topbar')" class="nav-link {{ $Active == 'topbar' ? 'active' : '' }}" id="nav-topbar-and-tabs-tab" data-bs-toggle="tab" data-bs-target="#nav-topbar-and-tabs" type="button" role="tab" aria-controls="nav-topbar-and-tabs" aria-selected="false">الشريط العلوي والتبويبات</button>
                <button wire:click="SetActive('settings')" class="nav-link {{ $Active == 'settings' ? 'active' : '' }}" id="nav-general-settings" data-bs-toggle="tab" data-bs-target="#nav-general-settings" type="button" role="tab" aria-controls="nav-general-settings" aria-selected="false">إعدادات عامة</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade {{ $Active == 'home' ? 'show active' : '' }}" id="nav-home-page" role="tabpanel" aria-labelledby="nav-home-page-tab">
                @if($HomeItems->count() == 0)
                    <div class="text-center">
                    <svg width="200px" height="512px" viewBox="0 0 308 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="phone-icon">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="wireframe" fill="#000000" fill-rule="nonzero">
                                <path d="M264.535156,512 C288.085938,511.972656 307.171875,492.886719 307.199219,469.332031 L307.199219,42.667969 C307.171875,19.113281 288.085938,0.0273438 264.535156,0 L42.667969,0 C19.113281,0.0273438 0.0273438,19.113281 -2.84217094e-14,42.667969 L-2.84217094e-14,469.332031 C0.0273438,492.886719 19.113281,511.972656 42.667969,512 L264.535156,512 Z M17.066406,85.332031 L290.132812,85.332031 L290.132812,426.667969 L17.066406,426.667969 L17.066406,85.332031 Z M42.667969,17.066406 L264.535156,17.066406 C278.671875,17.066406 290.132812,28.527344 290.132812,42.667969 L290.132812,68.265625 L17.066406,68.265625 L17.066406,42.667969 C17.066406,28.527344 28.527344,17.066406 42.667969,17.066406 Z M17.066406,469.332031 L17.066406,443.734375 L290.132812,443.734375 L290.132812,469.332031 C290.132812,483.472656 278.671875,494.933594 264.535156,494.933594 L42.667969,494.933594 C28.527344,494.933594 17.066406,483.472656 17.066406,469.332031 L17.066406,469.332031 Z" id="Shape">
                                </path>
                                <path d="M119.464844,51.199219 L128,51.199219 C132.710938,51.199219 136.535156,47.378906 136.535156,42.667969 C136.535156,37.953125 132.710938,34.132812 128,34.132812 L119.464844,34.132812 C114.753906,34.132812 110.933594,37.953125 110.933594,42.667969 C110.933594,47.378906 114.753906,51.199219 119.464844,51.199219 Z" id="Path">
                                </path>
                                <path d="M162.132812,51.199219 L187.734375,51.199219 C192.445312,51.199219 196.265625,47.378906 196.265625,42.667969 C196.265625,37.953125 192.445312,34.132812 187.734375,34.132812 L162.132812,34.132812 C157.421875,34.132812 153.601562,37.953125 153.601562,42.667969 C153.601562,47.378906 157.421875,51.199219 162.132812,51.199219 Z" id="Path">
                                </path>
                                <path d="M119.464844,477.867188 L187.734375,477.867188 C192.445312,477.867188 196.265625,474.046875 196.265625,469.332031 C196.265625,464.621094 192.445312,460.800781 187.734375,460.800781 L119.464844,460.800781 C114.753906,460.800781 110.933594,464.621094 110.933594,469.332031 C110.933594,474.046875 114.753906,477.867188 119.464844,477.867188 Z" id="Path">
                                </path>
                                <path d="M51.199219,392.535156 L42.667969,392.535156 C37.953125,392.535156 34.132812,396.355469 34.132812,401.066406 C34.132812,405.78125 37.953125,409.601562 42.667969,409.601562 L51.199219,409.601562 C55.914062,409.601562 59.734375,405.78125 59.734375,401.066406 C59.734375,396.355469 55.914062,392.535156 51.199219,392.535156 L51.199219,392.535156 Z" id="Path">
                                </path>
                                <path d="M136.535156,392.535156 L85.332031,392.535156 C80.621094,392.535156 76.800781,396.355469 76.800781,401.066406 C76.800781,405.78125 80.621094,409.601562 85.332031,409.601562 L136.535156,409.601562 C141.246094,409.601562 145.066406,405.78125 145.066406,401.066406 C145.066406,396.355469 141.246094,392.535156 136.535156,392.535156 L136.535156,392.535156 Z" id="Path">
                                </path>
                                <path d="M179.199219,392.535156 L170.667969,392.535156 C165.953125,392.535156 162.132812,396.355469 162.132812,401.066406 C162.132812,405.78125 165.953125,409.601562 170.667969,409.601562 L179.199219,409.601562 C183.914062,409.601562 187.734375,405.78125 187.734375,401.066406 C187.734375,396.355469 183.914062,392.535156 179.199219,392.535156 L179.199219,392.535156 Z" id="Path">
                                </path>
                                <path d="M264.535156,392.535156 L213.332031,392.535156 C208.621094,392.535156 204.800781,396.355469 204.800781,401.066406 C204.800781,405.78125 208.621094,409.601562 213.332031,409.601562 L264.535156,409.601562 C269.246094,409.601562 273.066406,405.78125 273.066406,401.066406 C273.066406,396.355469 269.246094,392.535156 264.535156,392.535156 L264.535156,392.535156 Z" id="Path">
                                </path>
                                <path d="M256,102.398438 L51.199219,102.398438 C41.773438,102.398438 34.132812,110.039062 34.132812,119.464844 L34.132812,238.933594 C34.132812,248.359375 41.773438,256 51.199219,256 L256,256 C265.425781,256 273.066406,248.359375 273.066406,238.933594 L273.066406,119.464844 C273.066406,110.039062 265.425781,102.398438 256,102.398438 Z M51.199219,125.320312 L137.480469,179.199219 L51.199219,233.078125 L51.199219,125.320312 Z M74.0625,119.464844 L233.140625,119.464844 L153.601562,169.128906 L74.0625,119.464844 Z M153.601562,189.269531 L233.140625,238.933594 L74.0625,238.933594 L153.601562,189.269531 Z M169.71875,179.199219 L256,125.320312 L256,233.089844 L169.71875,179.199219 Z" id="Shape">
                                </path>
                                <path d="M140.195312,278.1875 C140.097656,278.105469 139.992188,278.03125 139.886719,277.964844 C136.722656,274.835938 132.453125,273.074219 128,273.066406 L51.199219,273.066406 C41.773438,273.066406 34.132812,280.707031 34.132812,290.132812 L34.132812,358.398438 C34.132812,367.824219 41.773438,375.464844 51.199219,375.464844 L128,375.464844 C137.425781,375.464844 145.066406,367.824219 145.066406,358.398438 L145.066406,290.132812 C145.058594,285.773438 143.375,281.585938 140.363281,278.433594 C140.289062,278.347656 140.269531,278.238281 140.195312,278.1875 L140.195312,278.1875 Z M114.398438,290.132812 L51.199219,347.792969 L51.199219,290.132812 L114.398438,290.132812 Z M64.90625,358.398438 L128,300.816406 L128,358.398438 L64.90625,358.398438 Z" id="Shape">
                                </path>
                                <path d="M268.195312,278.1875 C268.097656,278.105469 267.992188,278.03125 267.886719,277.964844 C264.722656,274.835938 260.453125,273.074219 256,273.066406 L179.199219,273.066406 C169.773438,273.066406 162.132812,280.707031 162.132812,290.132812 L162.132812,358.398438 C162.132812,367.824219 169.773438,375.464844 179.199219,375.464844 L256,375.464844 C265.425781,375.464844 273.066406,367.824219 273.066406,358.398438 L273.066406,290.132812 C273.058594,285.773438 271.375,281.585938 268.363281,278.433594 C268.289062,278.347656 268.269531,278.238281 268.195312,278.1875 L268.195312,278.1875 Z M242.398438,290.132812 L179.199219,347.792969 L179.199219,290.132812 L242.398438,290.132812 Z M192.90625,358.398438 L256,300.816406 L256,358.398438 L192.90625,358.398438 Z" id="Shape">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <h2 class="text-muted">
                        قم بتخصيص واجهة التطبيق الخاص بك من خلال اضافة عناصر متعددة و متميزة
                    </h2>
                    <p class="text-muted">انقر على عنصر جديد للبدأ</p>
                    <button type="button" class="btn btn-primary my-4" id="new_item" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-circle-plus mx-2"></i>عنصر جديد</button>
                    <ul class="dropdown-menu" aria-labelledby="new_item" style="     cursor: pointer;   text-align: {{ lang('ar') ? 'right;' : 'left;' }}">
                        @foreach($AllHomeItems->whereNotIn('key',$HomeItems->pluck('key')) as $HomeItem)
                            <li>
                                <a class="dropdown-item my-1" onclick="AddToHomeItems('{{ $HomeItem['key'] }}')">
                                    <i class="{{ $HomeItem['icon'] }}"></i>
                                    @lang('dashboard.'.$HomeItem['key'])
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @else
                    <div class="row">
                    <div class="col-md-3">
                        <div class="row my-4">
                            @foreach($HomeItems as $key => $HomeItem)
                                <div class="col-12 item">
                                    <i class="fa-solid fa-trash-can text-danger" wire:click="DeleteItem({{ $key }})"></i>
                                    {{ __('dashboard.'.$HomeItem['key']) }}
                                </div>
                            @endforeach
                            <button class="btn btn-primary my-4  w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa-solid fa-circle-plus mx-2"></i>عنصر جديد
                            </button>

                            <div class="collapse" id="collapseExample">
                                <div class="position-relative">
                                    <ul class="position-absolute w-100" aria-labelledby="item_new" style="display: contents;cursor: pointer;text-align: {{ lang('ar') ? 'right;' : 'left;' }};">
                                        @foreach($AllHomeItems->whereNotIn('key',$HomeItems->pluck('key')) as $HomeItem)
                                            <li>
                                                <a class="dropdown-item my-1" onclick="AddToHomeItems('{{ $HomeItem['key'] }}')">
                                                    <i class="{{ $HomeItem['icon'] }}"></i>
                                                    @lang('dashboard.'.$HomeItem['key'])
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>
                @endif
            </div>
            <div class="tab-pane fade {{ $Active == 'topbar' ? 'show active' : '' }}" id="nav-topbar-and-tabs" role="tabpanel" aria-labelledby="nav-topbar-and-tabs-tab">
                <div class="row m-4">
                    <div class="col-md-6">
                        <h3>الشريط العلوي</h3>
                        <p>قم باختيار الاعدادات الخاصة بالشريط العلوي الذي سيحتوي على شعار المتجر</p>
                        <div class="row">
                            <div class="col-6 p-3">{{ __('dashboard.cart') }}</div>
                            <div class="col-6 p-3 d-flex justify-content-end">
                                <label class="switch toggleswitch bg-dark" wire:click="ToggleCart({{ $Cart ? 0 : 1 }})">
                                    <input type="checkbox" @if($Cart) checked="checked" @endif>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 p-3">{{ __('dashboard.notification') }}</div>
                            <div class="col-6 p-3 d-flex justify-content-end">
                                <label class="switch toggleswitch bg-dark" wire:click="ToggleNotification({{ $Notification ? 0 : 1 }})">
                                    <input type="checkbox" @if($Notification) checked="checked" @endif>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        {{--
                        <div class="row">
                            <div class="col-6">
                                <h3>الشريط الثانوي</h3>
                            </div>
                            <div class="col-6">
                                <select class="form-select" wire:model="Navbar">
                                  <option value="categories">@lang('dashboard.categories')</option>
                                  <option value="cart">@lang('dashboard.cart')</option>
                                  <option value="hide">@lang('dashboard.hide')</option>
                                </select>
                            </div>
                        </div>
                        --}}
                       <div class="row">
                            <div class="col-6 p-3">{{ __('dashboard.color') }}</div>
                            <input  type="color" name="color" wire:model="Color">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>تبويبات التطبيق</h3>
                        <p>قم بالتحكم بالتبويبات السفلية الخاصة بالتطبيق</p>
                        @foreach($AllTabsItems as  $key => $Item)
                         <div class="row">
                            <div class="col-6 p-3">{{ __('dashboard.'.$Item['key']) }}</div>
                            <div class="col-6 p-3 d-flex justify-content-end">
                                <label class="switch toggleswitch bg-dark" wire:click="ToggleHomeItem({{ $key }},'{{ $Item['key'] }}',{{ !$Item['display'] > 0 ? 1 : 0 }})">
                                    <input type="checkbox" @if($Item['display']) checked="checked" @endif>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
           
            <div class="tab-pane fade {{ $Active == 'settings' ? 'show active' : '' }}" id="nav-general-settings" role="tabpanel" aria-labelledby="nav-general-settings-tab">
                <div class="row m-4">
                    <div class="col-md-12">
                        <h3>تصميم المنتجات</h3>
                        <p>اختر شكل المنتج الذي سيظهر في الصفحة الرئيسية و التصنيفات و المنتجات المقترحة</p>
                        <div class="row p-2 text-center">
                            <div class="col-md-6 {{ $Products == 'horizontal' ? 'border border-success' : '' }}">
                                <div class="col-6 p-3">{{ __('dashboard.horizontal') }}</div>
                            <img src="{{ public_asset('/mobile-app-images/horizontal.png') }}" class="img-fluid" wire:click="ToggleProducts('horizontal')">
                            </div>
                            <div class="col-md-6 {{ $Products == 'vertical' ? 'border border-success' : '' }}">
                                <div class="col-6 p-3">{{ __('dashboard.vertical') }}</div>
                            <img src="{{ public_asset('/mobile-app-images/vertical.png') }}" class="img-fluid" wire:click="ToggleProducts('vertical')">
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="col-md-12">
                        <h3>عرض المنتجات</h3>
                        <p>اختر شكل المنتج الذي سيظهر في الصفحة الرئيسية و التصنيفات و المنتجات المقترحة</p>
                        <div class="row p-2 text-center">
                            <div class="col-md-6 {{ $ProductsType == 'animated_products' ? 'border border-success' : '' }}">
                                <div class="col-6 p-3">{{ __('dashboard.animated_products') }}</div>
                            <img src="{{ public_asset('/mobile-app-images/animated_products.png') }}" class="img-fluid" wire:click="ToggleProductsType('animated_products')">
                            </div>
                            <div class="col-md-6 {{ $ProductsType == 'static_products' ? 'border border-success' : '' }}">
                                <div class="col-6 p-3">{{ __('dashboard.static_products') }}</div>
                            <img src="{{ public_asset('/mobile-app-images/static_products.png') }}" class="img-fluid" wire:click="ToggleProductsType('static_products')">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h3>نمط العنوان الترويجي</h3>
                        <p>اختر شكل شريط العنوان الترويجي الذي سيظهر على المنتجات في الصفحة الرئيسية و التصنيفات و المنتجات المقترحة</p>
                        <div class="row p-2 text-center">
                            <div class="col-md-3 {{ $Offers == 'wide' ? 'border border-success' : '' }}">
                            <img src="{{ public_asset('/mobile-app-images/wide.svg') }}" class="img-fluid w-100 my-1" style="border: 1px solid #CCC;" wire:click="ToggleOffers('wide')">
                            </div>
                            <div class="col-md-3 {{ $Offers == 'throw' ? 'border border-success' : '' }}">
                            <img src="{{ public_asset('/mobile-app-images/throw.svg') }}" class="img-fluid w-100 my-1" style="border: 1px solid #CCC;" wire:click="ToggleOffers('throw')">
                            </div>
                            <div class="col-md-3 {{ $Offers == 'basic' ? 'border border-success' : '' }}">
                            <img src="{{ public_asset('/mobile-app-images/basic.svg') }}" class="img-fluid w-100 my-1" style="border: 1px solid #CCC;" wire:click="ToggleOffers('basic')" >
                            </div>
                            <div class="col-md-3 {{ $Offers == 'star' ? 'border border-success' : '' }}">
                            <img src="{{ public_asset('/mobile-app-images/star.svg') }}" class="img-fluid w-100 my-1" style="border: 1px solid #CCC;" wire:click="ToggleOffers('star')" >
                            </div>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex justify-content-center">

        <div class="smartphone">
            <div class="content position-relative">
                <div class="row  d-flex justify-content-center">
                    <div class="col-3 m-auto text-center">
                        <i class="fa-solid fa-list" style="color:{{ $Color }};font-size: 22px;"></i>
                    </div>
                    <div class="col-6 p-3  text-center">
                        <img src="{{ public_asset(setting('logo')) }}" width="50px" height="50px" class="d-inline-block align-top" alt="">
                    </div>
                    <div class="col-3 m-auto text-center text-center">
                        @if($Cart)
                            <i class="fa-solid fa-cart-shopping" style="color:{{ $Color }};font-size: 22px;"></i>
                        @endif
                        @if($Notification)
                            <i class="fa-solid fa-bell" style="color:{{ $Color }};font-size: 22px;"></i>
                        @endif
                    </div>
                </div>
                {{--
                @if($Navbar != 'hide')
                    @if($Navbar == 'categories')
                    <div style="display: flex;width: max-content;overflow-x: hidden;">
                        @for ($i = 1; $i < 10; $i++)
                             <span class="mx-2" style="color:{{ $Color }}">
                                 {{ __('dashboard.category') }}-{{ $i . '  ' }} 
                             </span>
                        @endfor
                    </div>
                    @elseif($Navbar == 'cart')
                    <div class="row">
                      <div class="col-10">
                        <input type="cart" id="form1" class="form-control" />
                      </div>
                      <div class="col-2">
                          <button type="button" class="btn" style="background-color:{{ $Color }};border-color:{{ $Color }}">
                            <i class="fas fa-cart text-white"></i>
                          </button>
                      </div>
                    </div>
                    @endif
                @endif
                --}}
                @foreach($HomeItems as  $HomeItem)
                    <p class="mt-2">{{ __('dashboard.'.$HomeItem['key']) }}</p>
                    <img src="{{ public_asset('/mobile-app-images/'.$HomeItem['key'].'.png') }}" class="img-fluid" >
                @endforeach
                @if(count($TabsItems) && $HomeItems->count())
                    <div style="display: flex;width: max-content;overflow-x: auto;overflow-y: hidden;">
                        @foreach($TabsItems->where('display',1) as  $HomeItem)
                            @if($HomeItem['display'])
                                 <span class="mx-1 text-center" style="color:{{ $Color }}">
                                     <i class="{{ $HomeItem['icon'] }}"></i>
                                     <br>
                                     {{ __('dashboard.'.$HomeItem['key']) }}
                                 </span>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function AddToHomeItems(vav) {
            @this.AddToHomeItems(vav);
        }
    </script>
</div>