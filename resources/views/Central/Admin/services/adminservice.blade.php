@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.services'))

@section('title')
    الخدمات
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <h2 class="text-center mb-5">خدماتنا المتميزة</h2>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">الوصف</th>
                    <th scope="col">السعر</th>
                    <th scope="col">الصورة</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td scope="row">{{ $item->title }}</td>
                            <td scope="row">{{ $item->description }}</td>
                            <td scope="row">{{ $item->price }}</td>
                            <td scope="row"><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    width="50px" height="30px" /></td>
                            <td scope="row">
                                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-plus-square"></i>
                                </a>
                                <a href="{{ route('admin.services.edit', $item->id) }}" class="btn btn-sm btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('admin.services.destroy', $item->id) }}" class="btn btn-sm btn-danger"><i
                                        class="bi bi-trash"></i>ah</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row">لا يوجد خدمات</th>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <br>
    {{ $data->links() }}
@endsection
