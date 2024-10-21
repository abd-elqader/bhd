@extends('Mix.layouts.app')
@section('pagetitle',__('messages.Products'))
@section('content')

<table class="table">
    <tbody class="text-center">
        {{ $Product->total_visits_count  }}
        <tr>
            <td>{{ __('messages.title_ar') . ':' }}</td>
            <td>{{ $Product['title_ar'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.title_en') . ':' }}</td>
            <td>{{ $Product['title_en'] }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.desc_ar') . ':' }}</td>
            <td>{!! $Product['desc_ar'] !!}</td>
        </tr>
        <tr>
            <td>{{ __('messages.desc_en') . ':' }}</td>
            <td>{!! $Product['desc_en'] !!}</td>
        </tr>
        @if ( $Product['price'] )
        <tr>
            <td>{{ __('messages.price') . ':' }}</td>
            <td>{{ $Product['price'] }} BD</td>
        </tr>
        @endif
        @if ( $Product['quantity'] )
        <tr>
            <td>{{ __('messages.Quantity') . ':' }}</td>
            <td>{{ $Product['quantity'] }}</td>
        </tr>
        @endif

        <tr>
            <td>{{ __('dashboard.deliverable') . ':' }}</td>
            <td>{{ $Product['deliverable'] ? __('messages.yes') : __('messages.no') }}</td>
        </tr>
        <tr>
            <td>{{ __('dashboard.VAT') . ':' }}</td>
            <td>{{ $Product['VAT'] }} BD</td>
        </tr>
        <tr>
            <td>{{ __('messages.display') . ':' }}</td>
            <td colspan="2">{{ $Product['status'] ? __('messages.visible') : __('messages.hidden') }}</td>
        </tr>
        <tr>
            <td>{{ __('dashboard.category') . ':' }}</td>
            <td>@foreach ($Product->Categories as $item){{ $item->Category->title() }}, @endforeach</td>
        </tr>

        @if($Product->images_count)
        <tr class="gradeX">
            <td>{{ __('messages.image') . ':' }}</td>
            <td style="text-align:center;">
                @foreach($Product->images as $key => $image)
                <img src="{{ $image['image'] }}" alt="IMG" class="img-thumbnail rounded mx-auto" style="max-width: 300px">
                <a data-id="{{ $image['id'] }}" class="deletemsg" id="deleteParent"><i class="fa fa-trash-o"></i></a>
                @endforeach
            </td>
        </tr>
        @endif
    </tbody>
</table>


@if ($Product->sizes_only_count)
<table>
    <thead>
        <th>{{ __('messages.size') . ':' }}</th>
        <th>{{ __('messages.Quantity') . ':' }}</th>
        <th>{{ __('messages.price') . ':' }}</th>
    </thead>
    <tbody>
        @foreach ($Product->SizesOnly as $item)
        <tr>
            <td>{{ $item->Size->title() }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }} BD</td>
        </tr>
        @endforeach
    </tbody>
</table>
@elseif ($Product->colors_only_count)
<table>
    <thead>
        <th>{{ __('dashboard.color') . ':' }}</th>
        <th>{{ __('messages.Quantity') . ':' }}</th>
    </thead>
    <tbody>
        @foreach ($Product->ColorsOnly as $item)
        <tr>
            <td>{{ $item->Color->title() }}</td>
            <td>{{ $item->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@elseif ($Product->sizes_and_colors_count)
<table>
    <thead>
        <th>{{ __('messages.size') . ':' }}</th>
        <th>{{ __('dashboard.color') . ':' }}</th>
        <th>{{ __('messages.Quantity') . ':' }}</th>
        <th>{{ __('messages.price') . ':' }}</th>
    </thead>
    <tbody>
        @foreach ($Product->SizesAndColors as $item)
        <tr>
            <td>{{ $item->Size->title() }}</td>
            <td>{{ $item->Color->title() }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }} BD</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else

@endif

@endsection