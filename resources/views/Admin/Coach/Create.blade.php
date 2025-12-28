<form action="{{ route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        {{-- 🔵 ستون راست (اطلاعات اصلی) --}}
        <div class="col-12 col-lg-8">

            {{-- کارت ۱: اطلاعات هویتی --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-label-primary text-primary fw-bold">
                    <i class="bx bx-user-pin me-1"></i> اطلاعات فردی مربی
                </div>
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">نام و نام خانوادگی <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" name="full_name" class="form-control" placeholder="مثال: محمد محمدی" value="{{ old('full_name') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">لینک یکتا (Slug) <small class="text-muted">(اختیاری)</small></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                <input type="text" name="slug" class="form-control" dir="ltr" placeholder="mohammad-mohammadi" value="{{ old('slug') }}">
                            </div>
                            <div class="form-text font-size-12">اگر خالی بماند، خودکار ساخته می‌شود.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">شماره تماس <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                <input type="text" name="phone_number" class="form-control" dir="ltr" placeholder="0912xxxxxxx" value="{{ old('phone_number') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ایمیل <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="email" name="email" class="form-control" dir="ltr" placeholder="info@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- کارت ۲: رزومه و سوابق --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-label-info text-info fw-bold">
                    <i class="bx bx-file me-1"></i> سوابق و تحصیلات
                </div>
                <div class="card-body mt-3">
                    <div class="mb-3">
                        <label class="form-label">سطح تحصیلات <span class="text-danger">*</span></label>
                        <select name="education" class="form-select" required>
                            <option value="" disabled selected>انتخاب کنید...</option>
                            <option value="diploma" {{ old('education') == 'diploma' ? 'selected' : '' }}>دیپلم</option>
                            <option value="bachelor" {{ old('education') == 'bachelor' ? 'selected' : '' }}>کارشناسی</option>
                            <option value="master" {{ old('education') == 'master' ? 'selected' : '' }}>کارشناسی ارشد</option>
                            <option value="phd" {{ old('education') == 'phd' ? 'selected' : '' }}>دکترا</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">توضیحات کوتاه (برای کارت مربی) <span class="text-danger">*</span></label>
                        <textarea name="short_description" class="form-control" rows="2" maxlength="255" required placeholder="خلاصه ای از مهارت‌ها...">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">بیوگرافی کامل</label>
                        <textarea name="bio" class="form-control" rows="4" placeholder="داستان زندگی حرفه‌ای مربی...">{{ old('bio') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- کارت ۳: تخصص و شبکه اجتماعی --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-label-warning text-warning fw-bold">
                    <i class="bx bx-share-alt me-1"></i> تخصص‌ها و سوشال
                </div>
                <div class="card-body mt-3">
                    <div class="mb-3">
                        <label class="form-label">تخصص‌ها</label>
                        <input type="text" name="specialties" class="form-control" placeholder="مثال: بدنسازی, کراس‌فیت, تغذیه (با ویرگول جدا کنید)" value="{{ old('specialties') }}">
                        <div class="form-text text-muted">کلمات را با علامت کاما (,) جدا کنید.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">اینستاگرام</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bxl-instagram"></i></span>
                                <input type="url" name="instagram_url" class="form-control" dir="ltr" placeholder="https://instagram.com/..." value="{{ old('instagram_url') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">لینکدین</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bxl-linkedin"></i></span>
                                <input type="url" name="linkedin_url" class="form-control" dir="ltr" placeholder="https://linkedin.com/in/..." value="{{ old('linkedin_url') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🟣 ستون چپ (سایدبار) --}}
        <div class="col-12 col-lg-4">
            
            {{-- کارت ۴: تصویر --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header fw-bold">
                    <i class="bx bx-image me-1"></i> تصویر پروفایل
                </div>
                <div class="card-body text-center">
                    {{-- دایره پیش‌نمایش --}}
                    <div class="image-preview-wrapper border rounded-circle p-1 bg-light mb-3 mx-auto shadow-sm" 
                         style="width: 150px; height: 150px; overflow: hidden; position: relative;">
                        <img id="create-img-preview" src="{{ asset('assets/img/avatars/1.png') }}" alt="Preview" 
                             class="w-100 h-100 rounded-circle" style="object-fit: cover; display: block;">
                    </div>

                    <label for="create_image_input" class="btn btn-primary w-100">
                        <i class="bx bx-cloud-upload me-2"></i> انتخاب تصویر
                    </label>
                    <input type="file" id="create_image_input" name="image" class="d-none" accept="image/*" onchange="previewCreateImage(event)" required>
                    <div class="form-text small mt-2">فرمت: JPG, PNG | حداکثر: 2MB</div>
                </div>
            </div>

            {{-- کارت ۵: تنظیمات --}}
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header fw-bold">
                    <i class="bx bx-slider-alt me-1"></i> تنظیمات نمایش
                </div>
                <div class="card-body">
                    <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                        <label class="form-check-label" for="isActive">مربی فعال باشد</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ترتیب نمایش</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow">
                        <i class="bx bx-check-circle me-1"></i> ثبت مربی جدید
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- اسکریپت جاوااسکریپت برای پیش‌نمایش عکس --}}
<script>
    function previewCreateImage(event) {
        const input = event.target;
        const preview = document.getElementById('create-img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>