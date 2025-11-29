

<form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        {{-- 🔵 ستون راست --}}
        <div class="col-12 col-lg-8">
            
            {{-- کارت ۱: اطلاعات پایه --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-label-primary text-primary fw-bold">
                    <i class="bx bx-file me-1"></i> اطلاعات پایه کلاس
                </div>
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">عنوان کلاس <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-dumbbell"></i></span>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="مثال: آموزش یوگا پیشرفته" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">لینک یکتا (Slug) <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                <input type="text" name="slug" class="form-control text-start" dir="ltr" value="{{ old('slug') }}" placeholder="yoga-advanced" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">مربی کلاس <span class="text-danger">*</span></label>
                            <select name="coach_id" class="form-select">
                                <option value="">انتخاب مربی...</option>
                                @if(isset($coaches) && count($coaches) > 0)
                                    @foreach($coaches as $coach)
                                        <option value="{{ $coach->id }}" {{ old('coach_id') == $coach->id ? 'selected' : '' }}>
                                            {{ $coach->name ?? $coach->full_name ?? $coach->title ?? ($coach->first_name . ' ' . $coach->last_name) ?? 'مربی #' . $coach->id }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>⚠️ هیچ مربی یافت نشد</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">دسته‌بندی</label>
                            <select name="category_id" class="form-select">
                                <option value="">بدون دسته‌بندی</option>
                                @if(isset($categories) && count($categories) > 0)
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->title ?? $cat->name ?? $cat->caption ?? 'دسته #' . $cat->id }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>⚠️ دسته‌بندی موجود نیست</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">توضیحات کامل</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="درباره این کلاس توضیح دهید...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- کارت ۲: زمان‌بندی --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-label-info text-info fw-bold">
                    <i class="bx bx-calendar me-1"></i> برنامه زمانی
                </div>
                <div class="card-body mt-3">
                    
                    <label class="form-label d-block mb-2">روزهای برگزاری (چند مورد انتخاب کنید)</label>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @php 
                            $daysMap = ['Saturday'=>'شنبه', 'Sunday'=>'یکشنبه', 'Monday'=>'دوشنبه', 'Tuesday'=>'سه‌شنبه', 'Wednesday'=>'چهارشنبه', 'Thursday'=>'پنج‌شنبه', 'Friday'=>'جمعه']; 
                        @endphp
                        @foreach($daysMap as $en => $fa)
                            <input type="checkbox" class="btn-check" id="create_day_{{ $en }}" name="days[]" value="{{ $en }}" {{ in_array($en, old('days', [])) ? 'checked' : '' }}>
                            {{-- 🟩 استفاده از کلاس اختصاصی rounded-pill-force --}}
                            <label class="btn btn-outline-primary rounded-pill-force" for="create_day_{{ $en }}">
                                {{ $fa }}
                            </label>
                        @endforeach
                    </div>

                   <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ساعت شروع</label>
                            <input type="text" name="start_time" class="form-control time-input-styled" dir="ltr" placeholder="انتخاب کنید..." value="{{ old('start_time') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ساعت پایان</label>
                            <input type="text" name="end_time" class="form-control time-input-styled" dir="ltr" placeholder="انتخاب کنید..." value="{{ old('end_time') }}">
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
                    <div class="image-preview-wrapper border rounded p-1 bg-light mb-3 mx-auto" style="width: 100%; max-width: 300px; aspect-ratio: 16/9; overflow: hidden; position: relative;">
                        <img id="create-img-preview" src="https://placehold.co/600x400?text=No+Image" alt="Preview" class="w-100 h-100 rounded" style="object-fit: cover; display: block;">
                    </div>
                    <label for="create_image_input" class="btn btn-primary w-100">
                        <i class="bx bx-cloud-upload me-2"></i> انتخاب تصویر
                    </label>
                    <input type="file" id="create_image_input" name="image" class="d-none" accept="image/*" onchange="previewCreateImage(event)">
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
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="0">
                            <span class="input-group-text">تومان</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ظرفیت (نفر)</label>
                        <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}" placeholder="مثال: 20">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">وضعیت انتشار</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>🟢 فعال</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>🔴 غیرفعال</option>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow">
                        <i class="bx bx-check-circle me-1"></i> ثبت نهایی کلاس
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{-- اضافه کردن JS فلت‌پیکر --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".time-input-styled", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            // ظاهر تمیز و ساده
            static: true 
        });
    });
</script>
