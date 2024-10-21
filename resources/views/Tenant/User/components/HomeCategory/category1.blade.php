@if(categories()->count())
<style>

.button {
  margin: 0.4em;
  padding: 1em;
  cursor: pointer;
  background: #ececec !important;
  text-decoration: none;
  color: #666;
}


/* Pulse Shrink */
@keyframes pulse-shrink {
  to {
    transform: scale(0.9);
  }
}
.pulse-shrink {
  display: inline-block;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
}
.pulse-shrink:hover {
  animation-name: pulse-shrink;
  animation-duration: 0.3s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
  animation-direction: alternate;
}


</style>
<div class="store_department my-5">
    <div class="container">
        <div class="py-4">
            <h2 class="fw-bold text-center main_color">{{ __('messages.main_categories') }}</h2>
        </div>
        <div class="">
            <div class="row">
                @foreach (categories() as $category)
                        <div class="col-6 col-lg-3 my-1">
                            <div class="" style="border: 2px solid #dfdfdf;text-align: center;min-height: 230px;">
                                 <a style="text-decoration: none; cursor: pointer; color:var(--main-color);" class="pulse-shrink my-2" href="{{route('client.categories', $category->id)}}">
                                    <div class="store">
                                        <img src="{{ public_asset($category->image) }}" class="img-fluid" alt="CategoryImage" style="max-height: 250px;">
                                        <p class="fw-bold text-center main_color pt-2 mb-0">{{ $category->title() }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif