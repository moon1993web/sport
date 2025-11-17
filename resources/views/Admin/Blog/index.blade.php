@extends('Admin.Layouts.Master')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">مدیریت پست‌ها</h4>

            {{-- نمایش پیام موفقیت‌آمیز --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- تب‌ها -->
                            <ul class="nav nav-tabs" id="postTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="list-tab" data-bs-toggle="tab"
                                        data-bs-target="#post-list" type="button" role="tab" aria-controls="post-list"
                                        aria-selected="true">لیست پست‌ها</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#post-add"
                                        type="button" role="tab" aria-controls="post-add" aria-selected="false">افزودن
                                        پست جدید</button>
                                </li>
                            </ul>

                            <!-- محتوای تب‌ها -->
                            <div class="tab-content mt-4" id="postTabsContent">
                                <!-- تب لیست پست‌ها (داینامیک شده) -->
                                <div class="tab-pane fade show active" id="post-list" role="tabpanel"
                                    aria-labelledby="list-tab">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>تصویر</th>
                                                    <th>عنوان</th>
                                                    <th>دسته‌بندی</th>
                                                    <th>وضعیت</th>
                                                    <th>تاریخ انتشار</th>
                                                    <th>عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($blogs as $blog)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ asset('Admin/assets/img/blog/' . $blog->image) }}"
                                                                alt="{{ $blog->title }}" class="img-thumbnail"
                                                                style="width: 80px; height: 50px; object-fit: cover;">
                                                        </td>
                                                        <td>{{ $blog->title }}</td>
                                                        <td>{{ $blog->category->name ?? 'بدون دسته‌بندی' }}</td>
                                                        <td>
                                                            @if ($blog->status == 'published')
                                                                <span class="badge bg-label-success">منتشر شده</span>
                                                            @elseif($blog->status == 'draft')
                                                                <span class="badge bg-label-secondary">پیش‌نویس</span>
                                                            @else
                                                                <span class="badge bg-label-warning">آرشیو شده</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $blog->date ? \Morilog\Jalali\Jalalian::fromCarbon($blog->date)->format('Y/m/d') : '---' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('admin.blogs.edit', $blog->id) }}">ویرایش</a>
                                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('آیا از حذف این بلاگ مطمئن هستید؟');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">حذف</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">هیچ پستی یافت نشد.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- تب افزودن پست جدید (محتوا از فایل Create.blade.php خوانده می‌شود) -->
                                @include('Admin.Blog.Create')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection
