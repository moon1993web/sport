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







             <!-- تاریخ انتشار -->
             <div class="col-md-6 col-12 mb-4">
                 <label class="form-label" for="flatpickr-date">انتخابگر تاریخ (شمسی)</label>

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
                 <textarea class="form-control" id="blog-short-desc" rows="2" name="short_description" placeholder="توضیح مختصر" > 
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
                     <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                     <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>آرشیو شده</option>
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
 <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>


@endforeach
                
                 </select>
                 @error('category_id')
                     <div class="form-text text-danger">{{ $message }}</div>
                 @enderror
             </div>
             <!-- دکمه‌ها -->
             <div class="col-12 d-flex justify-content-between">
                 <button  type="button"    class="btn btn-label-secondary">انصراف</button>
                 <button  type="submit"   class="btn btn-primary">ذخیره</button>
             </div>
         </div>
     </form>
 </div>








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