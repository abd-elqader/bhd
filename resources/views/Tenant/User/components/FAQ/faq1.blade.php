
<style>
    .mainDiv{
        background-color: #EEE;
        position: relative;
        overflow: hidden;
    }
</style>


<div class="our_contact my-5">
    <div class="container">
        <div class="row justify-content-center py-4 mainDiv">
            <div class="row justify-content-center">
                @foreach ($faqs as $key => $item)
                    <div class="my-3">
                        <h2>{{$key+1}} . {{$item['question_' . lang()]}}</h2>
                        {!!$item['answer_' . lang()]!!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

