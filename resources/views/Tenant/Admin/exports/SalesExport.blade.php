<table  style="text-align:center;">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('dashboard.orderNo')</th>
            <th style="text-align:center;">@lang('dashboard.paymentMethod')</th>
            <th style="text-align:center;">@lang('dashboard.subTotal')</th>
            <th style="text-align:center;">@lang('dashboard.charge_cost')</th>
            <th style="text-align:center;">@lang('dashboard.netTotal')</th>
        </tr>
    </thead>
    <tbody>
        @php($net_total = 0)
        @php($sub_total = 0)
        @php($charge_cost = 0)
        @foreach ($orders[0] as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order->PaymentMethod['title_' . app()->getLocale()] }}</td>
                <td>{{ $order->sub_total }} {{  DefaultCurrancy()->currancy_code }}</td>
                @php($sub_total += $order['sub_total'])
                <td>{{ $order->charge_cost }}</td>
                @php($charge_cost += $order['charge_cost'])
                <td>{{ $order['net_total'] }} {{  DefaultCurrancy()->currancy_code }}</td>
                @php($net_total += $order['net_total'])
            </tr>
        @endforeach
         <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                @lang('dashboard.subTotal'): {{ $sub_total }} {{  DefaultCurrancy()->currancy_code }}
            </td>
            <td>
                @lang('dashboard.charge_cost'): {{ $charge_cost }} {{  DefaultCurrancy()->currancy_code }}
            </td>
            <td>
                @lang('dashboard.netTotal'): {{ $net_total }} {{  DefaultCurrancy()->currancy_code }}
            </td>
        </tr>
    </tbody>
</table>
