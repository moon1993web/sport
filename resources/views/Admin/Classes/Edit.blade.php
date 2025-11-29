@extends('Admin.Layouts.Master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">مدیریت کلاس‌ها /</span> <span class="fw-bold">ویرایش کلاس</span>
    </h4>

    {{-- نمایش خطاهای احتمالی --}}
    @if($errors->any())
        <div class="alert alert-danger mb-3 shadow-sm border-0">
            <div class="d-flex align-items-center mb-1">
                <i class="bx bx-error-circle me-2 fs-4"></i>
                <span>لطفاً خطاهای زیر را بررسی کنید:</span>
            </div>
            <ul class="mb-0 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            {{-- 🔵 ستون راست: اطلاعات محتوایی و زمان‌بندی --}}
            <div class="col-12 col-lg-8">
                
                {{-- کارت ۱: اطلاعات پایه --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-label-warning text-warning fw-bold">
                        <i class="bx bx-edit me-1"></i> ویرایش اطلاعات پایه
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">عنوان کلاس <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-dumbbell"></i></span>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $class->title) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">لینک یکتا (Slug) <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-link"></i></span>
                                    <input type="text" name="slug" class="form-control text-start" dir="ltr" value="{{ old('slug', $class->slug) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- انتخاب مربی (نسخه اصلاح شده و ایمن) --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">مربی کلاس <span class="text-danger">*</span></label>
                                <select name="coach_id" class="form-select">
                                    <option value="">انتخاب مربی...</option>
                                    @foreach($coaches as $coach)
                                        {{-- 🛡️ منطق ایمن‌سازی: بررسی نوع داده --}}
                                        @php
                                            // اگر coach آبجکت بود، id را بگیر، اگر آرایه بود کلید id، وگرنه خود مقدار
                                            $cId = is_object($coach) ? $coach->id : (is_array($coach) ? $coach['id'] : $coach);
                                            
                                            // تلاش برای پیدا کردن نام
                                            $cName = 'مربی نامشخص';
                                            if(is_object($coach)) {
                                                $cName = $coach->name ?? $coach->full_name ?? ($coach->first_name . ' ' . $coach->last_name) ?? 'مربی #' . $coach->id;
                                            } elseif(is_array($coach)) {
                                                $cName = $coach['name'] ?? $coach['full_name'] ?? 'مربی #' . $cId;
                                            }
                                        @endphp

                                        <option value="{{ $cId }}" {{ old('coach_id', $class->coach_id) == $cId ? 'selected' : '' }}>
                                            {{ $cName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- انتخاب دسته‌بندی (نسخه اصلاح شده و ایمن) --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">دسته‌بندی</label>
                                <select name="category_id" class="form-select">
                                    <option value="">بدون دسته‌بندی</option>
                                    @foreach($categories as $cat)
                                        @php
                                            $catId = is_object($cat) ? $cat->id : (is_array($cat) ? $cat['id'] : $cat);
                                            $catName = is_object($cat) ? ($cat->title ?? $cat->name ?? 'دسته #' . $catId) : 'دسته #' . $catId;
                                        @endphp
                                        <option value="{{ $catId }}" {{ old('category_id', $class->category_id) == $catId ? 'selected' : '' }}>
                                            {{ $catName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">توضیحات کامل</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $class->description) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- کارت ۲: زمان‌بندی --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-label-info text-info fw-bold">
                        <i class="bx bx-calendar me-1"></i> ویرایش برنامه زمانی
                    </div>
                    <div class="card-body mt-3">
                        
                        <label class="form-label d-block mb-2">روزهای برگزاری</label>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @php 
                                $daysMap = [
                                    'Saturday' => 'شنبه', 'Sunday' => 'یکشنبه', 'Monday' => 'دوشنبه', 
                                    'Tuesday' => 'سه‌شنبه', 'Wednesday' => 'چهارشنبه', 
                                    'Thursday' => 'پنج‌شنبه', 'Friday' => 'جمعه'
                                ]; 
                                $currentDays = old('days', $class->days ?? []);
                            @endphp
                            @foreach($daysMap as $en => $fa)
                                <input type="checkbox" class="btn-check" id="edit_day_{{ $en }}" name="days[]" value="{{ $en }}" {{ in_array($en, $currentDays) ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary px-3" for="edit_day_{{ $en }}">
                                    {{ $fa }}
                                </label>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ساعت شروع</label>
                                <input type="time" name="start_time" class="form-control text-center" dir="ltr" 
                                       value="{{ old('start_time', $class->start_time ? \Carbon\Carbon::parse($class->start_time)->format('H:i') : '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ساعت پایان</label>
                                <input type="time" name="end_time" class="form-control text-center" dir="ltr" 
                                       value="{{ old('end_time', $class->end_time ? \Carbon\Carbon::parse($class->end_time)->format('H:i') : '') }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- 🟣 ستون چپ: تصویر و تنظیمات --}}
            <div class="col-12 col-lg-4">
                
                {{-- کارت ۳: تصویر --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header fw-bold">
                        <i class="bx bx-image me-1"></i> تصویر کلاس
                    </div>
                    <div class="card-body text-center">
                        <div class="image-preview-wrapper border rounded p-1 bg-light mb-3 mx-auto" style="width: 100%; max-width: 300px; aspect-ratio: 16/9; overflow: hidden;">
                                           <img id="edit-img-preview" 
                                 src="{{ $class->image ? asset('storage/' . $class->image) : 'https://placehold.co/600x400?text=No+Image' }}" 
                                 alt="Preview" 
                                 class="w-100 h-100 rounded" 
                                 style="object-fit: cover; display: block;">
                        </div>

                        <label for="edit_image_input" class="btn btn-primary w-100">
                            <i class="bx bx-cloud-upload me-2"></i> تغییر تصویر
                        </label>
                        <input type="file" id="edit_image_input" name="image" class="d-none" accept="image/*" onchange="previewEditImage(event)">
                        <div class="form-text small mt-2">اگر نمی‌خواهید تصویر تغییر کند، فایلی انتخاب نکنید.</div>
                    </div>
                </div>

                {{-- کارت ۴: قیمت و وضعیت --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-header fw-bold">
                        <i class="bx bx-dollar me-1"></i> شرایط ثبت‌نام
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">شهریه کلاس</label>
                            <div class="input-group">
                                <input type="number" name="price" class="form-control" value="{{ old('price', $class->price) }}" placeholder="0">
                                <span class="input-group-text">تومان</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ظرفیت (نفر)</label>
                            <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $class->capacity) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">وضعیت انتشار</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $class->status) == 1 ? 'selected' : '' }}>🟢 فعال</option>
                                <option value="0" {{ old('status', $class->status) == 0 ? 'selected' : '' }}>🔴 غیرفعال</option>
                            </select>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-warning w-100 py-2 fw-bold shadow">
                            <i class="bx bx-save me-1"></i> بروزرسانی اطلاعات
                        </button>
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-label-secondary w-100 mt-2">
                            بازگشت به لیست
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection


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
