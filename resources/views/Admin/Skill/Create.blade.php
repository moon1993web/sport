{{-- فرم به روت store ارسال می‌شود و از متد POST استفاده می‌کند --}}
{{-- enctype="multipart/form-data" برای ارسال فایل (عکس) ضروری است --}}
<form id="skillsForm" action="{{ route('admin.skills.store') }}" method="POST" enctype="multipart/form-data">
    @csrf {{-- توکن امنیتی لاراول --}}

    <div class="row g-3">
        <!-- بخش اطلاعات اصلی -->
        <div class="col-12">
            <div class="card p-3">
                <h5 class="card-header pb-2 border-bottom mb-3">اطلاعات کلی</h5>
                <div class="row">
                    <!-- عکس -->
                    {{-- <div class="col-md-6 mb-3">
                        <label class="form-label" for="skill-image">عکس (اجباری)</label> --}}
                        {{-- name="image" اضافه شد --}}
                        {{-- <input class="form-control" type="file" id="skill-image" name="image" accept="image/*" required />
                        <div id="imagePreview" class="mt-2"></div>
                    </div> --}}



  <div class="col-mb-3 form-group">
                   <label for="image" class="form-label">آپلود عکس</label>
                   <input type="file" class="form-control" id="image" name="image"
                       accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
               </div>

               <div id="image-preview" class="mt-2">
                   <img id="preview-img" src="#" alt="پیش‌نمایش تصویر"
                       style="max-width: 100%; max-height: 200px; display: none;" />
               </div>
               @error('image')
                   <div class="text-danger mt-2">{{ $message }}</div>
               @enderror


                    <!-- عنوان و توضیحات -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="skill-title">عنوان</label>
                            {{-- name="title" اضافه شد --}}
                            <input class="form-control" type="text" id="skill-title" name="title" placeholder="مثال: مهارت‌های طراحی" required />
                        </div>
                        <div>
                            <label class="form-label" for="skill-desc">توضیحات کوتاه</label>
                            {{-- name="short_description" اضافه شد --}}
                            <textarea class="form-control" id="skill-desc" name="short_description" rows="5" placeholder="توضیح مختصر درباره مجموعه مهارت‌ها"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بخش مهارت‌ها و درصد -->
        <div class="col-12">
            <div class="card p-3">
                <h5 class="card-header pb-2 border-bottom mb-3">لیست مهارت‌ها</h5>
                <div id="skills-container">
                    <!-- مهارت اولیه به عنوان الگو -->
                    <div class="row g-3 align-items-center mb-3 skill-entry">
                        <div class="col-md-5">
                            <label class="form-label">نام مهارت</label>
                            {{-- نام به صورت آرایه تعریف شد: skill_name[] --}}
                            <input type="text" class="form-control" name="skill_name[]" placeholder="مثال: فتوشاپ" required />
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">سطح تسلط: <span class="skill-percentage-value fw-bold">75%</span></label>
                            {{-- نام به صورت آرایه تعریف شد: skill_percentage[] --}}
                            <input type="range" class="form-range" name="skill_percentage[]" min="0" max="100" value="75" oninput="updatePercentage(this)">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-label-danger w-100" onclick="removeSkill(this)">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </div>
                    </div>
                </div>
                <!-- دکمه افزودن مهارت جدید -->
                <div class="col-12 mt-3">
                    <button type="button" class="btn btn-label-success" id="add-skill-btn">
                        <i class="bi bi-plus-circle"></i> افزودن مهارت جدید
                    </button>
                </div>
            </div>
        </div>

        <!-- دکمه‌های اصلی فرم -->
        <div class="col-12 d-flex justify-content-end gap-3 pt-3">
            <button type="reset" class="btn btn-label-secondary">انصراف</button>
            <button type="submit" class="btn btn-primary" id="submitButton">ذخیره تغییرات</button>
        </div>
    </div>
</form>

{{-- کدهای جاوااسکریپت برای افزودن و حذف داینامیک مهارت‌ها --}}
<script>
    document.getElementById('add-skill-btn').addEventListener('click', function () {
        const container = document.getElementById('skills-container');
        const newSkillEntry = container.children[0].cloneNode(true);
        // ریست کردن مقادیر فیلدهای جدید
        newSkillEntry.querySelector('input[type="text"]').value = '';
        newSkillEntry.querySelector('input[type="range"]').value = '75';
        newSkillEntry.querySelector('.skill-percentage-value').textContent = '75%';
        container.appendChild(newSkillEntry);
    });

    function removeSkill(button) {
        const skillEntry = button.closest('.skill-entry');
        // اطمینان از اینکه حداقل یک مهارت باقی می‌ماند
        if (document.querySelectorAll('.skill-entry').length > 1) {
            skillEntry.remove();
        } else {
            alert('حداقل یک مهارت باید وجود داشته باشد.');
        }
    }

    function updatePercentage(rangeInput) {
        const percentageSpan = rangeInput.previousElementSibling.querySelector('.skill-percentage-value');
        percentageSpan.textContent = rangeInput.value + '%';
    }
</script>