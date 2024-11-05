
@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.services'))
@section('title')
    اضافة خدمة
@endsection
@section('content')
    <div class="container mt-5 text-left">
        <h2 class="mb-4">تعديل خدمة</h2>
        <form id="serviceForm" method="POST" action="{{ route('admin.services.update', $data->id) }} "enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="serviceTitle">عنوان الخدمة</label>
                <input name="title" type="text" class="form-control" id="serviceTitle"
                    placeholder="أدخل عنوان الخدمة" required value="{{ $data['title'] }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="serviceDescription">وصف الخدمة</label>
                <textarea name="description"class="form-control" id="serviceDescription" rows="3"
                    placeholder="أدخل وصف الخدمة" required> {{!! $data['description'] !!}}></textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="servicePrice">سعر الخدمة</label>
                <div class="input-group">
                    <input name="price" type="number" class="form-control" id="servicePrice"
                        placeholder="أدخل سعر الخدمة" required value="{{ $data['price'] }} data-decimal="2"">
                    <div class="input-group-append">
                        <span class="input-group-text">BHD</span>
                    </div>
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="serviceImage">صورة الخدمة</label>
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="serviceImage" accept="image/*" required " value="{{ $data['image'] }}" >
                    <label class="custom-file-label" for="serviceImage" data-browse="استعراض >"اختر صورة</label>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                            <small id="imageHelp" class="form-text text-muted">يرجى تحميل ملف صورة فقط (jpg, jpeg, png, gif)</small>
                        </div>
            <button type="submit" class="btn btn-primary">تعديل الخدمة</button>
        </form>
    </div>
@endSection