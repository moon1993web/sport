 <div class="tab-pane fade" id="post-add" role="tabpanel" aria-labelledby="add-tab">

     @if ($errors->any())
         <div class="alert alert-danger">
             <strong>خطا!</strong> لطفا موارد زیر را بررسی کنید:<br><br>
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif


     <form id="blog-form" method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
         @csrf
         <div class="row g-3">



             <!-- عکس -->
             <div class="col-md-12">
                 <label class="form-label" for="image">عکس</label>
                 <input class="form-control" type="file" id="image" name="image"
                     accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
                 <div id="image-preview" class="mt-3">
                     <img id="preview-img" src="#" alt="پیش‌نمایش تصویر"
                         style="max-width: 100%; max-height: 200px; display: none;" />
                 </div>
                 @error('image')
                     <div class="text-danger mt-2">{{ $message }}</div>
                 @enderror
             </div>








             <!-- عنوان -->
             <div class="col-md-12">
                 <label class="form-label" for="blog-title">عنوان</label>
                 <input class="form-control" type="text" id="blog-title" name="title" placeholder="عنوان پست"
                     value="{{ old('title') }}" />
                 @error('title')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>



             <!-- Slug (آدرس URL) -->
             <div class="col-md-12">
                 <label class="form-label" for="blog-slug">اسلاگ (آدرس SEO)</label>
                 <input class="form-control" type="text" id="blog-slug" name="slug"
                     placeholder="این فیلد به صورت خودکار از روی عنوان ساخته می‌شود" value="{{ old('slug') }}" />
                 @error('slug')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>



             <!-- تاریخ انتشار -->
             <div class="col-md-6 col-12 mb-4" id="date-picker-wrapper" style="display: none;">
                 <label class="form-label" for="flatpickr-date">تاریخ انتشار (شمسی)</label>
                 <input class="form-control" id="flatpickr-date" name="date" placeholder="YYYY/MM/DD" type="text"
                     value="{{ old('date') }}" />
             </div>


             <!-- نویسنده -->
             <div class="col-md-6">
                 <label class="form-label" for="author">نویسنده</label>
                 <input class="form-control" type="text" id="author" name="author" placeholder="نام نویسنده"
                     value="{{ old('author') }}" />
             </div>




             <!-- توضیحات کوتاه -->
             <div class="col-md-12">
                 <label class="form-label" for="blog-short-desc">توضیحات
                     کوتاه</label>
                 <textarea class="form-control" id="blog-short-desc" rows="2" name="short_description" placeholder="توضیح مختصر"> 
                     {{ old('short_description') }}</textarea>
                 @error('short_description')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>











             <!--  ویرایشگر -->
             <div class="col-12">
                 <div class="card">
                     <h5 class="card-header">ویرایشگر </h5>
                     <div class="card-body">
                         <label class="mb-1" for="full-editor">محتوا</label>
                         <div id="full-editor">{!! old('content') !!}
                         </div>
                         <input type="hidden" name="content" id="content">
                         @error('content')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                 </div>
             </div>

             <!--  /ویرایشگر -->





















             <!-- Tagify Tags -->

             <div class="col-md-6 mb-4">
                 <label class="form-label" for="TagifyBasic">برچسب‌ها (با Enter جدا کنید)</label>
                 <input class="form-control" id="TagifyBasic" name="tags" value="{{ old('tags') }}" />
                 @error('tags')
                     <div class="form-text text-danger">{{ $message }}</div>
                 @enderror
             </div>






             <!-- وضعیت انتشار -->
             <!-- وضعیت انتشار -->
             <div class="col-md-6">
                 <label class="form-label" for="blog-status">وضعیت انتشار</label>
                 <select class="form-select" id="blog-status" name="status">
                     <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>منتشر شده</option>
                     <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>پیش‌نویس
                     </option>
                     <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>زمان‌بندی شده
                     </option>
                 </select>
             </div>
             <!-- دسته‌بندی -->
             <!-- انتخاب دسته بندی -->
             <div class="col-md-6">
                 <label for="category_id" class="form-label">دسته بندی</label>
                 <select class="form-select" id="category_id" name="category_id">
                     {{-- <option value="" selected disabled>یک دسته بندی را انتخاب کنید...</option>
                     @foreach ($categories as $category)
                         <option value="{{ $category->id }}"
                             {{ old('category_id') == $category->id ? 'selected' : '' }}>

                             @if (isset($blog) && $blog->category_id == $category->id)
                                 selected
                             @endif 
                             {{ old('category_id') == $category->id ? 'selected' : '' }}>
                             {{ $category->name }}
                         </option> --}}
                     @foreach ($categories as $category)
                         <option value="{{ $category->id }}"
                             {{ old('category_id') == $category->id ? 'selected' : '' }}>
                             {{ $category->name }}
                         </option>
                     @endforeach

                 </select>
                 @error('category_id')
                     <div class="form-text text-danger">{{ $message }}</div>
                 @enderror
             </div>


             <!-- بخش SEO (در آکاردئون) -->
             <div class="col-12">
                 <div class="accordion" id="accordionSEO">
                     <div class="accordion-item">
                         <h2 class="accordion-header" id="headingSEO">
                             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#collapseSEO" aria-expanded="false" aria-controls="collapseSEO">
                                 تنظیمات SEO (اختیاری)
                             </button>
                         </h2>
                         <div id="collapseSEO" class="accordion-collapse collapse" aria-labelledby="headingSEO"
                             data-bs-parent="#accordionSEO">
                             <div class="accordion-body">
                                 <!-- عنوان متا -->
                                 <div class="mb-3">
                                     <label class="form-label" for="meta-title">عنوان متا (Meta Title)</label>
                                     <input class="form-control" type="text" id="meta-title" name="meta_title"
                                         placeholder="عنوان صفحه در نتایج جستجو" value="{{ old('meta_title') }}" />
                                 </div>
                                 <!-- توضیحات متا -->
                                 <div class="mb-3">
                                     <label class="form-label" for="meta-description">توضیحات متا (Meta
                                         Description)</label>
                                     <textarea class="form-control" id="meta-description" rows="2" name="meta_description"
                                         placeholder="توضیحاتی که زیر عنوان در گوگل نمایش داده می‌شود">{{ old('meta_description') }}</textarea>
                                 </div>
                                 <!-- کلمات کلیدی متا -->
                                 <div>
                                     <label class="form-label" for="meta-keywords">کلمات کلیدی متا (Meta
                                         Keywords)</label>
                                     <input class="form-control" id="meta-keywords" name="meta_keywords"
                                         placeholder="کلمات کلیدی را با ویرگول (,) جدا کنید"
                                         value="{{ old('meta_keywords') }}" />
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>














             <!-- دکمه‌ها -->
             <div class="col-12 d-flex justify-content-between">
                 <button type="button" class="btn btn-label-secondary">انصراف</button>
                 <button type="submit" class="btn btn-primary">ذخیره</button>
             </div>
         </div>
     </form>
 </div>








 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const titleInput = document.querySelector('#blog-title');
         const slugInput = document.querySelector('#blog-slug');

         // تابع برای تبدیل رشته به اسلاگ
         function stringToSlug(str) {
             str = str.replace(/^\s+|\s+$/g, ''); // trim
             str = str.toLowerCase();

             // remove accents, swap ñ for n, etc
             var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
             var to = "aaaaeeeeiiiioooouuuunc------";
             for (var i = 0, l = from.length; i < l; i++) {
                 str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
             }

             str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                 .replace(/\s+/g, '-') // collapse whitespace and replace by -
                 .replace(/-+/g, '-'); // collapse dashes

             return str;
         }

         // هرگاه کاربر در فیلد عنوان تایپ کرد، اسلاگ را بساز
         if (titleInput && slugInput) {
             titleInput.addEventListener('keyup', function() {
                 slugInput.value = stringToSlug(titleInput.value);
             });
         }

         // پیش‌نمایش تصویر
         const imageInput = document.querySelector('#image');
         const previewImg = document.querySelector('#preview-img');

         if (imageInput && previewImg) {
             imageInput.addEventListener('change', function(event) {
                 if (event.target.files && event.target.files[0]) {
                     const reader = new FileReader();
                     reader.onload = function(e) {
                         previewImg.src = e.target.result;
                         previewImg.style.display = 'block';
                     }
                     reader.readAsDataURL(event.target.files[0]);
                 }
             });
         }
     });
 </script>







 <!--tags-->




 <script>
     // منتظر بمانید تا صفحه به طور کامل بارگذاری شود
     document.addEventListener('DOMContentLoaded', function() {
         try {
             // المان ورودی را با ID آن پیدا کنید
             var input = document.querySelector('#TagifyBasic');

             // اگر المان پیدا شد، Tagify را روی آن فعال کنید
             if (input) {
                 var tagify = new Tagify(input);
                 console.log('Tagify initialized from CDN successfully!');
             } else {
                 console.error('Target element #TagifyBasic not found!');
             }
         } catch (e) {
             // اگر خطایی در حین راه‌اندازی رخ داد، آن را در کنسول نمایش دهید
             console.error('Error initializing Tagify:', e);
         }
     });
 </script>






 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // 1. مقداردهی اولیه ویرایشگر Quill
         var quill = new Quill('#full-editor', {
             theme: 'snow' // یا هر تم دیگری که استفاده می‌کنید
         });

         // 2. پیدا کردن فرم و input مخفی
         var form = document.querySelector('#blog-form');
         var contentInput = document.querySelector('#content');

         // 3. افزودن یک event listener برای ارسال فرم
         form.addEventListener('submit', function(event) {
             // محتوای ویرایشگر را به صورت HTML دریافت کرده و در input مخفی قرار دهید
             contentInput.value = quill.root.innerHTML;
         });


     });
 </script>





<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.querySelector('#blog-status');
        const datePickerWrapper = document.querySelector('#date-picker-wrapper');

        // تابعی برای بررسی و نمایش/مخفی کردن تقویم
        function toggleDatePicker() {
            if (statusSelect.value === 'scheduled') {
                datePickerWrapper.style.display = 'block';
            } else {
                datePickerWrapper.style.display = 'none';
            }
        }

        // 1. در زمان بارگذاری صفحه، وضعیت اولیه را چک کن
        toggleDatePicker();

        // 2. هرگاه وضعیت تغییر کرد، دوباره چک کن
        statusSelect.addEventListener('change', toggleDatePicker);
        
        // --- بقیه کدهای جاوا اسکریپت شما بدون تغییر باقی می‌مانند ---
        const titleInput = document.querySelector('#blog-title');
        // ... الی آخر
    });
</script>