@extends('Admin.Layouts.Master')

@section('content')
    <!-- Content -->
    <div class="container mt-5">
        <h2 class="mb-4">مدیریت دسته‌بندی‌ها</h2>

        {{-- نمایش پیام‌های موفقیت آمیز (مثلاً بعد از افزودن یا حذف) --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- نمایش خطاها --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                {{-- اگر از یک عملیات موفق برمی‌گردیم، تب لیست فعال باشد --}}
                <button class="nav-link @if (!$errors->any()) active @endif" id="list-tab" data-bs-toggle="tab"
                    data-bs-target="#list" type="button" role="tab" aria-controls="list"
                    aria-selected="{{ !$errors->any() ? 'true' : 'false' }}">
                    لیست دسته‌بندی‌ها
                </button>
            </li>
            <li class="nav-item" role="presentation">
                {{-- در حالت عادی یا در صورت وجود خطا، تب افزودن فعال باشد --}}
                <button class="nav-link @if ($errors->any()) active @endif" id="add-tab" data-bs-toggle="tab"
                    data-bs-target="#add" type="button" role="tab" aria-controls="add"
                    aria-selected="{{ $errors->any() ? 'true' : 'false' }}">
                    افزودن دسته‌بندی
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- تب افزودن دسته‌بندی -->
            <div class="tab-pane fade @if ($errors->any()) show active @endif" id="add" role="tabpanel"
                aria-labelledby="add-tab">
                @include('Admin.Category.Create')
            </div>

            <!-- تب لیست دسته‌بندی‌ها -->
            <div class="tab-pane fade @if (!$errors->any()) show active @endif" id="list" role="tabpanel"
                aria-labelledby="list-tab">
                <h4 class="mt-4">لیست دسته‌بندی‌ها</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نوع</th>
                                <th>نام</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody id="category-list">
                            {{-- شروع حلقه برای نمایش داینامیک دسته‌بندی‌ها --}}
                            @forelse ($Categories as $key => $category)
                                <tr>
                                    {{-- شماره ردیف --}}
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- نمایش نوع دسته‌بندی به فارسی --}}
                                    <td>
                                        @if ($category->category_type == 'blog')
                                            <span>بلاگ</span>
                                        @elseif ($category->category_type == 'class')
                                            <span>کلاس</span>
                                        @endif
                                    </td>

                                    {{-- نام دسته‌بندی --}}
                                    <td>{{ $category->name }}</td>

                                    {{-- وضعیت فعال یا غیرفعال --}}
                                    <td>
                                        @if ($category->status)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیرفعال</span>
                                        @endif
                                    </td>

                                    {{-- دکمه‌های عملیات (ویرایش و حذف) --}}
                                    <td class="d-flex">
                                        {{-- لینک به صفحه ویرایش --}}
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-primary">ویرایش</a>

                                        {{-- فرم برای ارسال درخواست حذف --}}
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('آیا از حذف این دسته‌بندی اطمینان دارید؟ این عمل غیرقابل بازگشت است.')">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                {{-- پیامی برای زمانی که هیچ دسته‌بندی وجود ندارد --}}
                                <tr>
                                    <td colspan="5" class="text-center">هیچ دسته‌بندی یافت نشد.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
