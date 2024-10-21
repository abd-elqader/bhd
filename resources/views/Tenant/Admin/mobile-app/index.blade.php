@extends('Mix.layouts.app')
@section('pagetitle',__('dashboard.Mobile_Theme'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ __('dashboard.Mobile_Theme') }}</li>
    </ol>
</nav>

<article class="text-center mb-50">
    <h2 class="font-30 text-bold mb-20 mt-0 lh-1">{{ __('dashboard.Mobile_Theme') }}</h2>
    <p class="font-18 align-center m-0">
        اصنع لمتجرك تطبيق إحترافي خلال 72 ساعة وبدون مبرمج!
    </p>
    <span class="text-muted">
        في حالة تم انشاء حساب المطورين في متاجر التطبيقات (App Store, Google Play)
    </span>
</article>


<div class="row">
    <div class="col-12 col-md-6">
        <h2><img src="{{ public_asset('app_preview.svg') }}" alt="Smiley face" height="100">@lang('dashboard.preview')</h2>
        <p>
            حمّل تطبيق “محاكي تطبيقات متجر” لمعاينة تطبيق متجرك على جوالك مباشرة.
        </p>
    </div>
    <div class="col-12 col-md-3 text-center">
        <img src="{{ public_asset('android-qr-code.svg') }}" alt="Smiley face" height="200" onclick="window.open('{{ setting('android') }}')">
    </div>
    <div class="col-12 col-md-3 text-center">
        <img src="{{ public_asset('ios-qr-code.svg') }}" alt="Smiley face" height="200" onclick="window.open('{{ setting('apple') }}')">
    </div>
</div>

@livewire('mobile-view')

@endsection

@section('css')

    @livewireStyles
    <style>
    .breadcrumb-item+.breadcrumb-item::before {
        float: inherit;
    }

    .smartphone {
        position: relative;
        width: 400px;
        height: auto;
        margin: auto;
        border: 19px black solid;
        border-top-width: 60px;
        border-bottom-width: 60px;
        border-radius: 36px;
        max-width: 100% !important;
        
        max-height: 700px;
    }

    /* The horizontal line on the top of the device */
    .smartphone:before {
        content: '';
        display: block;
        width: 60px;
        height: 5px;
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 10px;
    }

    /* The circle on the bottom of the device */
    .smartphone:after {
        content: '';
        display: block;
        width: 35px;
        height: 35px;
        position: absolute;
        left: 50%;
        bottom: -65px;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 50%;
    }

    /* The screen (or content) of the device */
    .content {
        height: 513px;
        border-radius: 10px;
        padding: 0.3em;
        overflow-y: auto;
        overflow-x: hidden;
        max-width: 100% !important;
    }

    /* Application code */

    .input-wrapper {
        display: inline-block;
        position: relative;
        margin: 1em;
        width: 15.5em;
    }

    .input-wrapper:before {
        font-family: 'FontAwesome';
        content: '\f002';
        position: absolute;
        left: 13px;
        top: 6px;
        color: #B0A3B2
    }

    .input-wrapper input {
        padding: 0.5em;
        border-radius: 1em;
        background-color: #F1F5F9;
        width: 100%;
        border: none;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        margin: 0.5em 1em;
    }

    .hamburger {
        color: #F18764;
    }

    .card {
        display: flex;
    }

    .card-details {
        width: 100%;
    }

    .filters {
        display: flex;
        margin: 1em;
    }

    .slider {
        display: flex;
    }

    .lateral-filter {
        display: flex;
    }

    .card-details--bottom,
    .card-details--top {
        display: flex;
        justify-content: space-between;
    }

    .picture-sliders {
        display: flex;
        overflow: scroll;
    }

    .picture-sliders--image {
        height: 8em;
        width: 14.5em;
        object-fit: cover;
        border-radius: 1em;
        padding: 0 0.5em;
    }

    .lateral-menu {
        margin-bottom: auto;
        writing-mode: vertical-lr;
        transform: rotate(-180deg);
        color: #38002E;
    }

    .lateral-menu i {
        transform: rotate(90deg);

    }

    .lateral-menu--list {
        margin: 0;
    }

    .lateral-menu--list li {
        margin-top: 1em;
        margin-left: 1em;
    }

    .lateral-menu--list li:hover {
        text-decoration: underline;
    }

    .lateral-menu--list {
        display: flex;
        list-style: none;
    }

    .center {
        text-align: center;
    }

    .filter i {
        border: 1px solid #F2F1F2;
        border-radius: 50%;
        padding: 0.4em;
        color: #38002E;
    }

    .filter a {
        text-decoration: none;
        color: #38002E;
    }

    .filters i:hover {
        color: white;
        background-color: #FE929A;
    }

    .cards-slider {
        display: flex;
    }

    .cards-slider--image {
        margin-top: auto;
        margin-bottom: auto;
        height: 4em;
        width: 4em;
        border-radius: 1em;
        object-fit: cover;
        margin-right: 0.5em;
        margin-left: 0.2em;
    }

    .card-details--top h4 {
        color: #38002E;
    }

    .card-details--top i {
        margin-top: 0.4em;
    }

    .red {
        color: #F84353;
    }

    .credit {
        margin-top: 5em;
    }

    .credit a {
        text-decoration: none;
    }

    .credit a:hover {
        text-decoration: underline;
    }

    .price {
        font-weight: 700;
        color: #E79274;
    }

    .stars {
        margin: 0.3em 0;
    }

    .stars span {
        margin-left: 0.5em;
        color: #896E84;
    }

    .stars i {
        color: #FD949B;
    }

    .shop {
        color: #D0C9CD;
    }

    .shop--bakery-name {
        font-size: 0.8em;
        margin-left: 0.2em;
    }

    .cards .card+.card {
        margin-top: 1em;
    }

    .card {
        background-color: white;
        border-radius: 1em;
        padding-top: 0.3em;
        padding-right: 0.5em;
    }
    .item{
        font-size: 20px;
        margin-top: 10px;
        cursor: pointer;
    }
}
</style>
@endsection

@section('js')

    @livewireScripts
    <script type="text/javascript">
   
    </script>
@endsection