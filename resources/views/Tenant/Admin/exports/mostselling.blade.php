<table>
    <thead>
        <tr>
            <th style="text-align:center;">@lang('dashboard.product')</th>
            <th style="text-align:center;">@lang('dashboard.count')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($MostSelling as $item)
            <tr class="gradeX {{ $item['id'] }}">
                <td style="text-align:center;">{{ $item->product['title_' . app()->getlocale()] }}</td>
                <td style="text-align:center;">{{ $item['count'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
