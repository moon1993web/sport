@extends('Admin.Layouts.Master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">مدیریت مربیان /</span> <span class="fw-bold">ویرایش مربی</span>
    </h4>

    <form action="{{ route('admin.coaches.update', $coach->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- 🔵 ستون راست (محتوای اصلی) --}}
            <div class="col-12 col-lg-8">

                {{-- کارت ۱: اطلاعات هویتی --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-label-primary text-primary fw-bold">
                        <i class="bx bx-id-card me-1"></i> اطلاعات هویتی
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            {{-- نام و نام خانوادگی --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">نام و نام خانوادگی <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" name="full_name" class="form-control" 
                                           value="{{ old('full_name', $coach->full_name) }}" placeholder="مثال: علی رضایی" required>
                                </div>
                            </div>

                            {{-- 🟩 اسلاگ (Slug) --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">لینک یکتا (Slug) <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-link"></i></span>
                                    <input type="text" name="slug" class="form-control text-start" dir="ltr" 
                                           value="{{ old('slug', $coach->slug) }}" required>
                                </div>
                                <div class="form-text small">برای سئو بهتر، انگلیسی وارد کنید (مثال: ali-rezaei).</div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- ایمیل --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ایمیل <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" dir="ltr"
                                           value="{{ old('email', $coach->email) }}" required>
                                </div>
                            </div>

                            {{-- موبایل --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">شماره موبایل <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" name="phone_number" class="form-control" dir="ltr"
                                           value="{{ old('phone_number', $coach->phone_number) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- کارت ۲: رزومه و تحصیلات --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-label-info text-info fw-bold">
                        <i class="bx bx-file me-1"></i> رزومه و سوابق
                    </div>
                    <div class="card-body mt-3">
                        <div class="mb-3">
                            <label class="form-label">تحصیلات</label>
                            <select name="education" class="form-select">
                                <option value="diploma" {{ old('education', $coach->education) == 'diploma' ? 'selected' : '' }}>دیپلم</option>
                                <option value="bachelor" {{ old('education', $coach->education) == 'bachelor' ? 'selected' : '' }}>کارشناسی</option>
                                <option value="master" {{ old('education', $coach->education) == 'master' ? 'selected' : '' }}>کارشناسی ارشد</option>
                                <option value="phd" {{ old('education', $coach->education) == 'phd' ? 'selected' : '' }}>دکترا</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">توضیحات کوتاه (کارت مربی)</label>
                            <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $coach->short_description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">بیوگرافی کامل</label>
                            <textarea name="bio" class="form-control" rows="4">{{ old('bio', $coach->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- کارت ۳: تخصص و شبکه اجتماعی --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-label-warning text-warning fw-bold">
                        <i class="bx bx-share-alt me-1"></i> تخصص‌ها و ارتباطات
                    </div>
                    <div class="card-body mt-3">
                        <div class="mb-3">
                            <label class="form-label">تخصص‌ها (با کاما جدا کنید)</label>
                            {{-- 🟩 تبدیل آرایه جیسون به رشته برای نمایش در اینپوت --}}
                            @php
                                $specialtiesString = is_array($coach->specialties) ? implode(',', $coach->specialties) : $coach->specialties;
                            @endphp
                            <input type="text" name="specialties" class="form-control" 
                                   value="{{ old('specialties', $specialtiesString) }}" 
                                   placeholder="بدنسازی, کراس‌فیت, تغذیه">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">اینستاگرام</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bxl-instagram"></i></span>
                                    <input type="url" name="instagram_url" class="form-control" dir="ltr"
                                           value="{{ old('instagram_url', $coach->instagram_url) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">لینکدین</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bxl-linkedin"></i></span>
                                    <input type="url" name="linkedin_url" class="form-control" dir="ltr"
                                           value="{{ old('linkedin_url', $coach->linkedin_url) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- 🟣 ستون چپ (سایدبار) --}}
            <div class="col-12 col-lg-4">
                
                {{-- کارت ۴: تصویر --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header fw-bold">
                        <i class="bx bx-image me-1"></i> تصویر پروفایل
                    </div>
                    <div class="card-body text-center">
                        {{-- کادر پیش‌نمایش --}}
                        <div class="image-preview-wrapper border rounded p-1 bg-light mb-3 mx-auto" 
                             style="width: 150px; height: 150px; overflow: hidden; position: relative; border-radius: 50% !important;">
                             
                            {{-- 🟩 لاجیک نمایش تصویر: اگر جدید انتخاب شد (JS) یا اگر قدیمی وجود دارد --}}
                            <img id="edit-img-preview" 
                                 src="{{ $coach->image ? asset('storage/' . $coach->image) : asset('assets/img/avatars/1.png') }}" 
                                 alt="Coach Preview" 
                                 class="w-100 h-100" 
                                 style="object-fit: cover; display: block;">
                        </div>

                        <label for="edit_image_input" class="btn btn-primary w-100">
                            <i class="bx bx-cloud-upload me-2"></i> تغییر تصویر
                        </label>
                        <input type="file" id="edit_image_input" name="image" class="d-none" accept="image/*" onchange="previewEditImage(event)">
                        <div class="form-text small mt-2">حداکثر حجم: 2MB</div>
                    </div>
                </div>

                {{-- کارت ۵: وضعیت و انتشار --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header fw-bold">
                        <i class="bx bx-check-shield me-1"></i> وضعیت انتشار
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">وضعیت حساب</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ old('is_active', $coach->is_active) == 1 ? 'selected' : '' }}>🟢 فعال</option>
                                <option value="0" {{ old('is_active', $coach->is_active) == 0 ? 'selected' : '' }}>🔴 غیرفعال</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ترتیب نمایش</label>
                            <input type="number" name="sort_order" class="form-control" 
                                   value="{{ old('sort_order', $coach->sort_order) }}" placeholder="0">
                        </div>

                        <hr>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning w-100 py-2 fw-bold shadow">
                                <i class="bx bx-save me-1"></i> ذخیره تغییرات
                            </button>
                            <a href="{{ route('admin.coaches.index') }}" class="btn btn-label-secondary w-100 py-2">
                                بازگشت
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

{{-- اسکریپت پیش‌نمایش عکس --}}
<script>
    function previewEditImage(event) {
        const input = event.target;
        const preview = document.getElementById('edit-img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection