@extends('Admin.Layouts.Master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">مدیریت محتوا /</span>
            <span class="text-muted fw-light">کلاس‌های آموزشی /</span>
            <span class="fw-bold">ویرایش کلاس</span>
        </h4>

        {{-- نمایش خطاها --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-3 shadow-sm border-0">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.classes.update', $class->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- 🟩 نکته مهم: متد آپدیت باید PUT باشه --}}

            <div class="row">
                {{-- 🔵 ستون راست --}}
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
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $class->title) }}" placeholder="مثال: آموزش یوگا" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">لینک یکتا (Slug) <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-link"></i></span>
                                        <input type="text" name="slug" class="form-control text-start" dir="ltr"
                                            value="{{ old('slug', $class->slug) }}" placeholder="yoga-class" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">مربی کلاس <span class="text-danger">*</span></label>
                                    <select name="coach_id" class="form-select">
                                        <option value="">انتخاب مربی...</option>
                                        @if (isset($coaches) && count($coaches) > 0)
                                            @foreach ($coaches as $coach)
                                                <option value="{{ $coach->id }}"
                                                    {{ old('coach_id', $class->coach_id) == $coach->id ? 'selected' : '' }}>
                                                    {{ $coach->name ?? ($coach->full_name ?? ($coach->title ?? ($coach->first_name . ' ' . $coach->last_name))) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">دسته‌بندی</label>
                                    <select name="category_id" class="form-select">
                                        <option value="">بدون دسته‌بندی</option>
                                        @if (isset($categories) && count($categories) > 0)
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id', $class->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->title ?? ($cat->name ?? 'دسته #' . $cat->id) }}
                                                </option>
                                            @endforeach
                                        @endif
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
                            <i class="bx bx-calendar me-1"></i> برنامه زمانی
                        </div>
                        <div class="card-body mt-3">

                            <label class="form-label d-block mb-2">روزهای برگزاری</label>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                @php
                                    $daysMap = [
                                        'Saturday' => 'شنبه',
                                        'Sunday' => 'یکشنبه',
                                        'Monday' => 'دوشنبه',
                                        'Tuesday' => 'سه‌شنبه',
                                        'Wednesday' => 'چهارشنبه',
                                        'Thursday' => 'پنج‌شنبه',
                                        'Friday' => 'جمعه',
                                    ];
                                    // اطمینان از اینکه days آرایه است (حتی اگر null باشه)
                                    $currentDays = $class->days ?? [];
                                @endphp
                                @foreach ($daysMap as $en => $fa)
                                    <input type="checkbox" class="btn-check" id="edit_day_{{ $en }}"
                                        name="days[]" value="{{ $en }}"
                                        {{ in_array($en, old('days', $currentDays)) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary rounded-pill-force"
                                        for="edit_day_{{ $en }}">
                                        {{ $fa }}
                                    </label>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ساعت شروع</label>
                                    <input type="text" name="start_time" class="form-control time-input-styled"
                                        dir="ltr" value="{{ old('start_time', $class->start_time) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ساعت پایان</label>
                                    <input type="text" name="end_time" class="form-control time-input-styled"
                                        dir="ltr" value="{{ old('end_time', $class->end_time) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- 🟣 ستون چپ --}}
                <div class="col-12 col-lg-4">
                    {{-- کارت ۳: تصویر --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header fw-bold">
                            <i class="bx bx-image me-1"></i> تصویر کلاس
                        </div>
                        <div class="card-body text-center">
                            <div class="image-preview-wrapper border rounded p-1 bg-light mb-3 mx-auto"
                                style="width: 100%; max-width: 300px; aspect-ratio: 16/9; overflow: hidden; position: relative;">
                                @if ($class->image)
                                    <img id="edit-img-preview" src="{{ asset('storage/' . $class->image) }}"
                                        alt="Preview" class="w-100 h-100 rounded"
                                        style="object-fit: cover; display: block;">
                                @else
                                    <img id="edit-img-preview" src="https://placehold.co/600x400?text=No+Image"
                                        alt="Preview" class="w-100 h-100 rounded"
                                        style="object-fit: cover; display: block;">
                                @endif
                            </div>
                            <label for="edit_image_input" class="btn btn-primary w-100">
                                <i class="bx bx-cloud-upload me-2"></i> تغییر تصویر
                            </label>
                            <input type="file" id="edit_image_input" name="image" class="d-none" accept="image/*"
                                onchange="previewEditImage(event)">
                            <div class="form-text small mt-2">فرمت: JPG, PNG | حداکثر: 2MB</div>
                        </div>
                    </div>

                    {{-- کارت ۴: قیمت --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header fw-bold">
                            <i class="bx bx-dollar me-1"></i> شرایط ثبت‌نام
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">شهریه کلاس</label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control"
                                        value="{{ old('price', $class->price) }}" placeholder="0">
                                    <span class="input-group-text">تومان</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ظرفیت (نفر)</label>
                                <input type="number" name="capacity" class="form-control"
                                    value="{{ old('capacity', $class->capacity) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">وضعیت انتشار</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $class->status) == '1' ? 'selected' : '' }}>
                                        🟢 فعال</option>
                                    <option value="0" {{ old('status', $class->status) == '0' ? 'selected' : '' }}>
                                        🔴 غیرفعال</option>
                                </select>
                            </div>
                            <hr>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning py-2 fw-bold shadow">
                                    <i class="bx bx-save me-1"></i> بروزرسانی کلاس
                                </button>
                                <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-secondary">
                                    بازگشت به لیست
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- اسکریپت‌ها --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".time-input-styled", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                static: true
            });
        });
    </script>
@endsection