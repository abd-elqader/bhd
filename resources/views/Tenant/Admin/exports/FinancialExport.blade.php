<table>
    <thead>
        <tr>
            <th></th>
            <th>@lang('dashboard.orderNo')</th>
            <th>@lang('dashboard.client')</th>
            <th>@lang('dashboard.phone')</th>
            <th>@lang('dashboard.netTotal')</th>
            <th>@lang('dashboard.paymentMethod')</th>
            <th>@lang('dashboard.time')</th>
        </tr>
    </thead>
    <tbody>
        @php($total = 0)
        @foreach ($orders[0] as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order['id'] }}</td>
                <td>
                    {{ $order->client['name'] }}
                </td>
                <td>{{ $order->client['phone'] }}</td>
                <td>{{ $order['net_total'] }} BHD</td>
                @php($total += $order['net_total'])
                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                <td>{{ $order['created_at'] }}</td>
            </tr>
        @endforeach
         <tr>
            <td colspan="7" style="text-align: center!important;">
                @lang('dashboard.netTotal'): {{ $total }} BHD
            </td>
         </tr>
    </tbody>
</table>
