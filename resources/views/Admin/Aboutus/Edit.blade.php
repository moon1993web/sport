@extends('Admin.Layouts.Master')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">مدیریت محتوا /</span> <span class="fw-bold">درباره ما</span>
    </h4>

    {{-- نمایش پیام‌های موفقیت --}}
    @if(session('swal-success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
            <i class="bx bx-check-circle me-2 fs-4"></i>
            <div>{{ session('swal-success') }}</div>
        </div>
    @endif

    <form action="{{ route('admin.about-us.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            
            {{-- 🟢 ستون اصلی (اطلاعات متنی و سئو) --}}
            <div class="col-12 col-lg-8">
                
                {{-- کارت ۱: اطلاعات پایه --}}
                <div class="card mb-4">
                    <h5 class="card-header border-bottom">📝 اطلاعات اصلی</h5>
                    <div class="card-body mt-4">
                        
                        <!-- عنوان -->
                        <div class="mb-4">
                            <label class="form-label" for="title">عنوان صفحه <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $aboutUs->title ?? '') }}" placeholder="مثلاً: درباره شرکت ما" required />
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- توضیحات کوتاه -->
                        <div class="mb-4">
                            <label class="form-label" for="short_description">توضیحات کوتاه <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="5" placeholder="یک پاراگراف جذاب درباره کسب‌وکارتان بنویسید...">{{ old('short_description', $aboutUs->short_description ?? '') }}</textarea>
                            @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <!-- شماره تماس -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="phone_number">شماره تماس</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control text-start" dir="ltr" id="phone_number" name="phone_number" value="{{ old('phone_number', $aboutUs->phone_number ?? '') }}" placeholder="021-xxxxxxxx" />
                                </div>
                            </div>
                            <!-- ایمیل -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="email">ایمیل</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" class="form-control text-start" dir="ltr" id="email" name="email" value="{{ old('email', $aboutUs->email ?? '') }}" placeholder="info@company.com" />
                                </div>
                            </div>
                        </div>

                        <!-- آدرس -->
                        <div class="mb-3">
                            <label class="form-label" for="address">آدرس پستی</label>
                            <textarea class="form-control" id="address" name="address" rows="2" placeholder="آدرس دقیق محل کار...">{{ old('address', $aboutUs->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- کارت ۲: تنظیمات سئو --}}
                <div class="card mb-4">
                    <h5 class="card-header border-bottom">🔍 تنظیمات سئو (SEO)</h5>
                    <div class="card-body mt-4">
                        
                        <div class="row">
                            <!-- اسلاگ -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="slug">URL صفحه (Slug)</label>
                                <input type="text" class="form-control text-start" dir="ltr" id="slug" name="slug" value="{{ old('slug', $aboutUs->slug ?? '') }}" placeholder="about-us" />
                            </div>
                            
                            <!-- عنوان متا -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="meta_title">عنوان متا (Title Tag)</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $aboutUs->meta_title ?? '') }}" />
                            </div>
                        </div>

                        <!-- کلمات کلیدی -->
                        <div class="mb-3">
                            <label class="form-label" for="keywords">کلمات کلیدی (Keywords)</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-purchase-tag"></i></span>
                                <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords', $aboutUs->keywords ?? '') }}" placeholder="کلمه ۱، کلمه ۲، ..." />
                            </div>
                            <div class="form-text">کلمات را با علامت کاما (،) یا (,) جدا کنید.</div>
                        </div>

                        <!-- توضیحات متا -->
                        <div class="mb-3">
                            <label class="form-label" for="meta_description">توضیحات متا (Meta Description)</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $aboutUs->meta_description ?? '') }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- 🟣 ستون کناری (مدیا و انتشار) --}}
            <div class="col-12 col-lg-4">
                
                {{-- کارت ۳: تصویر شاخص --}}
                <div class="card mb-4">
                    <h6 class="card-header">🖼️ تصویر شاخص</h6>
                    <div class="card-body">
                        
                        <!-- پیش‌نمایش -->
                        <div class="d-flex justify-content-center align-items-center border rounded bg-light mb-3" style="min-height: 200px; overflow: hidden;">
                            @if(isset($aboutUs->image))
                                <img id="image-preview" src="{{ asset('storage/' . $aboutUs->image) }}" class="img-fluid" style="object-fit: contain; max-height: 200px;">
                            @else
                                <img id="image-preview" src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" style="display: none; object-fit: contain; max-height: 200px;">
                                <div id="image-placeholder" class="text-center text-muted">
                                    <i class="bx bx-image fs-1"></i>
                                    <div class="small mt-2">تصویر انتخاب نشده</div>
                                </div>
                            @endif
                        </div>

                        <label for="image" class="btn btn-outline-primary w-100 mb-2">
                            <i class="bx bx-upload me-1"></i> انتخاب تصویر
                        </label>
                        <input type="file" id="image" name="image" class="d-none" accept="image/*" onchange="previewImage(event)">
                        
                        <div class="text-muted small text-center">فرمت‌های مجاز: JPG, PNG (Max 2MB)</div>
                        @error('image') <div class="text-danger small text-center mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- کارت ۴: ویدیو --}}
                <div class="card mb-4">
                    <h6 class="card-header">🎥 ویدیو معرفی (آپارات)</h6>
                    <div class="card-body">
                        <label class="form-label" for="video_url">لینک ویدیو</label>
                        <input type="url" class="form-control text-start mb-3" dir="ltr" 
                               id="video_url" name="video_url" 
                               placeholder="https://www.aparat.com/v/..." 
                               value="{{ old('video_url', $aboutUs->video_url ?? '') }}" 
                               oninput="previewAparatVideo(this.value)">
                        
                        <!-- پیش‌نمایش -->
                        <div id="video-preview-box" class="ratio ratio-16x9 rounded overflow-hidden bg-dark" style="display: none;">
                            <iframe id="aparat-iframe" src="" allowFullScreen="true"></iframe>
                        </div>
                        <div id="video-placeholder" class="text-center p-4 bg-light border border-dashed rounded text-muted" style="{{ !empty($aboutUs->video_url) ? 'display:none' : '' }}">
                            <i class="bx bx-movie-play fs-1"></i>
                            <div class="small mt-2">پیش‌نمایش ویدیو</div>
                        </div>
                    </div>
                </div>

                {{-- دکمه ذخیره --}}
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            <i class="bx bx-save me-2"></i> ثبت و ذخیره تغییرات
                        </button>
                        <a href="{{ route('admin.index') }}" class="btn btn-label-secondary w-100 mt-2">
                            بازگشت به داشبورد
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>
<!-- / Content -->
@endsection


<script>
    // 🖼️ Preview Image Logic
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if(placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 🎥 Preview Aparat Logic
    function previewAparatVideo(url) {
        const previewBox = document.getElementById('video-preview-box');
        const placeholder = document.getElementById('video-placeholder');
        const iframe = document.getElementById('aparat-iframe');

        const regex = /aparat\.com\/v\/([a-zA-Z0-9]+)/;
        const match = url.match(regex);

        if (match && match[1]) {
            const videoId = match[1];
            iframe.src = `https://www.aparat.com/video/video/embed/videohash/${videoId}/vt/frame`;
            previewBox.style.display = 'block';
            if(placeholder) placeholder.style.display = 'none';
        } else {
            previewBox.style.display = 'none';
            if(placeholder) placeholder.style.display = 'block';
            iframe.src = '';
        }
    }

    // Init on Load
    document.addEventListener("DOMContentLoaded", function() {
        const currentVideoUrl = document.getElementById('video_url').value;
        if(currentVideoUrl) {
            previewAparatVideo(currentVideoUrl);
        }
    });
</script>
