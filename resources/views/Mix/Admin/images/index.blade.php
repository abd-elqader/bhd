@extends('Mix.layouts.app')
@section('pagetitle', $Image_Type->title() ?? '')
@section('content')



<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.type.images.create',['type'=>"$Image_Type->id"]) }}" class="btn btn-primary" disabled>@lang('dashboard.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('images')" class="btn btn-danger" disabled>@lang('dashboard.Delete_Selected')</button>
    </div>
</div>
<table class="table"  id="DataTable">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">@lang('dashboard.image')</th>
            @if($Models->whereNotNull('title_ar')->whereNotNull('title_en')->count())
                <th style="text-align:center;">@lang('dashboard.title_ar')</th>
                <th style="text-align:center;">@lang('dashboard.title_en')</th>
            @endif
            <th style="text-align:center;">@lang('dashboard.visibility')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Models as $Model)
        <tr role="row">
            <td>{{ $loop->iteration }}</td>
            <td><img style="height: 100px" src="{{ $Model['image'] }}" alt="IMG" width="150"></td>
            @if($Models->whereNotNull('title_ar')->whereNotNull('title_en')->count())
                <td>{{ $Model->title_ar }}</td>
                <td>{{ $Model->title_en }}</td>
            @endif
            <td>
                <label data-id="{{ $Model->id }}" onclick="toggleswitch({{ $Model->id }},'images')" class="switch toggleswitch bg-dark">
                    <input id="checkbox{{ $Model->id }}" type="checkbox" {{ $Model->status ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
            </td>
            <td>
                <a href="/dashboard/type/{{ $Image_Type->id }}/images/{{ $Model->id }}"><i class="fas fa-eye"></i></a>
                <a href="/dashboard/type/{{ $Image_Type->id }}/images/{{ $Model->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="/dashboard/type/{{ $Image_Type->id }}/images/{{ $Model->id }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection



@section('js')
    <script type="text/javascript">
        $(function() {

            var table = $('#DataTable').DataTable({
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
                }
                , lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
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
            });

        });

    </script>
@endsection
