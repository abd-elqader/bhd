<table>
    <thead>
        <tr>
            <th style="text-align:center;">@lang('dashboard.name')</th>
            <th style="text-align:center;">@lang('dashboard.phone')</th>
            <th style="text-align:center;">@lang('dashboard.email')</th>
            <th style="text-align:center;">@lang('dashboard.product')</th>
            <th style="text-align:center;">@lang('dashboard.count')</th>
            <th style="text-align:center;">@lang('dashboard.time')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($AbandonedCarts as $item)
            <tr class="gradeX {{ $item['id'] }}">
                <td style="text-align:center;">{{ $item['name'] ?? $item->Client?->name }}</td>
                <td style="text-align:center;">{{ $item['phone'] ?? $item->Client?->phone }}</td>
                <td style="text-align:center;">{{ $item['email'] ?? $item->Client?->email }}</td>
                <td style="text-align:center;"><p style="max-width: 200px;" href="{{ route('admin.products.edit',$item->product['id']) }}">{{ $item->product['title_'.app()->getlocale()] }}</p></td>
                <td style="text-align:center;">{{ $item['count'] }}</td>
                <td style="text-align:center;">{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
