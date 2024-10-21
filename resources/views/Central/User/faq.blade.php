@extends('Central.User.components.layout')
@section('content')

<div class="bread py-5">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">@lang('website.home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('messages.FAQ')</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="our_contact my-5">
    <div class="container">
        <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach ($faqs as $key => $item)
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$key+1}}" aria-expanded="false" aria-controls="flush-collapse{{$key+1}}">
                <h2>{{$key+1}} . {{$item['question_' . lang()]}}</h2>
              </button>
            </h2>
            <div id="flush-collapse{{$key+1}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">{!!$item['answer_' . lang()]!!}</div>
            </div>
          </div>
        @endforeach
        </div>
    </div>
</div>

@endsection
