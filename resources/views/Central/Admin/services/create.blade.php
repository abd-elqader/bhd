@extends('Mix.layouts.app')
@section('pagetitle', __('dashboard.services'))
@section('title')
    اضافة خدمة
@endsection


@section('content')
    <div class="container mt-5 text-left">
        <h2 class="mb-4">إضافة خدمة جديدة</h2>
        <form id="serviceForm" method="POST" action="{{ route('admin.services.store') }} "enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="serviceTitle">عنوان الخدمة</label>
                <input name="service_title" type="text" class="form-control" id="serviceTitle"
                    placeholder="أدخل عنوان الخدمة" required>
                @error('service_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="serviceDescription">وصف الخدمة</label>
                <textarea name="service_description"class="form-control" id="serviceDescription" rows="3"
                    placeholder="أدخل وصف الخدمة" required></textarea>
                @error('service_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="servicePrice">سعر الخدمة</label>
                <div class="input-group">
                    <input name="service_price" type="number" class="form-control" id="servicePrice"
                        placeholder="أدخل سعر الخدمة" required data-decimal="2">
                    <div class="input-group-append">
                        <span class="input-group-text">BHD</span>
                    </div>
                    @error('service_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="serviceImage">صورة الخدمة</label>
                <div class="custom-file">
                    <input name="service_image" type="file" class="custom-file-input" id="serviceImage" accept="image/*"
                        required>
                    <label class="custom-file-label" for="serviceImage" data-browse="استعراض">اختر صورة</label>
                    @error('service_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <small id="imageHelp" class="form-text text-muted">يرجى تحميل ملف صورة فقط (jpg, jpeg, png, gif)</small>
            </div>
            <button type="submit" class="btn btn-primary">إضافة الخدمة</button>
        </form>
    </div>
@endSection
