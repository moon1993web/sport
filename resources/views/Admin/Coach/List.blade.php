@extends('Admin.Layouts.Master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">مدیریت محتوا /</span> <span class="fw-bold">لیست مربیان</span>
        </h4>

        {{-- نمایش پیام‌های سیستم --}}
        @if (session('swal-success'))
            <div class="alert alert-success d-flex align-items-center mb-3 shadow-sm border-0" role="alert">
                <i class="bx bx-check-circle me-2 fs-4"></i>
                {{ session('swal-success') }}
            </div>
        @endif

        {{-- نمایش خطاهای عمومی --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-3 shadow-sm border-0">
                <div class="d-flex align-items-center mb-1">
                    <i class="bx bx-error-circle me-2 fs-4"></i>
                    <span>لطفاً خطاهای فرم را بررسی کنید:</span>
                </div>
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
                                <i class="bx bx-list-ul me-2"></i> لیست مربیان
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $errors->any() ? 'active' : '' }} py-3" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-create" aria-controls="navs-create"
                                aria-selected="false">
                                <i class="bx bx-user-plus me-2"></i> افزودن مربی جدید
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
                                            <th>مربی</th>
                                            <th>تحصیلات و تخصص</th>
                                            <th>راه‌های ارتباطی</th>
                                            <th class="text-center">وضعیت / ترتیب</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($coaches as $coach)
                                            <tr>
                                                {{-- 👤 تصویر و نام --}}
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-md">
                                                                @if ($coach->image)
                                                                    <img src="{{ asset('storage/' . $coach->image) }}"
                                                                        alt="{{ $coach->full_name }}"
                                                                        class="rounded-circle object-fit-cover border">
                                                                @else
                                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                                        {{ mb_substr($coach->full_name, 0, 1) }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">{{ $coach->full_name }}</h6>
                                                            <small class="text-muted">{{ $coach->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- 🎓 تخصص‌ها --}}
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        {{-- بج تحصیلات --}}
                                                        <span class="badge bg-label-secondary w-px-100 mb-1">
                                                            <i class="bx bx-hat-school me-1"></i>
                                                            {{ ucfirst($coach->education) }}
                                                        </span>
                                                        
                                                        {{-- لیست تخصص‌ها --}}
                                                        <div class="d-flex flex-wrap gap-1" style="max-width: 250px;">
                                                            @if (!empty($coach->specialties) && is_array($coach->specialties))
                                                                @foreach ($coach->specialties as $spec)
                                                                    <span class="badge bg-label-info font-size-10">{{ $spec }}</span>
                                                                @endforeach
                                                            @else
                                                                <small class="text-muted">بدون تخصص ثبت شده</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- 📞 تماس و سوشال --}}
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="mb-1"><i class="bx bx-phone me-1 text-muted"></i> {{ $coach->phone_number }}</span>
                                                        <div class="d-flex gap-2 mt-1">
                                                            @if($coach->instagram_url)
                                                                <a href="{{ $coach->instagram_url }}" target="_blank" class="text-danger" title="اینستاگرام"><i class='bx bxl-instagram fs-4'></i></a>
                                                            @endif
                                                            @if($coach->linkedin_url)
                                                                <a href="{{ $coach->linkedin_url }}" target="_blank" class="text-primary" title="لینکدین"><i class='bx bxl-linkedin-square fs-4'></i></a>
                                                            @endif
                                                            @if(!$coach->instagram_url && !$coach->linkedin_url)
                                                                <small class="text-muted">-</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- 🟢 وضعیت --}}
                                                <td class="text-center">
                                                    @if ($coach->is_active)
                                                        <span class="badge bg-success bg-glow">فعال</span>
                                                    @else
                                                        <span class="badge bg-secondary">غیرفعال</span>
                                                    @endif
                                                    <div class="mt-2 text-muted small">
                                                        ترتیب: {{ $coach->sort_order }}
                                                    </div>
                                                </td>

                                                {{-- ⚙️ عملیات --}}
                                                <td class="text-center">
                                                    <div class="d-inline-flex gap-2">
                                                        <a href="{{ route('admin.coaches.edit', $coach->id) }}"
                                                            class="btn btn-sm btn-outline-warning" title="ویرایش">
                                                            <i class="bx bx-edit-alt"></i>
                                                        </a>

                                                        <form action="{{ route('admin.coaches.destroy', $coach->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('آیا از حذف این مربی اطمینان دارید؟');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <img src="{{ asset('assets/img/illustrations/empty-box.png') }}" 
                                                             alt="Empty" width="100" class="mb-3 opacity-50">
                                                        <p class="text-muted mb-0">هنوز مربی‌ای ثبت نشده است!</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- صفحه‌بندی --}}
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $coaches->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>

                        {{-- ➕ پنل افزودن (این فایل را در گام بعد می‌سازیم) --}}
                        <div class="tab-pane fade {{ $errors->any() ? 'show active' : '' }}" id="navs-create" role="tabpanel">
                            <div class="p-3">
                                @include('Admin.Coach.Create')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection