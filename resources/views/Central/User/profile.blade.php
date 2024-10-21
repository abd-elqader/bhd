<div class="h-100" style="direction: ltr;">
    <style>
        .group input:focus~label,
        .group input:valid~label {
            color: {{ ($domain_name ? ($tenant_exists ? 'red' : '#5264AE') : '#5264AE')  }};
        }
        .group  .bar:before,
        .group  .bar:after {
            background: {{ ($domain_name ? ($tenant_exists ? 'red' : '#5264AE') : '#5264AE')  }};
        }

        @-webkit-keyframes inputHighlighter {
            from {
                background: {{ ($domain_name ? ($tenant_exists ? 'red' : '#5264AE') : '#5264AE')  }};
            }

            to {
                width: 0;
                background: transparent;
            }
        }

        @-moz-keyframes inputHighlighter {
            from {
                background: {{ ($domain_name ? ($tenant_exists ? 'red' : '#5264AE') : '#5264AE')  }};
            }

            to {
                width: 0;
                background: transparent;
            }
        }

        @keyframes inputHighlighter {
            from {
                background: {{ ($domain_name ? ($tenant_exists ? 'red' : '#5264AE') : '#5264AE')  }};
            }

            to {
                width: 0;
                background: transparent;
            }
        }
        
        
        
        .count_down{
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          text-align: center;
        }
        
        .count_down h2{
          font-size: 56px;
          font-weight: 300;
          line-height: 1em;
          font-family: "Arial", "Sans Serif";
        }

        .rubber_stamp {
          font-family: 'Vollkorn', serif;
          font-size: 39px;
          line-height: 45px;
          text-transform: uppercase;
          font-weight: bold;
          color: red;
          border: 7px solid red;
          float: left;
          padding: 10px 7px;
          border-radius: 10px;
          
          opacity: 0.8;
          -webkit-transform: rotate(-10deg);
          -o-transform: rotate(-10deg);
          -moz-transform: rotate(-10deg);
          -ms-transform: rotate(-10deg);
          position:absolute;
          top:32%;
        }
        .rubber_stamp::after {
          position: absolute;
          content: " ";
          width: 100%;
          height: auto;
          min-height: 100%;
          top: -10px;
          left: -10px;
          padding: 10px;
          background: url(https://raw.github.com/domenicosolazzo/css3/master/img/noise.png) repeat;
        }
    </style>
    <div class="row align-items-center justify-content-center h-100 w-100 position-relative">
        <link rel="stylesheet" href="{{ public_asset('/Central/css/profile.css') }}">
        @if ((!$approved || !$user->domain_name))
            @if($currentStep == 1  && !$user->domain_name)
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>
                            <span>w</span>
                            <span>e</span>
                            <span>l</span>
                            <span>c</span>
                            <span>o</span>
                            <span>m</span>
                            <span>e</span>
                        </h1>
                        <h3>
                            <span>Create a website without limits</span>
                        </h3>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="main_bt transition_me border-0 mx-auto rounded-pill px-5 py-2" wire:click="increaseStep()">
                            <p class="my-auto">Get Started</p>
                        </button>
                    </div>
                </div>
            @elseif($currentStep == 2 || !$user->domain_name)
                <div class="row">
                    <div class="col-12 text-center my-1">
                        <h3>
                            what&#39;s the name of Your Website
                        </h3>
                    </div>
                    <div class="col-12 d-flex align-items-start justify-content-center">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="group">
                                    <input type="text" wire:model="domain_name" wire:keyup="VerifySubDomain()" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Enter Your Store Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <button type="button" class="main_bt transition_me border-0 mx-auto rounded-pill px-5 py-2 w-100" wire:click="increaseStep()">
                                    <p class="my-auto">Next</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute point" style="bottom: 5%; left: 3%" wire:click="decreaseStep()">
                    <i class="fa-regular fa-circle-left mx-2"></i>Back
                </div>
            @elseif(!$UserPackage || $user->Transactions()->count() == 0)
                <div class="row">
                    @if (Packages()->count())
                        <div class="package my-5">
                            <div class="container">
                                <div class="title text-center py-4">
                                    <h3 class="fw-bold">@lang('messages.Packages')</h3>
                                </div>
                                <div class="row" style="direction:{{ lang('en') ? 'ltr' : 'rtl' }}">
                                    @foreach (PackageDesc() as $Description)
                                        <div class="col-md-6">{{ $loop->iteration }} - {{ $Description->title() }}</div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center text-danger">
                                        الدومين سيكون عبارة عن علي سبيل المثال 
                                        <p>
                                            rashid.matjrbh.com
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="row align-items-end">
                                    @foreach (Packages() as $Package)
                                        <div class="col-sm-12 col-md">
                                            <div class="in_package point rounded my-3 py-3">
                                                <div class="text-center my-3">
                                                    <h3 class="main_color fw-bold">{{ $Package->title() }}</h3>
                                                    <p class="main_color">
                                                        @if($IndividualDomain && $loop->first)
                                                        {{ str_replace("9.900",9.900 + setting('IndividualDomain'),$Package->price()) }}
                                                        @else
                                                        
                                                        @if($Package->discount)
                                                        <span style="text-decoration: line-through 2px red;    font-size: 14px;">{{ $Package->price_before }}</span><span class="text-danger mx-4"><b>{{ $Package->price_after }}</b></span>
                                                        @else
                                                        <span>{{ $Package->price() }}</span>
                                                        @endif
                                        
                                                        @endif
                                                    </p>
                                                </div>
                                                <ul class="list-unstyled px-0">
                                                    @foreach ($Package->Descriptions as $Description)
                                                    <li class="my-2">
                                                        <p class="tiny_font">{{ $Description->title() }}</p>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @if($SelectedPackage == $Package->id)
                                                    @if($loop->first)
                                                        <div class="mt-1">
                                                            {{--
                                                                <label class="d-flex justify-content-center">
                                                                    <input type="checkbox" value="1" wire:model="IndividualDomain"  class="form-checkbox h-6 w-6 text-green-500">
                                                                    <span class="mx-1">{{ __('website.IndividualDomain') }}</span>
                                                                </label>
                                                                <label class="d-flex justify-content-center">
                                                                    <span class="mx-1 text-center">{{ __('website.domain_desc') }}</span>
                                                                </label>
                                                            @if($IndividualDomain)
                                                                <div class="mx-1">
                                                                    <input type="text" wire:model="domain" placeholder="domain.com" class="form-control" style="border: 1px solid #2eafc6;">
                                                                </div>
                                                            @endif
                                                            --}}
                                                        </div>
                                                    @else
                                                            <div class="mt-1">
                                                                <div class="mx-1">
                                                                    <input type="text" wire:model="domain" placeholder="domain.com" class="form-control" style="border: 1px solid #2eafc6;">
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endif
                                                <div class="my-2 py-2 text-center">
                                                    @if(!$SelectedPackage)
                                                        <button type="button"  class="rounded-pill border-0 main_bt transition_me py-2 text-decoration-none h6 px-5" wire:loading.attr="disabled" wire:loading.class="bg-gray-400" wire:click="SelectPackage({{ $Package->id }})">
                                                            @lang('website.selectPackage')
                                                        </button>

                                                    @elseif($SelectedPackage == $Package->id )
                                                        <button type="button" wire:loading.attr="disabled" class="rounded-pill border-0 main_bt transition_me p-2 px-3  text-decoration-none h6" wire:click="SelectPackageId()">
                                                            <i class="fa fa-cog fa-spin mx-2" style="font-size:24px" wire:loading wire:target="SelectPackageId"></i>
                                                            @lang('messages.Submit')
                                                        </button>
                                                    @else
                                                        <button type="button"  class="rounded-pill border-0 main_bt transition_me py-2 text-decoration-none h6 px-5" wire:loading.attr="disabled" wire:loading.class="bg-gray-400"  wire:click="SelectPackage({{ $Package->id }})">
                                                            @lang('website.selectPackage')
                                                        </button>
                                                    @endif
 
                                                    <div wire:loading wire:target="SelectPackage({{ $Package->id }})">
                                                        <i class="fa fa-cog fa-spin mx-2" style="font-size:24px"></i> Processing ...
                                                    </div>
                                                   
                                                    <div wire:loading wire:target="SelectPackageId({{ $Package->id }})">
                                                        <i class="fa fa-cog fa-spin mx-2" style="font-size:24px"></i> Processing ...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        @else
            <?php header("Location: ".tenant_route(\App\Models\Tenant::where('id', auth('client')->user()->domain_name)->first()->id.'.'.env('APP_DOMAIN'), 'admin.login_wihout_form',[
                    'phone'=> $user->phone,
                    'password'=> $user->password,
                ])); exit(); ?>
            <div class="row container align-items-center">
                <div class="col-12 col-md-12 text-center">
                    @if($UserPackage)
                        <div class="count_down">
                          <h2 id="count_down"></h2>
                        </div>
                    @else
                        <div class="rubber_stamp">{{ __("dashboard.expired") }}</div>
                    @endif
                    @if(\Carbon\Carbon::parse($UserPackage->end_date)->diffInDays(now()) <=5)
                        <a href="{{ route('client.post_renew',['package_id'=>$UserPackage->package_id]) }}" style="width: 190px !important" class=" my-3 gradient-button compare-link text-decoration-none mx-1" data-wpel-link="external" rel="nofollow external noopener noreferrer">@lang('website.renew')</a>
                    @endif
                </div>
                
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="d-flex align-items-center w-100 h-100 justify-content-center justify-content-lg-start">
                        <div class="my-4">
                            <p style="color: rgb(97, 97, 97)" class="mb-4">You are ready for you next step</p>
                            <h3 class="fw-bold">Continue setting up your <br> store in your dashboard</h3>
                            <button type="button" class="main_bt transition_me border-0 mx-auto rounded-pill px-5 py-2" wire:click="GoToDashboard()">
                                <p class="my-auto">Go To Dashboard</p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="my-3">
                        <img src="/screen.jpeg" class="img-fluid" alt="image">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    window.addEventListener('alert', event => {
        swal({
            title: event.detail.message,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
    });
</script>
@if($UserPackage)
    <script>
        const output = document.getElementById("count_down");
        
        const countDown = () => {
          const countDownDate = new Date('{{ $UserPackage->end_date }}').getTime();
          
          const now = new Date().getTime();
          
          const distance = countDownDate - now;
          
          const dd = Math.floor(
            distance / (1000 * 60 * 60 * 24)
          );
        
          const hh = Math.floor(
            (distance % (1000 * 60 * 60 * 24))/(1000 * 60 * 60)
          );
          
          const mm = Math.floor(
            (distance % (1000 * 60 * 60)) / (1000 * 60)
          );
          
          const ss = Math.floor(
            (distance % (1000 * 60)) / 1000
          );
          
          output.innerText = '{{ __("messages.expired_at") }}: ' +dd + '{{ __("messages.days") }} ' + hh + '{{ __("messages.hours") }} ' + mm + ':' + ss;
        
          if(distance < 0){
            output.innerText = "Tempo Esgotado!"
          }
        }
        
        countDown();
        setInterval(countDown,1000);
    </script>
@endif