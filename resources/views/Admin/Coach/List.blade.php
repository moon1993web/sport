@extends('Admin.Layouts.master')

@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">مدیریت مربیان</h4>

        {{-- نمایش پیام‌های موفقیت یا خطا --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- تب‌ها -->
                        <ul class="nav nav-tabs" id="coachTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="list-tab" data-bs-toggle="tab"
                                    data-bs-target="#coach-list" type="button" role="tab" aria-controls="coach-list"
                                    aria-selected="true">لیست مربیان</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#coach-add"
                                    type="button" role="tab" aria-controls="coach-add"
                                    aria-selected="false">افزودن مربی جدید</button>
                            </li>
                        </ul>

                        <!-- محتوای تب‌ها -->
                        <div class="tab-content mt-4" id="coachTabsContent">
                            <!-- تب لیست مربیان -->
                            <div class="tab-pane fade show active" id="coach-list" role="tabpanel"
                                aria-labelledby="list-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عکس</th>
                                                <th>نام و نام خانوادگی</th>
                                                <th>درجه تحصیلات</th>
                                                <th>شماره تلفن</th>
                                                <th>ایمیل</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- حلقه برای نمایش داینامیک مربیان --}}
                                            @forelse ($coaches as $coach)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{-- نمایش تصویر با بررسی وجود آن --}}
                                                        @if ($coach->image && file_exists(public_path('Admin/assets/img/coach/' . $coach->image)))
                                                            <img src="{{ asset('Admin/assets/img/coach/' . $coach->image) }}"
                                                                alt="{{ $coach->full_name }}" class="rounded-circle"
                                                                width="40" height="40" />
                                                        @else
                                                            {{-- تصویر پیش‌فرض در صورت عدم وجود عکس --}}
                                                            <img src="{{ asset('Admin/assets/img/avatars/default.png') }}"
                                                                alt="بدون تصویر" class="rounded-circle" width="40"
                                                                height="40" />
                                                        @endif
                                                    </td>
                                                    <td>{{ $coach->full_name }}</td>
                                                    <td>
                                                        {{-- نمایش معادل فارسی سطح تحصیلات --}}
                                                        {{ $educationLevels[$coach->education] ?? 'تعریف نشده' }}
                                                    </td>
                                                    <td>{{ $coach->phone_number }}</td>
                                                    <td>{{ $coach->email }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                عملیات
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                {{-- لینک ویرایش که به صفحه ویرایش منتقل می‌شود --}}
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('admin.coaches.edit', $coach->id) }}">
                                                                        ویرایش
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    {{-- فرم حذف برای امنیت بیشتر --}}
                                                                    <form
                                                                        action="{{ route('admin.coaches.destroy', $coach->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item text-danger"
                                                                            onclick="return confirm('آیا از حذف این مربی اطمینان دارید؟')">
                                                                            حذف
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                {{-- پیام در صورت خالی بودن لیست --}}
                                                <tr>
                                                    <td colspan="7" class="text-center">هیچ مربی‌ای یافت نشد.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- تب افزودن مربی جدید -->
                            {{-- فایل فرم ایجاد مربی در اینجا include می‌شود --}}
                            @include('Admin.Coach.Create')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- اسکریپت برای مدیریت تب فعال پس از ارسال فرم --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // بررسی اینکه آیا باید تب لیست فعال شود یا نه
            @if (session('show_list_tab') || !$errors->any())
                // اگر session وجود داشت یا هیچ خطایی نبود، تب لیست فعال شود
                const listTab = new bootstrap.Tab(document.getElementById('list-tab'));
                listTab.show();
            @else
                // در صورت وجود خطا (معمولاً در فرم ایجاد)، تب افزودن فعال بماند
                const addTab = new bootstrap.Tab(document.getElementById('add-tab'));
                addTab.show();
            @endif
        });
    </script>
@endpush