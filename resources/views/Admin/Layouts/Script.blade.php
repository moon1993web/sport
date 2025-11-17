<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('Admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<script src="{{ asset('Admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/datatables-bs5/i18n/fa.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/bootstrap-select/i18n/defaults-fa_IR.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/select2/i18n/fa.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('Admin/assets/js/main.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('Admin/assets/js/dashboards-analytics.js') }}"></script>

<!--content-->
<script src="{{ asset('Admin/assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/quill/quill.js') }}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://unpkg.com/quill-image-resize@3.0.9/dist/quill.imageResize.min.js"></script>

{{-- <script src="{{ asset('Admin/assets/js/forms-editors.js') }}"></script> --}}
{{-- <script src="{{ asset('Admin/assets/js/quill-config.js') }}"></script> --}}


<!--category-->

<script src="{{ asset('Admin/assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/@form-validation/popular.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/jdate/jdate.min.js') }}"></script>


<!-- ... کدهای دیگر ... -->
<script src="{{ asset('Admin/assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/jdate/jdate.min.js') }}"></script>

<!-- این خطوط را از کامنت خارج کنید -->
<script src="{{ asset('Admin/assets/vendor/libs/flatpickr/flatpickr.js') }}" ></script>
<script src="{{ asset('Admin/assets/vendor/libs/flatpickr/l10n/fa.js') }}"></script>

<!-- ... کدهای دیگر ... -->















<script src="{{ asset('Admin/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('Admin/assets/vendor/libs/pickr/pickr.js') }}"></script>
<script  src="{{ asset('Admin/assets/js/forms-pickers-jalali.js') }}"></script> 
{{-- <script src="{{ asset('Admin/assets/js/form-wizard-numbered.js') }}"></script> --}}
{{-- <script src="{{ asset('Admin/assets/js/form-wizard-validation.js') }}"></script> --}}












<!--tags-->
<!-- ۴. افزودن فایل JS کتابخانه Tagify (الزامی - قبل از بسته شدن تگ بادی) -->
<script src="{{ asset('Admin/assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>




<!--  createاسکریپت پیش‌نمایش تصویر -->
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImg = document.getElementById('preview-img');
        const previewContainer = document.getElementById('image-preview');

        if (file) {
            // بررسی اینکه فایل یک تصویر است
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp',
                'image/tiff'
            ];
            if (!validImageTypes.includes(file.type)) {
                alert('لطفاً یک فایل تصویر معتبر انتخاب کنید (jpeg, png, jpg, gif, webp, tiff).');
                event.target.value = ''; // پاک کردن ورودی
                previewImg.style.display = 'none';
                return;
            }

            // نمایش پیش‌نمایش
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            // مخفی کردن پیش‌نمایش در صورت عدم انتخاب فایل
            previewImg.style.display = 'none';
            previewImg.src = '#';
        }
    });
</script>










{{-- در فایل Edit.blade.php، داخل @push('scripts') --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        // به جای خود تصویر، کانتینر والد آن را پیدا می‌کنیم
        const previewContainer = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    // کل کانتینر پیش‌نمایش را نمایش می‌دهیم
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>









<!-- اسکریپت پیش‌نمایش تصویر -->
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImg = document.getElementById('preview-img');
        const previewContainer = document.getElementById('image-preview');

        if (file) {
            // بررسی اینکه فایل یک تصویر است
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp',
                'image/tiff'
            ];
            if (!validImageTypes.includes(file.type)) {
                alert('لطفاً یک فایل تصویر معتبر انتخاب کنید (jpeg, png, jpg, gif, webp, tiff).');
                event.target.value = ''; // پاک کردن ورودی
                previewImg.style.display = 'none';
                return;
            }

            // نمایش پیش‌نمایش
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            // مخفی کردن پیش‌نمایش در صورت عدم انتخاب فایل
            previewImg.style.display = 'none';
            previewImg.src = '#';
        }
    });
</script>




{{-- skills --}}
 
 {{-- <script>
    let skillsData = JSON.parse(localStorage.getItem('skillsData')) || null;

    // نمایش اطلاعات مهارت‌ها
    function renderSkills() {
        const displayContainer = document.getElementById('skills-display');
        if (!skillsData) {
            displayContainer.innerHTML = '<p>هنوز اطلاعاتی ثبت نشده است. لطفاً مهارت‌ها را ویرایش کنید.</p>';
            document.getElementById('create-edit-tab').click();
            return;
        }

        const skillsList = `
            <div class="card">
                <div class="card-body">
                    <img src="${skillsData.image}" alt="${skillsData.title}" style="width: 100px; height: 100px; object-fit: cover;" class="mb-3">
                    <h5>${skillsData.title}</h5>
                    <p>${skillsData.description}</p>
                    <div>
                        ${skillsData.skills.map(skill => `
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2">${skill.name}</span>
                                <div class="progress w-50" style="height: 8px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: ${skill.percentage}%;" aria-valuenow="${skill.percentage}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="ms-2">${skill.percentage}%</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        `;
        displayContainer.innerHTML = skillsList;
    }

    // ذخیره اطلاعات در localStorage
    function saveSkills() {
        localStorage.setItem('skillsData', JSON.stringify(skillsData));
    }

    // پیش‌نمایش عکس
    document.getElementById('skill-image').addEventListener('change', function () {
        const file = this.files[0];
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = '';
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // ذخیره یا به‌روزرسانی مهارت‌ها
    document.getElementById('skillsForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const skillImage = document.getElementById('skill-image').files[0];
        const skillTitle = document.getElementById('skill-title').value;
        const skillDesc = document.getElementById('skill-desc').value;

        // جمع‌آوری مهارت‌ها
        const skills = [];
        for (let i = 1; i <= 5; i++) {
            const skillName = document.getElementById(`skill-name-${i}`).value;
            const skillPercentage = document.getElementById(`skill-percentage-${i}`).value ? parseInt(document.getElementById(`skill-percentage-${i}`).value) : null;

            if (i === 1 && (!skillName || !skillPercentage || skillPercentage < 0 || skillPercentage > 100)) {
                alert('لطفاً نام مهارت 1 و درصد معتبر (بین 0 تا 100) وارد کنید.');
                return;
            }
            if (skillName && skillPercentage !== null && skillPercentage >= 0 && skillPercentage <= 100) {
                skills.push({ name: skillName, percentage: skillPercentage });
            }
        }

        if (!skillImage && !skillsData) {
            alert('لطفاً یک عکس انتخاب کنید.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const imageData = skillImage ? e.target.result : skillsData.image;
            skillsData = {
                image: imageData,
                title: skillTitle,
                description: skillDesc,
                skills: skills
            };

            saveSkills();
            renderSkills();
            resetForm();
            document.getElementById('view-tab').click();
        };

        if (skillImage) {
            reader.readAsDataURL(skillImage);
        } else if (skillsData) {
            reader.onload({ target: { result: skillsData.image } });
        }
    });

    // ریست کردن فرم
    function resetForm() {
        document.getElementById('skillsForm').reset();
        document.getElementById('imagePreview').innerHTML = '';
    }

    // بارگذاری اولیه
    if (skillsData) {
        resetForm();
    }
    renderSkills();
</script>  --}}







{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addSkillBtn = document.getElementById('add-skill-btn');
        const skillsContainer = document.getElementById('skills-container');

        addSkillBtn.addEventListener('click', function () {
            const skillTemplate = skillsContainer.querySelector('.skill-entry');
            const newSkillEntry = skillTemplate.cloneNode(true);

            newSkillEntry.querySelector('input[name="skill_name"]').value = '';
            const newRangeInput = newSkillEntry.querySelector('input[name="skill_percentage"]');
            newRangeInput.value = 50;
            newSkillEntry.querySelector('.skill-percentage-value').textContent = '50%';
            
            skillsContainer.appendChild(newSkillEntry);
            updateRemoveButtons();
        });

        updateRemoveButtons();
    });

    function removeSkill(button) {
        button.closest('.skill-entry').remove();
        updateRemoveButtons();
    }

    function updatePercentage(slider) {
        const percentageValueSpan = slider.previousElementSibling.querySelector('.skill-percentage-value');
        if (percentageValueSpan) {
            percentageValueSpan.textContent = slider.value + '%';
        }
    }

    function updateRemoveButtons() {
        const allSkillEntries = document.querySelectorAll('#skills-container .skill-entry');
        allSkillEntries.forEach((entry, index) => {
            const removeBtn = entry.querySelector('button');
            if (allSkillEntries.length <= 1) {
                removeBtn.disabled = true;
            } else {
                removeBtn.disabled = false;
            }
        });
    }

    // پیش‌نمایش عکس
    const skillImageInput = document.getElementById('skill-image');
    const imagePreview = document.getElementById('imagePreview');
    
    skillImageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        } else {
             imagePreview.innerHTML = '';
        }
    });
</script>  --}}