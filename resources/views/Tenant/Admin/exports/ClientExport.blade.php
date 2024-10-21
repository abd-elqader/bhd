<table>
    <thead>
        <tr>
            <th>@lang('dashboard.orderNo')</th>
            <th style="text-align:center;">@lang('dashboard.phone')</th>
            <th style="text-align:center;">@lang('dashboard.netTotal')</th>
            <th style="text-align:center;">@lang('dashboard.paymentMethod')</th>
            <th style="text-align:center;">@lang('dashboard.time')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders[0] as  $order)
            <tr>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order->client['phone'] }}</td>
                <td>{{ $order['net_total'] }} BHD</td>
                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                <td>{{ $order['created_at'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
