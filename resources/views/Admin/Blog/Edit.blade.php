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
                                    <!-- تاریخ انتشار -->
                                    <!-- تاریخ انتشار -->
                                    <div class="col-md-6 col-12 mb-4">
                                        <label class="form-label" for="flatpickr-date">انتخابگر تاریخ</label>
                                        <input class="form-control" id="flatpickr-date" name="date"
                                                   value="{{ old('date', $blog->date ? \Morilog\Jalali\Jalalian::fromCarbon($blog->date)->format('Y/m/d') : '') }}"
                                            placeholder="YYYY/MM/DD" type="text" />
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                            <option value="archived"
                                                {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>آرشیو
                                                شده</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

        <script>
            function validateForm() {
                // اعتبارسنجی سمت کلاینت (اختیاری)
                return true;
            }
        </script>
    @endsection







    <!--tags-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // المان ورودی تگ‌ها را پیدا می‌کنیم
            const tagifyInput = document.querySelector('#TagifyBasic');

            // اگر المان پیدا شد، Tagify را روی آن فعال می‌کنیم
            if (tagifyInput) {
                // Tagify به طور خودکار مقدار موجود در ویژگی 'value' را می‌خواند
                // و آن را بر اساس کاما (delimiter پیش‌فرض) به تگ‌های جداگانه تبدیل می‌کند.
                new Tagify(tagifyInput);
                console.log('Tagify با موفقیت روی مقادیر اولیه اجرا شد.');
            } else {
                console.error('المان #TagifyBasic برای Tagify یافت نشد!');
            }
        });
    </script>
