@extends('Admin.Layouts.Master')

@section('title', 'مدیریت شبکه‌های اجتماعی')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">مدیریت شبکه‌های اجتماعی</h4>

    {{-- نمایش پیام‌های موفقیت --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- تب‌ها -->
                    <ul class="nav nav-tabs" id="socialMediaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="social-list-tab" data-bs-toggle="tab" data-bs-target="#social-list" type="button" role="tab" aria-controls="social-list" aria-selected="true">لیست شبکه‌های اجتماعی</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="social-add-tab" data-bs-toggle="tab" data-bs-target="#social-add" type="button" role="tab" aria-controls="social-add" aria-selected="false">ایجاد شبکه اجتماعی جدید</button>
                        </li>
                    </ul>

                    <!-- محتوای تب‌ها -->
                    <div class="tab-content mt-4" id="socialMediaTabsContent">
                        <!-- تب لیست شبکه‌های اجتماعی -->
                        <div class="tab-pane fade show active" id="social-list" role="tabpanel" aria-labelledby="social-list-tab">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام شبکه</th>
                                            <th>آیکن</th>
                                            <th>لینک</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($socialNetworks as $network)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $network->name }}</strong></td>
                                                <td>
                                                    {{-- نمایش آیکن در اینجا (مثلا با تگ i) --}}
                                                    {{-- <i class="{{ $network->icon->class ?? '' }}"></i> --}}
                                                    {{-- یا نام آیکن --}}
                                                    {{ $network->icon->name ?? 'بدون آیکن' }}
                                                </td>
                                                <td><a href="{{ $network->link }}" target="_blank">{{ $network->link }}</a></td>
                                                <td>
                                                    @if ($network->status)
                                                        <span class="badge bg-success">فعال</span>
                                                    @else
                                                        <span class="badge bg-warning">غیرفعال</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-sm btn-primary me-2" href="{{ route('admin.social-networks.edit', $network->id) }}">ویرایش</a>
                                                        <form action="{{ route('admin.social-networks.destroy', $network->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این مورد اطمینان دارید؟')">حذف</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">هیچ شبکه اجتماعی یافت نشد.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- لینک‌های صفحه‌بندی --}}
                            <div class="mt-4">
                                {{ $socialNetworks->links() }}
                            </div>
                        </div>

                        <!-- تب ایجاد شبکه اجتماعی جدید -->
                           @include('Admin.SocialNetwork.Create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection