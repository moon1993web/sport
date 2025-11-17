   <!-- تب افزودن دسته‌بندی -->
   <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab">
       <h4>ایجاد دسته‌بندی جدید</h4>
       <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="row g-3">

               <!--category type-->
               <div class="col-md-6 form-group">
                   <label for="category_type" class="form-label">نوع دسته‌بندی</label>
              
                   <select class="form-select" id="category_type" name="category_type" required>
                       <option value="" disabled selected>یک مورد را انتخاب کنید</option>
                       {{-- از تابع old() برای حفظ مقدار پس از خطای اعتبارسنجی استفاده شده --}}
                       <option value="class" {{ old('category_type') == 'class' ? 'selected' : '' }}>کلاس</option>
                       <option value="blog" {{ old('category_type') == 'blog' ? 'selected' : '' }}>بلاگ</option>
                   </select>
               </div>
               @error('category_type')
                   <div class="text-danger mt-2">{{ $message }}</div>
               @enderror
               <!--/category type-->

               <!--NAME--->
               <div class="col-md-6 form-group">
                   <label for="name" class="form-label">نام دسته‌بندی</label>
                   <input type="text" class="form-control" id="name" name="name"
                       placeholder="مثال: برنامه‌نویسی پایتون" required>
               </div>

               <!---/NAME-->



               <!--description-->
               <div class="col-md-12 form-group">
                   <label for="category-desc" class="form-label">توضیحات</label>
                   <textarea class="form-control" id="description" name="description" rows="3" placeholder="توضیحات دسته‌بندی"></textarea>
               </div>

               <!--/description-->



               <!--status-->
               <div class="col-md-6 form-group">
                   <label for="status" class="form-label">وضعیت</label>
                   <select class="form-select" id="status" name="status" required>
                       <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>فعال</option>
                       <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غیرفعال</option>
                   </select>
               </div>
               @error('status')
                   <div class="text-danger mt-2">{{ $message }}</div>
               @enderror
               <!--/status-->

               <!--image-->
               <div class="col-md-6 form-group">
                   <label for="image" class="form-label">آپلود عکس</label>
                   <input type="file" class="form-control" id="image" name="image"
                       accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
               </div>

               <div id="image-preview" class="mt-3">
                   <img id="preview-img" src="#" alt="پیش‌نمایش تصویر"
                       style="max-width: 100%; max-height: 200px; display: none;" />
               </div>
               @error('image')
                   <div class="text-danger mt-2">{{ $message }}</div>
               @enderror

               <!--/image-->













               <div class="col-12">
                   <button type="submit" class="btn btn-primary">ذخیره</button>
                   <button type="button" class="btn btn-secondary ms-2" onclick="resetForm()">انصراف</button>
               </div>
           </div>
       </form>
   </div>





   <script>
       // به محض اینکه محتوای صفحه به طور کامل بارگذاری شد، کد اجرا می‌شود
       document.addEventListener('DOMContentLoaded', function() {
           // پیدا کردن المان ورودی فایل و المان پیش‌نمایش تصویر
           const imageInput = document.getElementById('image');
           const previewImg = document.getElementById('preview-img');

           // اضافه کردن یک event listener که به تغییرات در ورودی فایل گوش می‌دهد
           imageInput.addEventListener('change', function() {
               // دریافت اولین فایل انتخاب شده
               const file = this.files[0];

               // اگر فایلی انتخاب شده باشد
               if (file) {
                   // یک شی FileReader برای خواندن محتوای فایل ایجاد می‌کند
                   const reader = new FileReader();

                   // زمانی که فایل با موفقیت خوانده شد، این تابع اجرا می‌شود
                   reader.onload = function(e) {
                       // آدرس تصویر را به عنوان منبع (src) تگ img قرار می‌دهد
                       previewImg.src = e.target.result;
                       // تصویر را از حالت مخفی (display: none) خارج کرده و نمایش می‌دهد
                       previewImg.style.display = 'block';
                   }

                   // شروع فرآیند خواندن فایل به صورت Data URL
                   reader.readAsDataURL(file);
               } else {
                   // اگر کاربر انتخاب فایل را لغو کند، پیش‌نمایش را مخفی می‌کند
                   previewImg.src = '#';
                   previewImg.style.display = 'none';
               }
           });
       });
   </script>
