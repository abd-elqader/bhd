<table>
    <thead>
        <tr>
            <th>@lang('dashboard.name')</th>
            <th>@lang('dashboard.phone')</th>
            <th>@lang('dashboard.email')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as  $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
