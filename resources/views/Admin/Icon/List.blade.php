
@extends('Admin.Layouts.Master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">آیکون‌ها /</span> FontAwesome
    </h4>
    <p>لیست کامل آیکون‌های FontAwesome در لینک <a href="https://fontawesome.com/" target="_blank"><bdi>https://fontawesome.com/</bdi></a> قابل مشاهده است.</p>

    {{-- نمایش پیام‌های موفقیت --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- تب‌ها -->
    <ul class="nav nav-tabs" id="iconTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="list-icon-tab" data-bs-toggle="tab" data-bs-target="#list-icon" type="button" role="tab" aria-controls="list-icon" aria-selected="true">لیست آیکون‌ها</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="create-icon-tab" data-bs-toggle="tab" data-bs-target="#create-icon" type="button" role="tab" aria-controls="create-icon" aria-selected="false">ایجاد آیکون</button>
        </li>
    </ul>

    <!-- محتوای تب‌ها -->
    <div class="tab-content" id="iconTabsContent">
        <!-- تب لیست آیکون‌ها -->
        <div class="tab-pane fade show active" id="list-icon" role="tabpanel" aria-labelledby="list-icon-tab">
            <div class="d-flex flex-wrap" id="icons-container">
                {{-- حلقه‌ی Blade برای نمایش آیکون‌ها از دیتابیس --}}
                @forelse ($icons as $icon)
                    <div class="card icon-card text-center mb-4 mx-2">
                        <div class="card-body">
                            {{-- نمایش آیکون با استفاده از تگ ذخیره شده --}}
                            <div class="mb-2" style="font-size: 2rem;">
                                {!! $icon->tag !!}
                            </div>
                            
                            {{-- نمایش نام آیکون --}}
                            <p class="icon-name text-capitalize text-truncate mt-2 mb-2">{{ $icon->name }}</p>

                            {{-- فرم حذف آیکون --}}
                            <form action="{{ route('admin.icons.destroy', $icon->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این آیکون مطمئن هستید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- پیامی برای زمانی که هیچ آیکونی وجود ندارد --}}
                    <div class="alert alert-info w-100">
                        هیچ آیکونی برای نمایش وجود ندارد. شما می‌توانید از تب "ایجاد آیکون" یک مورد جدید اضافه کنید.
                    </div>
                @endforelse
            </div>

            {{-- لینک‌های کمکی --}}
            <div class="d-flex justify-content-center mx-auto gap-3 mt-4">
                <a class="btn btn-primary" href="https://fontawesome.com/" target="_blank">آیکون‌های بیشتر</a>
                <a class="btn btn-primary" href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation//Icons.html" target="_blank">روش استفاده</a>
            </div>
        </div>

        <!-- تب ایجاد آیکون -->
        @include('Admin.Icon.Create')
    </div>
</div>


@endsection