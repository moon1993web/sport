@extends('Admin.Layouts.Master')

@section('content')
    <!-- محتوا -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">مدیریت کلاس‌ها</h4>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="classTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="list-tab" data-bs-toggle="tab"
                                        data-bs-target="#class-list" type="button" role="tab"
                                        aria-controls="class-list" aria-selected="true">لیست کلاس‌ها</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#class-add"
                                        type="button" role="tab" aria-controls="class-add" aria-selected="false">افزودن
                                        کلاس جدید</button>
                                </li>
                            </ul>

                            <div class="tab-content mt-4" id="classTabsContent">
                                <!-- تب لیست کلاس‌ها -->
                                <div class="tab-pane fade show active" id="class-list" role="tabpanel"
                                    aria-labelledby="list-tab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان کلاس</th>
                                                <th>دسته‌بندی</th>
                                                <th>مربی</th>
                                                <th>روزهای کلاس</th>
                                                {{-- <th>زمان کلاس</th> --}} {{-- این فیلد فعلا در دیتابیس شما نیست --}}
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- شروع حلقه برای نمایش داینامیک کلاس‌ها --}}
                                            @forelse ($classes as $class)
                                                <tr>
                                                    {{-- شماره ردیف --}}
                                                    <td>{{ $loop->iteration }}</td>

                                                    {{-- عنوان کلاس --}}
                                                    <td>{{ $class->title }}</td>

                                                    {{-- نام دسته‌بندی (با استفاده از ریلیشن) --}}
                                                    {{-- استفاده از ?? برای مواقعی که دسته‌بندی حذف شده باشد --}}
                                                    <td>{{ $class->category->name ?? 'تعیین نشده' }}</td>

                                                    {{-- نام مربی (با استفاده از ریلیشن) --}}
                                                    <td>{{ $class->coach->full_name ?? 'تعیین نشده' }}</td>

                                                    {{-- روزهای کلاس (تبدیل آرایه به رشته) --}}
                                                    <td>
                                                        @if (is_array($class->days) && !empty($class->days))
                                                            {{ implode('، ', $class->days) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    {{-- <td>10:00-12:00</td> --}}

                                                    {{-- دکمه‌های عملیات --}}
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown">عملیات</button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                {{-- لینک ویرایش (بعدا ساخته می‌شود) --}}
                                                                <li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('admin.classes.edit', $class->id) }}">ویرایش</a>
                                                                       
                                                                </li>
                                                                </li>
                                                                {{-- فرم حذف --}}
                                                                <li>
                                                                    <form action="{{ route('admin.classes.destroy', $class->id) }} " method="POST" 
                                                                        onsubmit="return confirm('آیا از حذف این کلاس اطمینان دارید؟');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item text-danger">حذف</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                {{-- پیامی برای زمانی که هیچ کلاسی وجود ندارد --}}
                                                <tr>
                                                    <td colspan="6" class="text-center">هیچ کلاسی یافت نشد.</td>
                                                </tr>
                                            @endforelse
                                            {{-- پایان حلقه --}}
                                        </tbody>
                                    </table>
                                </div>

                                <!-- تب افزودن کلاس جدید -->
                                @include('Admin.Classes.Create')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
