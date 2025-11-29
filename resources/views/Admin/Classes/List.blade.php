@extends('Admin.Layouts.Master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">مدیریت محتوا /</span> <span class="fw-bold">کلاس‌های آموزشی</span>
        </h4>

        {{-- نمایش پیام‌های سیستم --}}
        @if (session('swal-success'))
            <div class="alert alert-success d-flex align-items-center mb-3 shadow-sm border-0" role="alert">
                <i class="bx bx-check-circle me-2 fs-4"></i>
                {{ session('swal-success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3 shadow-sm border-0">
                <div class="d-flex align-items-center mb-1">
                    <i class="bx bx-error-circle me-2 fs-4"></i>
                    <span>لطفاً خطاهای زیر را بررسی کنید:</span>
                </div>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">

                    {{-- 🟢 هدر تب‌ها --}}
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $errors->any() ? '' : 'active' }} py-3" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-list" aria-controls="navs-list"
                                aria-selected="true">
                                <i class="bx bx-list-ul me-2"></i> لیست کلاس‌ها
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $errors->any() ? 'active' : '' }} py-3" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-create" aria-controls="navs-create"
                                aria-selected="false">
                                <i class="bx bx-plus-circle me-2"></i> افزودن کلاس جدید
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content shadow-sm rounded-bottom">

                        {{-- 📋 پنل لیست --}}
                        <div class="tab-pane fade {{ $errors->any() ? '' : 'show active' }}" id="navs-list" role="tabpanel">
                            <div class="table-responsive text-nowrap" style="min-height: 300px;">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 80px;">تصویر</th>
                                            <th>عنوان و توضیحات</th>
                                            <th>مربی و زمان</th>
                                            <th>شهریه / ظرفیت</th>
                                            <th>وضعیت</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($classes as $class)
                                            <tr>
                                                {{-- 🖼️ تصویر --}}
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center bg-light rounded overflow-hidden border"
                                                        style="width: 60px; height: 60px;">
                                                        @if ($class->image)
                                                            <img src="{{ asset('storage/' . $class->image) }}"
                                                                alt="Class Img"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                        @else
                                                            <i class="bx bx-dumbbell text-secondary fs-3"></i>
                                                        @endif
                                                    </div>
                                                </td>

                                                {{-- عنوان --}}
                                                <td>
                                                    <div class="fw-bold fs-6 mb-1">{{ $class->title }}</div>
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @php
                                                            $faDays = [
                                                                'Saturday' => 'شنبه',
                                                                'Sunday' => 'یکشنبه',
                                                                'Monday' => 'دوشنبه',
                                                                'Tuesday' => 'سه‌شنبه',
                                                                'Wednesday' => 'چهارشنبه',
                                                                'Thursday' => 'پنج‌شنبه',
                                                                'Friday' => 'جمعه',
                                                            ];
                                                        @endphp
                                                        @if (!empty($class->days) && is_array($class->days))
                                                            @foreach ($class->days as $day)
                                                                <span
                                                                    class="badge bg-label-info font-size-10 px-2">{{ $faDays[$day] ?? $day }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted small">بدون برنامه زمانی</span>
                                                        @endif
                                                    </div>
                                                </td>

                                                {{-- 🟩 اصلاح شده: نمایش هوشمند نام مربی --}}
                                                <td>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <i class="bx bx-user me-1 text-primary"></i>
                                                        <span class="text-dark small">
                                                            {{ $class->coach->name ?? ($class->coach->full_name ?? ($class->coach->first_name . ' ' . $class->coach->last_name ?? '---')) }}
                                                        </span>
                                                    </div>
                                                    @if ($class->start_time && $class->end_time)
                                                        <div class="small text-muted">
                                                            <i class="bx bx-time me-1"></i>
                                                            {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                                            تا {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                                        </div>
                                                    @endif
                                                </td>

                                                {{-- قیمت --}}
                                                <td>
                                                    <div class="mb-1">
                                                        @if ($class->price)
                                                            <span
                                                                class="fw-bold text-success">{{ number_format($class->price) }}</span>
                                                            <small class="text-muted">تومان</small>
                                                        @else
                                                            <span class="badge bg-success">رایگان</span>
                                                        @endif
                                                    </div>
                                                    <div class="small text-muted">
                                                        <i class="bx bx-group me-1"></i>
                                                        {{ $class->capacity ? $class->capacity . ' نفر' : 'نامحدود' }}
                                                    </div>
                                                </td>

                                                {{-- وضعیت --}}
                                                <td>
                                                    @if ($class->status)
                                                        <span class="badge bg-label-primary">فعال</span>
                                                    @else
                                                        <span class="badge bg-label-secondary">غیرفعال</span>
                                                    @endif
                                                </td>

                                                {{-- 🟩 اصلاح شده: دکمه‌های استاندارد Outline --}}
                                                <td class="text-center">
                                                    <div class="d-inline-flex gap-2">
                                                        {{-- دکمه ویرایش --}}
                                                        <a href="{{ route('admin.classes.edit', $class->id) }}"
                                                            class="btn btn-sm btn-warning text-white" title="ویرایش">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </a>

                                                        {{-- دکمه حذف --}}
                                                        <form action="{{ route('admin.classes.destroy', $class->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('آیا از حذف این کلاس مطمئن هستید؟ این عملیات غیرقابل بازگشت است.');">
                                                            @csrf
                                                            @method('DELETE')

                                                            {{-- اصلاح: تغییر type به submit و استفاده از آیکون استاندارد --}}
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                title="حذف">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <img src="{{ asset('assets/img/illustrations/empty-box.png') }}"
                                                        alt="Empty" width="100" class="mb-3 opacity-50">
                                                    <p class="text-muted mb-0">هنوز کلاسی ثبت نشده است.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- صفحه‌بندی --}}
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $classes->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>

                        {{-- ➕ پنل افزودن --}}
                        <div class="tab-pane fade {{ $errors->any() ? 'show active' : '' }}" id="navs-create"
                            role="tabpanel">
                            <div class="p-3">
                                @include('Admin.Classes.Create')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
