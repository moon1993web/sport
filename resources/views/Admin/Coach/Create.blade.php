   <div class="tab-pane fade" id="coach-add" role="tabpanel" aria-labelledby="add-tab">
       <form action="{{ route('admin.coaches.store') }}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="row g-3">
            


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






               <!-- نام و نام خانوادگی -->
               <div class="col-md-6">
                   <label class="form-label" for="coach-fullname">نام و نام خانوادگی</label>
                   <input class="form-control" type="text" id="coach-fullname" name="full_name"
                       placeholder="نام و نام خانوادگی" required />
               </div>


               <!-- درجه تحصیلات -->


               <!-- درجه تحصیلات -->
               <div class="col-md-6">
                   <label class="form-label" for="coach-education">درجه تحصیلات</label>
                   {{-- اضافه کردن name="education" برای ارسال داده به کنترلر --}}
                   <select class="form-select" id="coach-education" name="education" required>
                       <option value="" selected disabled>انتخاب کنید</option>
                       {{-- حلقه برای نمایش داینامیک گزینه‌ها --}}
                       @foreach ($educationLevels as $key => $value)
                           {{-- استفاده از old() برای حفظ مقدار قبلی در صورت بروز خطا --}}
                           <option value="{{ $key }}" {{ old('education') == $key ? 'selected' : '' }}>
                               {{ $value }}</option>
                       @endforeach
                   </select>
                   {{-- نمایش خطا در صورت وجود --}}
                   @error('education')
                       <div class="text-danger mt-2">{{ $message }}</div>
                   @enderror
               </div>
               <!-- توضیحات کوتاه -->
               <div class="col-md-12">
                   <label class="form-label" for="coach-short-desc">توضیحات کوتاه</label>
                   <textarea class="form-control" id="coach-short-desc" name="short_description" rows="3"
                       placeholder="توضیحات کوتاه درباره مربی" required></textarea>
               </div>
               <!-- شبکه‌های اجتماعی -->
               <div class="col-md-6">
                   <label class="form-label" for="coach-social-linkedin">لینکدین</label>
                   <input class="form-control" type="url" name="linkedin_url" id="coach-social-linkedin"
                       placeholder="لینک پروفایل لینکدین" />
               </div>
               <div class="col-md-6">
                   <label class="form-label" for="coach-social-instagram">اینستاگرام</label>
                   <input class="form-control" type="url" name="instagram_url" id="coach-social-instagram"
                       placeholder="لینک پروفایل اینستاگرام" />
               </div>
               <!-- بیوگرافی -->
               <div class="col-md-12">
                   <label class="form-label" for="coach-bio">بیوگرافی</label>
                   <textarea class="form-control" id="coach-bio" name="bio" rows="5" placeholder="بیوگرافی کامل مربی"></textarea>
               </div>
               <!-- شماره تلفن -->
               <!-- شماره تلفن -->
               <div class="col-md-6">
                   <label class="form-label" for="coach-phone">شماره تلفن</label>
                   {{-- افزودن name="phone_number" --}}
                   <input class="form-control" type="tel" id="coach-phone" name="phone_number" {{-- این ویژگی ضروری است --}}
                       placeholder="09123456789" pattern="[0-9]{11}" required value="{{ old('phone_number') }}"
                       {{-- برای حفظ مقدار در صورت خطا --}} />
                   {{-- نمایش خطای اعتبارسنجی --}}
                   @error('phone_number')
                       <div class="text-danger mt-2">{{ $message }}</div>
                   @enderror
               </div>
               <!-- ایمیل -->
               <!-- ایمیل -->
               <div class="col-md-6">
                   <label class="form-label" for="coach-email">ایمیل</label>
                   <input class="form-control text-end" type="email" id="coach-email" name="email"
                       {{-- ویژگی name برای ارسال داده ضروری است --}} placeholder="example@domain.com" required value="{{ old('email') }}"
                       {{-- برای حفظ مقدار قبلی در صورت خطا --}} />
                   {{-- نمایش خطای اعتبارسنجی مربوط به ایمیل --}}
                   @error('email')
                       <div class="text-danger mt-2">{{ $message }}</div>
                   @enderror
               </div>


               <!-- حوزه‌های تخصصی -->
               <div class="col-md-12">
                   <label class="form-label" for="coach-specialties">حوزه‌های تخصصی (با کاما جدا کنید)</label>
                   <input class="form-control" type="text" id="coach-specialties" name="specialties"
                       {{-- نام فیلد دیگر آرایه نیست --}} placeholder="مثال: برنامه‌نویسی، طراحی UI/UX، مدیریت پروژه"
                       
        
                       value="{{ old('specialties', implode(', ', $coach->specialties ?? [])) }}" />
               </div>




               <!-- دکمه‌ها -->
               <div class="col-12 d-flex justify-content-between">
                   <button type="button" class="btn btn-label-secondary" onclick="resetForm()">انصراف</button>
                   <button type="submit" class="btn btn-primary" id="submit-btn">ذخیره</button>
               </div>
           </div>
       </form>
   </div>








  













   {{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('specialties-wrapper');
    const addButton = document.getElementById('add-specialty-btn');

    // تابع برای نمایش یا پنهان کردن دکمه‌های حذف
    function toggleRemoveButtons() {
        const fields = wrapper.querySelectorAll('.d-flex');
        // اگر بیشتر از یک فیلد وجود داشت، همه دکمه‌های حذف را نشان بده
        if (fields.length > 1) {
            fields.forEach(field => {
                field.querySelector('.remove-specialty-btn').style.display = 'inline-block';
            });
        } 
        // در غیر این صورت (فقط یک فیلد باقی مانده)، دکمه حذف را مخفی کن
        else {
            const firstRemoveBtn = wrapper.querySelector('.remove-specialty-btn');
            if(firstRemoveBtn) {
                 firstRemoveBtn.style.display = 'none';
            }
        }
    }

    // رویداد کلیک برای دکمه "افزودن تخصص جدید"
    addButton.addEventListener('click', function() {
        const newField = `
            <div class="d-flex align-items-center mb-2">
                <input 
                    class="form-control" 
                    type="text" 
                    name="specialties[]" 
                    placeholder="تخصص جدید" />
                <button type="button" class="btn btn-danger ms-2 remove-specialty-btn">حذف</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', newField);
        toggleRemoveButtons(); // بررسی و نمایش/مخفی کردن دکمه‌های حذف
    });

    // رویداد کلیک برای دکمه‌های "حذف" (با استفاده از event delegation)
    wrapper.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-specialty-btn')) {
            // والد اصلی فیلد (div.d-flex) را حذف کن
            e.target.parentElement.remove();
            toggleRemoveButtons(); // بررسی و نمایش/مخفی کردن دکمه‌های حذف
        }
    });

    // در بارگذاری اولیه نیز تابع را اجرا کن تا وضعیت اولیه دکمه‌ها درست باشد
    toggleRemoveButtons();
});
</script> --}}
