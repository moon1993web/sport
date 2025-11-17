@extends('Admin.Layouts.Master')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- از آنجایی که اولین مهارت در گروه، اطلاعات مشترک (عنوان، عکس) را دارد، از آن استفاده می‌کنیم --}}
        @php
            $firstSkill = $skillGroup->first();
        @endphp

        <h4 class="fw-bold py-3 mb-4">ویرایش گروه مهارت: <span class="text-muted fw-light">{{ $firstSkill->title }}</span></h4>

        <div class="card">
            <div class="card-body">
                {{-- فرم به روت update ارسال می‌شود و از متد PUT استفاده می‌کند --}}
                <form id="skillsEditForm" action="{{ route('admin.skills.update', $firstSkill) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- متد HTTP برای به‌روزرسانی --}}

                    <div class="row g-3">
                        <!-- بخش اطلاعات اصلی -->
                        <div class="col-12">
                            <div class="card p-3 border">
                                <h5 class="card-header pb-2 border-bottom mb-3">اطلاعات کلی</h5>
                                <div class="row">
                                    <!-- عکس -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="skill-image">تغییر عکس (اختیاری)</label>
                                        <input class="form-control" type="file" id="skill-image" name="image" accept="image/*" />
                                        <div class="mt-3">
                                            <p>عکس فعلی:</p>
                                            <img src="{{ asset($firstSkill->image) }}" alt="عکس فعلی" class="img-fluid rounded" style="max-width: 150px;">
                                        </div>
                                    </div>
                                    <!-- عنوان و توضیحات -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="skill-title">عنوان</label>
                                            {{-- مقدار فیلد با داده‌های موجود پر می‌شود --}}
                                            <input class="form-control" type="text" id="skill-title" name="title" value="{{ old('title', $firstSkill->title) }}" placeholder="مثال: مهارت‌های طراحی" required />
                                        </div>
                                        <div>
                                            <label class="form-label" for="skill-desc">توضیحات کوتاه</label>
                                            {{-- مقدار فیلد با داده‌های موجود پر می‌شود --}}
                                            <textarea class="form-control" id="skill-desc" name="short_description" rows="5" placeholder="توضیح مختصر درباره مجموعه مهارت‌ها">{{ old('short_description', $firstSkill->short_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- بخش مهارت‌ها و درصد -->
                        <div class="col-12">
                            <div class="card p-3 border">
                                <h5 class="card-header pb-2 border-bottom mb-3">لیست مهارت‌ها</h5>
                                <div id="skills-container">
                                    {{-- حلقه برای نمایش تمام مهارت‌های موجود در این گروه --}}
                                    @foreach($skillGroup as $skill)
                                    <div class="row g-3 align-items-center mb-3 skill-entry">
                                        <div class="col-md-5">
                                            <label class="form-label">نام مهارت</label>
                                            <input type="text" class="form-control" name="skill_name[]" value="{{ $skill->skill_name }}" placeholder="مثال: فتوشاپ" required />
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">سطح تسلط: <span class="skill-percentage-value fw-bold">{{ $skill->skill_level }}%</span></label>
                                            <input type="range" class="form-range" name="skill_percentage[]" min="0" max="100" value="{{ $skill->skill_level }}" oninput="updatePercentage(this)">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-label-danger w-100" onclick="removeSkill(this)">
                                                <i class="bi bi-trash"></i> حذف
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
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
                            <a href="{{ route('admin.skills.index') }}" class="btn btn-label-secondary">انصراف</a>
                            <button type="submit" class="btn btn-primary" id="submitButton">ذخیره تغییرات</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- کدهای جاوااسکریپت برای افزودن و حذف داینامیک مهارت‌ها --}}
<script>
    // الگویی از اولین مهارت برای افزودن موارد جدید
  const skillTemplate = `
        <div class="row g-3 align-items-center mb-3 skill-entry">
            <div class="col-md-5">
                <label class="form-label">نام مهارت</label>
                <input type="text" class="form-control" name="skill_name[]" placeholder="مثال: فتوشاپ" required />
            </div>
            <div class="col-md-5">
                <label class="form-label">سطح تسلط: <span class="skill-percentage-value fw-bold">75%</span></label>
                <input type="range" class="form-range" name="skill_percentage[]" min="0" max="100" value="75" oninput="updatePercentage(this)">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-label-danger w-100" onclick="removeSkill(this)">
                    <i class="bi bi-trash"></i> حذف
                </button>
            </div>
        </div>
    `;

    document.getElementById('add-skill-btn').addEventListener('click', function () {
        const container = document.getElementById('skills-container');
        // به جای کلون کردن، از تمپلیت استفاده می‌کنیم تا مقادیر قبلی کپی نشوند
        container.insertAdjacentHTML('beforeend', skillTemplate);
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
        const percentageSpan = rangeInput.closest('.skill-entry').querySelector('.skill-percentage-value');
        percentageSpan.textContent = rangeInput.value + '%';
    }
</script>
