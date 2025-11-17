@extends('Admin.Layouts.Master')



@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">ویرایش پست</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST"
                                enctype="multipart/form-data" onSubmit="return validateForm()">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">




                                    <!-- عکس -->
                                    <div class="col-md-12">
                                        <label class="form-label" for="blog-image">عکس</label>
                                        <input class="form-control" type="file" id="image" name="image"
                                            accept="image/*" />
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- نمایش تصویر فعلی و پیش‌نمایش تصویر جدید -->
                                    <div class="col-12 mt-3">
                                        @if ($blog->image)
                                            <div class="mb-3">
                                                <label class="form-label d-block">تصویر فعلی:</label>
                                                <img src="{{ asset('Admin/assets/img/blog/' . $blog->image) }}"
                                                    alt="{{ $blog->name }}" class="img-thumbnail"
                                                    style="max-height: 150px;">
                                            </div>
                                        @endif

                                        {{-- این div را به صورت پیش‌فرض مخفی می‌کنیم --}}
                                        <div id="image-preview" style="display: none;">
                                            <label class="form-label d-block"> تصویر جدید:</label>
                                            <img id="preview-img" src="#" alt="پیش‌نمایش تصویر" class="img-thumbnail"
                                                style="max-width: 100%; max-height: 200px;" />
                                        </div>
                                    </div>






                                    <!-- عنوان -->
                                    <div class="col-md-12">
                                        <label class="form-label" for="blog-title">عنوان</label>
                                        <input class="form-control" type="text" id="blog-title" name="title"
                                            value="{{ old('title', $blog->title) }}" placeholder="عنوان پست" />
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Slug (آدرس URL) -->
                                    <div class="col-md-12">
                                        <label class="form-label" for="blog-slug">اسلاگ (آدرس SEO)</label>
                                        <input class="form-control" type="text" id="blog-slug" name="slug"
                                            value="{{ old('slug', $blog->slug) }}" placeholder="آدرس منحصر به فرد پست" />
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>









                                    <!-- تاریخ انتشار -->
                                    <!-- تاریخ انتشار -->
                                    <div class="col-md-6 col-12 mb-4" id="date-picker-wrapper">
                                        <label class="form-label" for="flatpickr-date">تاریخ انتشار (شمسی)</label>
                                        <input class="form-control" id="flatpickr-date" name="date"
                                            value="{{ old('date', $blog->date ? \Morilog\Jalali\Jalalian::fromCarbon($blog->date)->format('Y/m/d') : '') }}"
                                            placeholder="YYYY/MM/DD" type="text" />
                                    </div>
                                    <!-- نویسنده -->
                                    <div class="col-md-6">
                                        <label class="form-label" for="blog-author">نویسنده</label>
                                        <input class="form-control" type="text" id="blog-author" name="author"
                                            value="{{ old('author', $blog->author) }}" placeholder="نام نویسنده" />
                                        @error('author')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- توضیحات کوتاه -->
                                    <div class="col-md-12">
                                        <label class="form-label" for="blog-short-desc">توضیحات کوتاه</label>
                                        <textarea class="form-control" id="blog-short-desc" name="short_description" rows="2" placeholder="توضیح مختصر">{{ old('short_description', $blog->short_description) }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- توضیحات بلند -->
                                    <div class="col-12">
                                        <div class="card">
                                            <h5 class="card-header">محتوای پست</h5>
                                            <div class="card-body">
                                                <label class="mb-1" for="full-editor">محتوا</label>
                                                {{-- محتوای فعلی را با {!! !!} داخل ویرایشگر قرار می‌دهیم تا تگ‌های HTML اجرا شوند --}}
                                                <div id="full-editor">{!! old('content', $blog->content) !!}</div>
                                                <input type="hidden" name="content" id="content-input">
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- برچسب‌ها -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="TagifyBasic">برچسب‌ها (با Enter جدا کنید)</label>

                                        <input class="form-control" id="TagifyBasic" name="tags"
                                            value="{{ old('tags', $blog->tags ?? '') }}" />
                                        @error('tags')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- دسته‌بندی -->
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">دسته بندی</label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">یک دسته بندی را انتخاب کنید...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- وضعیت انتشار -->
                                    <div class="col-md-6">
                                        <label class="form-label" for="blog-status">وضعیت انتشار</label>
                                        <select class="form-select" id="blog-status" name="status">
                                            <option value="published"
                                                {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>منتشر
                                                شده</option>
                                            <option value="draft"
                                                {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>پیش‌نویس
                                            </option>
                                            <option value="scheduled"
                                                {{ old('status', $blog->status) == 'scheduled' ? 'selected' : '' }}>
                                                زمان‌بندی شده</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <!-- بخش SEO (در آکاردئون) -->
                                    <div class="col-12">
                                        <div class="accordion" id="accordionSEO">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSEO">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSEO"
                                                        aria-expanded="false" aria-controls="collapseSEO">
                                                        تنظیمات SEO (اختیاری)
                                                    </button>
                                                </h2>
                                                <div id="collapseSEO" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSEO" data-bs-parent="#accordionSEO">
                                                    <div class="accordion-body">
                                                        <!-- عنوان متا -->
                                                        <div class="mb-3">
                                                            <label class="form-label" for="meta-title">عنوان متا (Meta
                                                                Title)</label>
                                                            <input class="form-control" type="text" id="meta-title"
                                                                name="meta_title" placeholder="عنوان صفحه در نتایج جستجو"
                                                                value="{{ old('meta_title', $blog->meta_title) }}" />
                                                        </div>
                                                        <!-- توضیحات متا -->
                                                        <div class="mb-3">
                                                            <label class="form-label" for="meta-description">توضیحات متا
                                                                (Meta Description)</label>
                                                            <textarea class="form-control" id="meta-description" rows="2" name="meta_description"
                                                                placeholder="توضیحاتی که زیر عنوان در گوگل نمایش داده می‌شود">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                                        </div>
                                                        <!-- کلمات کلیدی متا -->
                                                        <div>
                                                            <label class="form-label" for="meta-keywords">کلمات کلیدی متا
                                                                (Meta Keywords)</label>
                                                            <input class="form-control" id="meta-keywords"
                                                                name="meta_keywords"
                                                                placeholder="کلمات کلیدی را با ویرگول (,) جدا کنید"
                                                                value="{{ old('meta_keywords', $blog->meta_keywords) }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

















                                    <!-- دکمه‌ها -->
                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="{{ route('admin.blogs.index') }}"
                                            class="btn btn-label-secondary">انصراف</a>
                                        <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection




    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                       // --- بخش کنترل نمایش تقویم ---
        const statusSelect = document.querySelector('#blog-status');
        const datePickerWrapper = document.querySelector('#date-picker-wrapper');

        function toggleDatePicker() {
            if (statusSelect.value === 'scheduled') {
                datePickerWrapper.style.display = 'block';
            } else {
                datePickerWrapper.style.display = 'none';
            }
        }
                // 1. مقداردهی اولیه Tagify
                const tagifyInput = document.querySelector('#TagifyBasic');
                if (tagifyInput) {
                    new Tagify(tagifyInput);
                }

                // 2. مقداردهی اولیه Quill Editor
                const quill = new Quill('#full-editor', {
                    theme: 'snow'
                });

                // 3. اتصال Quill به فرم
                const form = document.querySelector('form');
                const contentInput = document.querySelector('#content-input');
                if (form && contentInput) {
                    form.addEventListener('submit', function() {
                        contentInput.value = quill.root.innerHTML;
                    });
                }

                // 4. اسکریپت تولید خودکار Slug
                const titleInput = document.querySelector('#blog-title');
                const slugInput = document.querySelector('#blog-slug');
                // (این بخش را غیرفعال می‌کنیم چون در حالت ویرایش بهتر است اسلاگ ثابت بماند مگر اینکه کاربر خودش تغییر دهد)
                // if(titleInput && slugInput) {
                //     titleInput.addEventListener('keyup', function () {
                //         slugInput.value = stringToSlug(titleInput.value);
                //     });
                // }

                // 5. پیش‌نمایش تصویر جدید
                const imageInput = document.querySelector('#image');
                const imagePreviewDiv = document.querySelector('#image-preview');
                const previewImg = document.querySelector('#preview-img');

                if (imageInput && imagePreviewDiv && previewImg) {
                    imageInput.addEventListener('change', function(event) {
                        if (event.target.files && event.target.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImg.src = e.target.result;
                                imagePreviewDiv.style.display = 'block'; // نمایش بخش پیش‌نمایش
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        }
                    });
                }
            });
        </script>
