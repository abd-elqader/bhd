@extends('Central.User.components.layout')
@section('content')

    <div class="bread py-5">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('client.pricing') }}">@lang('website.pricing')</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @php($Packages = Packages())
    <div class="my_table my-5 mx-3">
        <div class="container">
            <table class="table rounded">
                <thead>
                    <tr class="">
                        <th scope="col">
                            <h4 class="fw-bold main_color my_table_size_2">@lang('messages.Packages')</h4>
                        </th>
                        @foreach ($Packages as $key => $Package)
                            @php($color = $key == 1 ? 'yellow_color' : ($key == 2 ? 'blue_color' : 'main_color'))
                            <th scope="col">
                                <span class="d-block {{ $color }} h4 fw-bold mb-0 my_table_size">{{ $Package->title() }}</span>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h5 class="my_table_size_2">@lang('website.monthly_subscribe')</h5>
                        </td>
                        @foreach ($Packages as $key => $Package)
                            @php($color = $key == 1 ? 'yellow_color' : ($key == 2 ? 'blue_color' : 'main_color'))
                            <td class="fw-bold {{ $color }} my_table_size">
                                @if($Package->discount)
                                <span style="text-decoration: line-through 2px red;    font-size: 14px;">{{ $Package->price_before }}</span><span class="text-danger mx-4"><b>{{ $Package->price_after }}</b></span>
                                @else
                                <span>{{ $Package->price() }}</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @foreach (FeatureHeader() as $Header)
                        <thead>
                            <tr>
                                <th colspan="4">
                                    <h4 class="fw-bold main_color my_table_size">{{ $Header->title() }}</h4>
                                </th>
                            </tr>
                        </thead>
                        @foreach ($Header->features as $feature)
                            <tr>
                                <th>
                                    @if ($feature->title())
                                        <h5 class="my_table_size_2">{{ $feature->title() }}</h5>
                                    @endif
                                    @if ($feature->image)
                                        <img style="width: 100px" src="{{ public_asset($feature->image) }}" class="img-fluid" alt="image">
                                    @endif
                                </th>
                                @foreach ($Packages as $Package)
                                @if ($feature)
                                    @if ($feature->type == 'icon')
                                        @php($exists = $Package->features->whereIn('id',$feature->id)->count() > 0)
                                        <td class=""><span class="{{ $exists ? 'my_check' : 'my_close' }}"><i class="{{ $exists ? 'fa-solid fa-check' : 'fa-solid fa-xmark' }}"></i></span></td>
                                    @endif
                                    @if($feature->type == 'text')
                                        @php($feature =  $Package->features->whereIn('id',$feature->id)->first())
                                        @php($text = $feature ? $feature->pivot->title() : NULL)
                                        <td class=""><span>{{ $text }}</span></td>
                                    @endif
                                @endif
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                    <thead class="">
                        <tr>
                            <th></th>
                            <td colspan="3">
                                <a href="{{ route('client.register') }}" class="gradient-button compare-link text-decoration-none w-100" data-wpel-link="external" target="_blank" rel="nofollow external noopener noreferrer">@lang('website.subscribe')</a>
                            </td>
                        </tr>
                    </thead>
                </tbody>
            </table>
        </div>
    </div>
@endsection
