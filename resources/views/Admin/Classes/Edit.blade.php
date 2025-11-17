@extends('Admin.Layouts.Master')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">مدیریت کلاس‌ها /</span> ویرایش کلاس: {{ $class->title }}
            </h4>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- فرم ویرایش کلاس --}}
                            <form action="{{ route('admin.classes.update', $class->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- استفاده از متد PUT برای به‌روزرسانی --}}

                                {{-- نمایش خطاها در صورت وجود --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>خطا! لطفاً موارد زیر را بررسی کنید:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row g-3">
                                    <!-- عنوان کلاس -->
                                    <div class="col-md-6 form-group">
                                        <label for="title" class="form-label">عنوان کلاس</label>
                                        {{-- old('title', $class->title) : اول مقدار قبلی (در صورت خطا) و بعد مقدار دیتابیس را نمایش می‌دهد --}}
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $class->title) }}" placeholder="مثال: برنامه‌نویسی پایتون"
                                            required>
                                        @error('title')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- دسته‌بندی کلاس‌ها -->
                                    <div class="col-md-6">
                                        <label class="form-label" for="class-category">دسته‌بندی کلاس‌ها</label>
                                        <select class="form-select" id="class-category" name="category_id" required>
                                            <option value="" disabled>انتخاب کنید</option>
                                            @foreach ($categories as $category)
                                                {{-- بررسی می‌کند که کدام option باید selected باشد --}}
                                                <option value="{{ $category->id }}"
                                                    @if (old('category_id', $class->category_id) == $category->id) selected @endif>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- مربی -->
                                    <div class="col-md-6">
                                        <label class="form-label" for="class-coach">مربی</label>
                                        <select class="form-select" id="class-coach" name="coach_id" required>
                                            <option value="" disabled>انتخاب کنید</option>
                                            @foreach ($coaches as $coach)
                                                <option value="{{ $coach->id }}"
                                                    @if (old('coach_id', $class->coach_id) == $coach->id) selected @endif>
                                                    {{ $coach->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('coach_id')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- آپلود عکس -->
                                    <div class="col-md-6 form-group">
                                        <label for="image" class="form-label">آپلود عکس جدید (اختیاری)</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
                                        <small class="form-text text-muted">در صورت انتخاب نکردن، عکس قبلی باقی می‌ماند.</small>
                                        @error('image')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- پیش‌نمایش تصویر -->
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">عکس فعلی:</label>
                                        <div>
                                            @if ($class->image)
                                                <img src="{{ asset('Admin/assets/img/class/' . $class->image) }}" alt="{{ $class->title }}"
                                                    style="max-width: 100%; max-height: 200px;" />
                                            @else
                                                <p>عکسی برای این کلاس وجود ندارد.</p>
                                            @endif
                                        </div>
                                        <div id="image-preview" class="mt-3">
                                            <label class="form-label">پیش‌نمایش عکس جدید:</label>
                                            <img id="preview-img" src="#" alt="پیش‌نمایش تصویر"
                                                style="max-width: 100%; max-height: 200px; display: none;" />
                                        </div>
                                    </div>


                                    <!-- روزهای کلاس (چک‌باکس) -->
                                    <div class="col-md-12">
                                        <label class="form-label">روزهای کلاس</label>
                                        @php
                                            // آرایه روزها را برای استفاده در چک‌باکس‌ها آماده می‌کند
                                            // ابتدا مقادیر قبلی فرم (در صورت خطا) و سپس مقادیر دیتابیس را در نظر می‌گیرد
                                            $selectedDays = old('days', $class->days ?? []);
                                        @endphp
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach (['شنبه', 'یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'] as $day)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="days[]"
                                                        value="{{ $day }}" id="{{ $day }}"
                                                        @if (is_array($selectedDays) && in_array($day, $selectedDays)) checked @endif>
                                                    <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('days')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- زمان کلاس (فعلا در مدل شما نیست، اما برای کامل بودن آورده شده) --}}


                                    <!-- دکمه‌ها -->
                                    <div class="col-12 d-flex justify-content-between mt-4">
                                        <a href="{{ route('admin.classes.index') }}" class="btn btn-label-secondary">انصراف</a>
                                        <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 @push('scripts')
    {{-- اسکریپت برای پیش‌نمایش تصویر --}}
    {{-- <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const previewImg = document.getElementById('preview-img');
                previewImg.src = URL.createObjectURL(file);
                previewImg.style.display = 'block';
            }
        });
    </script> --}}
@endpush 