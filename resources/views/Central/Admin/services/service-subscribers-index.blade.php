@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.services'))
@section('title')
    المشتركين
@endsection
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container mt-5">
        <h2 class="text-center mb-5">المشتركين </h2>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">المستخدم</th>
                    <th scope="col">رقم الموبايل</th>
                    <th scope="col">كود الموبايل</th>
                    <th scope="col">الدومين</th>
                    <th scope="col">الخدمه</th>
                    <th scope="col">السعر</th>
                    <th scope="col">التفعيل</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($data))
                    @foreach ($data as $item)
                    
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td scope="row">{{ $item->Client->name }}</td>
                            <td scope="row">{{ $item->Client->phone }}</td>
                            <td scope="row">{{ $item->Client->phone_code }}</td>
                            <td scope="row">{{ $item->Client->domain_name }}</td>
                            <td scope="row">{{ $item->Service->title }}</td>
                            <td scope="row">{{ $item->Service->price }}</td>
                            <td scope="row">{{ $item->paid ? "  مفعل" : "غير مفعل " }}</td>
                            
                            <td scope="row">
                                <form action="{{ route('admin.services.active-switch', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-plus-square"></i> switch
                                </button>
                            </form>

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