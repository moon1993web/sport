@extends('Admin.Layouts.master') {{-- فرض بر اینکه شما یک layout اصلی دارید --}}

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">ویرایش اطلاعات مربی: {{ $coach->full_name }}</h4>

        {{-- نمایش هرگونه خطا در بالای فرم --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                {{-- فرم ویرایش --}}
                <form action="{{ route('admin.coaches.update', $coach->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- استفاده از متد PUT برای به‌روزرسانی --}}

                    <div class="row g-3">
                        <!-- تصویر فعلی و آپلود تصویر جدید -->
                        <div class="col-md-6">
                            <label for="image" class="form-label">آپلود عکس جدید (اختیاری)</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" />

                            <div class="mt-3">
                                <p>تصویر فعلی:</p>
                                @if ($coach->image && file_exists(public_path('Admin/assets/img/coach/' . $coach->image)))
                                    <img id="current-image"
                                        src="{{ asset('Admin/assets/img/coach/' . $coach->image) }}"
                                        alt="تصویر فعلی" class="rounded" style="max-width: 150px; max-height: 150px;" />
                                @else
                                    <p>تصویری وجود ندارد.</p>
                                @endif
                            </div>
                        </div>

                        <!-- پیش‌نمایش تصویر جدید -->
                        <div class="col-md-6">
                            <label class="form-label">پیش‌نمایش تصویر جدید</label>
                            <div id="image-preview" class="mt-2">
                                <img id="preview-img" src="#" alt="پیش‌نمایش تصویر جدید"
                                    style="max-width: 150px; max-height: 150px; display: none;" class="rounded" />
                            </div>
                        </div>

                        <!-- نام و نام خانوادگی -->
                        <div class="col-md-6">
                            <label class="form-label" for="coach-fullname">نام و نام خانوادگی</label>
                            <input class="form-control" type="text" id="coach-fullname" name="full_name"
                                placeholder="نام و نام خانوادگی" value="{{ old('full_name', $coach->full_name) }}" required />
                        </div>

                        <!-- درجه تحصیلات -->
                        <div class="col-md-6">
                            <label class="form-label" for="coach-education">درجه تحصیلات</label>
                            <select class="form-select" id="coach-education" name="education" required>
                                <option value="">انتخاب کنید</option>
                                @foreach ($educationLevels as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('education', $coach->education) == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- توضیحات کوتاه -->
                        <div class="col-md-12">
                            <label class="form-label" for="coach-short-desc">توضیحات کوتاه</label>
                            <textarea class="form-control" id="coach-short-desc" name="short_description" rows="3"
                                placeholder="توضیحات کوتاه درباره مربی" required>{{ old('short_description', $coach->short_description) }}</textarea>
                        </div>

                        <!-- شبکه‌های اجتماعی -->
                        <div class="col-md-6">
                            <label class="form-label" for="coach-social-linkedin">لینکدین</label>
                            <input class="form-control" type="url" name="linkedin_url" id="coach-social-linkedin"
                                placeholder="لینک پروفایل لینکدین" value="{{ old('linkedin_url', $coach->linkedin_url) }}" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="coach-social-instagram">اینستاگرام</label>
                            <input class="form-control" type="url" name="instagram_url" id="coach-social-instagram"
                                placeholder="لینک پروفایل اینستاگرام"
                                value="{{ old('instagram_url', $coach->instagram_url) }}" />
                        </div>

                        <!-- بیوگرافی -->
                        <div class="col-md-12">
                            <label class="form-label" for="coach-bio">بیوگرافی</label>
                            <textarea class="form-control" id="coach-bio" name="bio" rows="5"
                                placeholder="بیوگرافی کامل مربی">{{ old('bio', $coach->bio) }}</textarea>
                        </div>

                        <!-- شماره تلفن -->
                        <div class="col-md-6">
                            <label class="form-label" for="coach-phone">شماره تلفن</label>
                            <input class="form-control" type="tel" id="coach-phone" name="phone_number"
                                placeholder="09123456789" pattern="[0-9]{11}"
                                value="{{ old('phone_number', $coach->phone_number) }}" required />
                        </div>

                        <!-- ایمیل -->
                        <div class="col-md-6">
                            <label class="form-label" for="coach-email">ایمیل</label>
                            <input class="form-control text-end" type="email" id="coach-email" name="email"
                                placeholder="example@domain.com" value="{{ old('email', $coach->email) }}" required />
                        </div>

                        <!-- حوزه‌های تخصصی -->
                        <div class="col-md-12">
                            <label class="form-label" for="coach-specialties">حوزه‌های تخصصی (با کاما جدا کنید)</label>
                            <input class="form-control" type="text" id="coach-specialties" name="specialties"
                                placeholder="مثال: برنامه‌نویسی، طراحی UI/UX، مدیریت پروژه"
                                {{-- کد PHP آرایه تخصص‌ها را به یک رشته جدا شده با کاما تبدیل می‌کند --}}
                                value="{{ old('specialties', implode(', ', $coach->specialties ?? [])) }}" />
                        </div>

                        <!-- دکمه‌ها -->
                        <div class="col-12 d-flex justify-content-between">
                            <a href="{{ route('admin.coaches.index') }}" class="btn btn-label-secondary">بازگشت</a>
                            <button type="submit" class="btn btn-primary">به‌روزرسانی</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

