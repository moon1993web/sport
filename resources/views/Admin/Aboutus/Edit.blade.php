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

                        {{-- ... فیلدهای عنوان، توضیحات کوتاه و تصاویر بدون تغییر باقی می‌مانند ... --}}
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

<!-- START: کانتینر برای پیش‌نمایش تصاویر جدید -->
<div id="new-images-preview-container" class="d-flex flex-wrap gap-3 mt-3">
    {{-- پیش‌نمایش تصاویر جدید در اینجا با جاوااسکریپت اضافه می‌شود --}}
</div>
<!-- END: کانتینر برای پیش‌نمایش تصاویر جدید -->


<!-- نمایش و حذف تصاویر موجود -->
@if(!empty($aboutUs->images) && count($aboutUs->images) > 0)
<div class="mb-3 pt-3 border-top">
    <label class="form-label">تصاویر فعلی:</label>
    <div class="d-flex flex-wrap gap-3">
        @foreach($aboutUs->images as $imagePath)
        <div class="position-relative">
            <img src="{{ asset('storage/' . $imagePath) }}" alt="تصویر گالری" class="img-fluid rounded" style="width: 120px; height: 120px; object-fit: cover;">
            <div class="form-check position-absolute top-0 start-0 m-1 bg-white rounded p-1">
                <input class="form-check-input" type="checkbox" name="deleted_images[]" value="{{ $imagePath }}" id="delete_img_{{ $loop->index }}">
                <label class="form-check-label small" for="delete_img_{{ $loop->index }}">حذف</label>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif











                        
                        <!-- START: بخش ویدیو با قابلیت پیش‌نمایش -->
                        <!-- آدرس ویدیو از آپارات (Video URL) -->
                        <div class="mb-3">
                            <label class="form-label" for="about-video-url">آدرس ویدیو (از آپارات)</label>
                            <input type="url" id="about-video-url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" placeholder="https://www.aparat.com/v/xxxxx" value="{{ old('video_url', $aboutUs->video_url ?? '') }}" />
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- کانتینر برای نمایش پیش‌نمایش ویدیو -->
                        <div id="video-preview-container" class="mt-3">
                            {{-- پیش‌نمایش ویدیو در اینجا قرار می‌گیرد --}}
                        </div>
                        <!-- END: بخش ویدیو با قابلیت پیش‌نمایش -->
                    </div>

                    {{-- ... بخش‌های اطلاعات تماس و سئو بدون تغییر باقی می‌مانند ... --}}
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
        <label class="form-label" for="about-keywords-tagify">کلمات کلیدی</label>
        <input id="about-keywords-tagify" name="keywords" class="form-control" placeholder="کلمات کلیدی را وارد کرده و Enter بزنید" value="{{ old('keywords', $aboutUs->keywords ?? '') }}" />
        {{-- نیازی به نمایش خطا با is-invalid نیست چون Tagify ظاهر خودش را دارد --}}
        @error('keywords')
            <div class="form-text text-danger mt-1">{{ $message }}</div>
        @enderror
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
@endsection


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoUrlInput = document.getElementById('about-video-url');
        const previewContainer = document.getElementById('video-preview-container');

        // تابعی برای به‌روزرسانی پیش‌نمایش
        function updateVideoPreview(url) {
            // ابتدا کانتینر را خالی می‌کنیم
            previewContainer.innerHTML = '';

            // بررسی می‌کنیم که آیا URL معتبر است و شامل الگوی آپارات است
            if (url && url.includes('aparat.com/v/')) {
                // استخراج شناسه ویدیو از URL
                const videoId = url.split('/v/')[1].split('?')[0]; // جدا کردن پارامترهای احتمالی URL

                if (videoId) {
                    // ساخت URL مخصوص embed آپارات
                    const embedUrl = `https://www.aparat.com/video/video/embed/videohash/${videoId}/vt/frame`;

                    // ساخت iframe و افزودن آن به کانتینر پیش‌نمایش
                    const iframe = `
                        <iframe
                            src="${embedUrl}"
                            allowFullScreen="true"
                            webkitallowfullscreen="true"
                            mozallowfullscreen="true"
                            style="width: 100%; height: 360px; border: none; border-radius: 8px;">
                        </iframe>`;
                    previewContainer.innerHTML = iframe;
                }
            }
        }

        // افزودن event listener به فیلد ورودی
        videoUrlInput.addEventListener('input', function () {
            updateVideoPreview(this.value);
        });

        // اجرای تابع در زمان بارگذاری صفحه برای نمایش پیش‌نمایش ویدیوی موجود
        updateVideoPreview(videoUrlInput.value);
    });
</script> --}}









{{-- 
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ... کد موجود برای پیش‌نمایش ویدیو ...
    const videoUrlInput = document.getElementById('about-video-url');
    const previewContainer = document.getElementById('video-preview-container');
    function updateVideoPreview(url) { /* ... */ }
    videoUrlInput.addEventListener('input', function () { updateVideoPreview(this.value); });
    updateVideoPreview(videoUrlInput.value);


    // START: راه‌اندازی Tagify برای کلمات کلیدی
    try {
        // المان ورودی کلمات کلیدی را پیدا کنید
        var keywordsInput = document.querySelector('#about-keywords-tagify');

        if (keywordsInput) {
            // Tagify را روی آن فعال کنید
            var tagify = new Tagify(keywordsInput, {
                // تنظیمات دلخواه Tagify در اینجا قرار می‌گیرد
                // مثلاً: whitelist: ["کلمه۱", "کلمه۲"],
                // dropdown: { enabled: 0 }
            });
            console.log('Tagify for keywords initialized successfully!');
        } else {
            console.error('Keywords input element #about-keywords-tagify not found!');
        }
    } catch (e) {
        console.error('Error initializing Tagify for keywords:', e);
    }
    // END: راه‌اندازی Tagify
});
</script> --}}




{{-- افزودن اسکریپت‌های کتابخانه‌های خارجی در ابتدا --}}
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

{{-- اسکریپت‌های سفارشی شما (همه در یک بلوک و داخل DOMContentLoaded) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // =================================================================
    // 1. اسکریپت پیش‌نمایش ویدیو آپارات
    // =================================================================
    const videoUrlInput = document.getElementById('about-video-url');
    const videoPreviewContainer = document.getElementById('video-preview-container');

    function updateVideoPreview(url) {
        if (!videoPreviewContainer) return; // اگر کانتینر وجود نداشت، ادامه نده
        videoPreviewContainer.innerHTML = '';
        if (url && url.includes('aparat.com/v/')) {
            const videoId = url.split('/v/')[1].split('?')[0];
            if (videoId) {
                const embedUrl = `https://www.aparat.com/video/video/embed/videohash/${videoId}/vt/frame`;
                const iframe = `<iframe src="${embedUrl}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" style="width: 100%; height: 360px; border: none; border-radius: 8px;"></iframe>`;
                videoPreviewContainer.innerHTML = iframe;
            }
        }
    }

    if (videoUrlInput) {
        // اجرای تابع در زمان بارگذاری صفحه برای نمایش ویدیوی موجود
        updateVideoPreview(videoUrlInput.value);
        // افزودن event listener به فیلد ورودی
        videoUrlInput.addEventListener('input', () => updateVideoPreview(videoUrlInput.value));
    }


    // =================================================================
    // 2. راه‌اندازی Tagify برای کلمات کلیدی
    // =================================================================
    try {
        const keywordsInput = document.querySelector('#about-keywords-tagify');
        if (keywordsInput) {
            new Tagify(keywordsInput);
            console.log('Tagify initialized successfully!');
        }
    } catch (e) {
        console.error('Error initializing Tagify:', e);
    }


    // =================================================================
    // 3. اسکریپت پیش‌نمایش گالری تصاویر (چندتایی)
    // =================================================================
    const galleryInput = document.getElementById('about-images');
    const newImagesPreviewContainer = document.getElementById('new-images-preview-container');

    if (galleryInput && newImagesPreviewContainer) {
        galleryInput.addEventListener('change', function(event) {
            // هر بار که فایل‌های جدید انتخاب می‌شوند، پیش‌نمایش قبلی را پاک کن
            newImagesPreviewContainer.innerHTML = '';

            const files = event.target.files;
            
            if (files && files.length > 0) {
                // یک عنوان برای بخش پیش‌نمایش اضافه کن
                const previewTitle = document.createElement('p');
                previewTitle.className = 'w-100 fw-bold mb-0';
                previewTitle.innerText = 'پیش‌نمایش تصاویر جدید:';
                newImagesPreviewContainer.appendChild(previewTitle);

                // برای هر فایل انتخاب شده، یک پیش‌نمایش بساز
                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) { return; }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'پیش‌نمایش تصویر جدید';
                        img.className = 'img-fluid rounded';
                        img.style.cssText = 'width: 120px; height: 120px; object-fit: cover;';
                        
                        newImagesPreviewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    } else {
        console.warn('Gallery input or preview container not found. Check the IDs: #about-images, #new-images-preview-container');
    }

});
</script>




