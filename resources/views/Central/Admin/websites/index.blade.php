@extends('Mix.layouts.app')
@section('pagetitle', __('messages.tenants'))
@section('content')


<a href="{{ route('admin.send_mail.index') }}" style="width: 190px !important" class="btn btn-danger mx-2" r>
    <i class="fa-solid fa-paper-plane"></i> @lang('dashboard.send_mail')
</a>
<a href="{{ route('admin.reports') }}" style="width: 190px !important" class="btn btn-info mx-2" r>
    <i class="fa-solid fa-chart-simple"></i> @lang('dashboard.reports')
</a>

<form>
    <div class="row">
        <div class="form-group col-md-6">
            <label>@lang('dashboard.name')</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $_GET['name'] ?? '' }}">
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.email')</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $_GET['email'] ?? '' }}">
        </div>
        <div class="form-group col-md-6">
            <label>@lang('dashboard.phone')</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $_GET['phone'] ?? '' }}">
        </div>

        <div class="form-group col-md-6">
            <label>@lang('dashboard.valid')</label>
            <select class="form-select" name="valid" id="valid">
              <option selected value="">-----</option>
              <option value="Valid" @selected(isset($_GET['valid']) && 'Valid' == $_GET['valid'])>{{ __('dashboard.valid') }}</option>
              <option value="Expired" @selected(isset($_GET['valid']) && 'Expired' == $_GET['valid'])>{{ __('dashboard.expired') }}</option>
            </select>
        </div>
        <div class="form-group col-md-12 text-center my-4">
            <button class="btn btn-primary" id="search">@lang('dashboard.search')</button>
        </div>
    </div>
</form>

<table class="table table-bordered data-table text-center table-striped" id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Domain</th>
            <th>@lang('messages.Name')</th>
            <th>Benefit Pay / IBAN</th>
            <th>@lang('messages.phone') / @lang('messages.email')</th>
            <th>@lang('messages.expire_date')</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


@endsection



@section('js')
    <script type="text/javascript">
        $(function() {

            var table = $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {
                    sUrl: '{{ DT_Lang() }}'
                }
                , initComplete: function ( data ) {
                    $('table').each(
                      function() {
                        var titles;
                        titles = [];
                        $('thead th', this).each(function() {
                          titles.push($(this).text());
                        });
                        $('tbody tr', this).each(function() {
                          $('td', this).each(function(index) {
                            $(this).attr('data-label', titles[index]);
                          });
                        });
                    });
                },
                ajax: {
                    url: "{{ route('admin.websites.index') }}",
                    data: function(d) {
                        d.name = $('#name').val();
                        d.phone = $('#phone').val();
                        d.email = $('#email').val();
                        d.valid = $('#valid').val();
                    }
                },
                lengthMenu: [[-1,10, 25, 50], ["All",10, 25, 50]]
                , dom: 'Blfrtip'
                , buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ]
                , columns: [
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'benefit_iban',
                        name: 'benefit_iban'
                    },
                    {
                        data: 'phone_email',
                        name: 'phone_email'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
             
                    {
                        data: 'valid',
                        name: 'valid'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                   
                ]
            });
            $('#search').click(function(event) {
                event.preventDefault();
                table.draw();
            });
        });
    </script>
@endsection
