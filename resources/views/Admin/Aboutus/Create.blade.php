@extends('Admin.Layouts.Master')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">صفحه /</span> مدیریت درباره ما
    </h4>

    {{-- نمایش پیام موفقیت --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="app-about-us-edit">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about-us.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- بخش اطلاعات اصلی --}}
                    <div class="border p-3 rounded mb-4">
                        <h5 class="mb-4">اطلاعات اصلی</h5>

                        <!-- عنوان (Title) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-title">عنوان</label>
                            <input type="text" id="about-title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان صفحه را وارد کنید" value="{{ old('title', $aboutUs->title ?? '') }}" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- توضیحات کوتاه (Short Description) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-short-description">توضیحات کوتاه</label>
                            <textarea id="about-short-description" name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="4" placeholder="یک توضیح مختصر و جذاب بنویسید">{{ old('short_description', $aboutUs->short_description ?? '') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- تصاویر (Images - Gallery) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-images">تصاویر گالری</label>
                            <input type="file" id="about-images" name="images[]" class="form-control @error('images.*') is-invalid @enderror" multiple accept="image/*">
                            <small class="text-muted">می‌توانید چندین تصویر را همزمان انتخاب کنید. فرمت‌های مجاز: jpeg, png, jpg, gif, webp. حداکثر حجم هر فایل: ۲ مگابایت.</small>
                            @error('images.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- نمایش و حذف تصاویر موجود -->
                        @if(!empty($aboutUs->images))
                        <div class="mb-3">
                            <label class="form-label">تصاویر فعلی:</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($aboutUs->images as $imagePath)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="تصویر" class="img-fluid rounded" style="width: 120px; height: 120px; object-fit: cover;">
                                    <div class="form-check position-absolute top-0 start-0 m-1 bg-white rounded p-1">
                                        <input class="form-check-input" type="checkbox" name="deleted_images[]" value="{{ $imagePath }}" id="delete_img_{{ $loop->index }}">
                                        <label class="form-check-label small" for="delete_img_{{ $loop->index }}">حذف</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- آدرس ویدیو از آپارات (Video URL) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-video-url">آدرس ویدیو (از آپارات)</label>
                            <input type="url" id="about-video-url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" placeholder="https://www.aparat.com/v/xxxxx" value="{{ old('video_url', $aboutUs->video_url ?? '') }}" />
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- بخش اطلاعات تماس --}}
                    <div class="border p-3 rounded mb-4">
                        <h5 class="mb-4">اطلاعات تماس</h5>

                        <!-- آدرس (Address) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-address">آدرس</label>
                            <textarea id="about-address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $aboutUs->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- شماره تماس (Phone Number) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="about-phone">شماره تماس</label>
                                <input type="tel" id="about-phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $aboutUs->phone_number ?? '') }}" />
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ایمیل (Email) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="about-email">ایمیل</label>
                                <input type="email" id="about-email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $aboutUs->email ?? '') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- بخش سئو (SEO) --}}
                    <div class="border p-3 rounded">
                        <h5 class="mb-4">تنظیمات سئو (SEO)</h5>

                        <!-- اسلاگ (Slug) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-slug">اسلاگ (Slug)</label>
                            <input type="text" id="about-slug" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="about-us-page" value="{{ old('slug', $aboutUs->slug ?? '') }}" />
                            <small class="text-muted">برای URL صفحه استفاده می‌شود. اگر خالی بگذارید، به صورت خودکار از روی عنوان ساخته می‌شود.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- عنوان متا (Meta Title) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-meta-title">عنوان متا</label>
                            <input type="text" id="about-meta-title" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $aboutUs->meta_title ?? '') }}" />
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- توضیحات متا (Meta Description) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-meta-description">توضیحات متا</label>
                            <textarea id="about-meta-description" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2">{{ old('meta_description', $aboutUs->meta_description ?? '') }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- کلمات کلیدی (Keywords) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-keywords">کلمات کلیدی</label>
                            <input type="text" id="about-keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $aboutUs->keywords ?? '') }}" />
                            <small class="text-muted">کلمات را با کاما (,) از هم جدا کنید.</small>
                            @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- دکمه ذخیره -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection```