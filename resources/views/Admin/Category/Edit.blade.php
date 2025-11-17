@extends('Admin.Layouts.Master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ویرایش دسته‌بندی: {{ $category->name }}</h4>
            </div>
            <div class="card-body">

                {{-- نمایش خطاها در صورت وجود --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- متد HTTP برای به‌روزرسانی --}}

                    <div class="row g-3">

                        <!-- نوع دسته‌بندی (Category Type) -->
                        <div class="col-md-6 form-group">
                            <label for="category_type" class="form-label">نوع دسته‌بندی</label>
                            <select class="form-select" id="category_type" name="category_type" required>
                                <option value="" disabled>یک مورد را انتخاب کنید</option>
                                {{-- استفاده از old() برای حفظ مقدار قبلی در صورت خطا، در غیر این صورت مقدار فعلی از دیتابیس --}}
                                <option value="class"
                                    {{ old('category_type', $category->category_type) == 'class' ? 'selected' : '' }}>کلاس
                                </option>
                                <option value="blog"
                                    {{ old('category_type', $category->category_type) == 'blog' ? 'selected' : '' }}>بلاگ
                                </option>
                            </select>
                            @error('category_type')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- نام دسته‌بندی (Name) -->
                        <div class="col-md-6 form-group">
                            <label for="name" class="form-label">نام دسته‌بندی</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="مثال: برنامه‌نویسی پایتون" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- توضیحات (Description) -->
                        <div class="col-md-12 form-group">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="توضیحات دسته‌بندی">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- وضعیت (Status) -->
                        <div class="col-md-6 form-group">
                            <label for="status" class="form-label">وضعیت</label>
                            <select class="form-select" id="status" name="status" required>
                                {{-- مقدار status که boolean است (1 یا 0) با مقدار فعلی مقایسه می‌شود --}}
                                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>فعال
                                </option>
                                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                    غیرفعال</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- آپلود تصویر (Image) -->
                        <div class="col-md-6 form-group">
                            <label for="image" class="form-label">آپلود تصویر جدید (اختیاری)</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
                            @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- نمایش تصویر فعلی و پیش‌نمایش تصویر جدید -->
                        <div class="col-12 mt-3">
                            @if ($category->image)
                                <div class="mb-3">
                                    <label class="form-label d-block">تصویر فعلی:</label>
                                    <img src="{{ asset('Admin/assets/img/category/' . $category->image) }}"
                                        alt="{{ $category->name }}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif

                            {{-- این div را به صورت پیش‌فرض مخفی می‌کنیم --}}
                            <div id="image-preview" style="display: none;">
                                <label class="form-label d-block"> تصویر جدید:</label>
                                <img id="preview-img" src="#" alt="پیش‌نمایش تصویر" class="img-thumbnail"
                                    style="max-width: 100%; max-height: 200px;" />
                            </div>
                        </div>

                        <!-- دکمه‌های عملیات -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success">به‌روزرسانی</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">بازگشت</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


