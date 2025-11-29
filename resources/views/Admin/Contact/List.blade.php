@extends('Admin.Layouts.Master')

@section('content')
    <div class="container-fluid p-4">

        <!-- هدر بخش -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary">📨 مدیریت پیام‌های تماس</h4>
        </div>

        <!-- نمایش پیام‌های موفقیت/خطا -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- باکس جدول -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="p-3">#</th>
                                <th>کاربر</th>
                                <th>موضوع</th>
                                <th>وضعیت</th>
                                <th>تاریخ ارسال</th>
                                <th class="text-end p-3">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $key => $contact)
                                <tr>
                                    <td class="p-3 fw-bold">{{ $contacts->firstItem() + $key }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $contact->name }}</span>
                                            <small class="text-muted">{{ $contact->mobile }}</small>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($contact->subject, 30) }}</td>
                                    <td>
                                        @if ($contact->status == 'new')
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">جدید</span>
                                        @elseif($contact->status == 'read')
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">مشاهده
                                                شده</span>
                                        @else
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">پاسخ
                                                داده شده</span>
                                        @endif
                                    </td>
                                    <td class="text-muted dir-ltr text-end">{{ $contact->jalali_created_at }}</td>
                                    <!-- استفاده از Accessor مدل -->
                                    <td class="text-end p-3">
                                        <!-- دکمه باز کردن مودال -->
                                        <button type="button" class="btn btn-sm btn-primary shadow-sm"
                                            data-bs-toggle="modal" data-bs-target="#viewModal{{ $contact->id }}">
                                            بررسی و پاسخ
                                        </button>

                                        <!-- دکمه حذف -->
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                            class="d-inline-block ms-1"
                                            onsubmit="return confirm('آیا از حذف این پیام مطمئن هستید؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- مودال جزئیات و پاسخ (مخصوص هر ردیف) -->
                                <div class="modal fade" id="viewModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title fw-bold text-secondary">جزئیات پیام:
                                                    {{ $contact->subject }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <!-- اطلاعات فرستنده -->
                                                    <div class="col-md-6">
                                                        <label class="small text-muted">نام فرستنده</label>
                                                        <div class="p-2 bg-light rounded">{{ $contact->name }}</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small text-muted">شماره تماس / ایمیل</label>
                                                        <div class="p-2 bg-light rounded">
                                                            {{ $contact->mobile }}
                                                            @if ($contact->email)
                                                                | {{ $contact->email }}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- متن پیام -->
                                                    <div class="col-12">
                                                        <label class="small text-muted">متن پیام</label>
                                                        <div class="p-3 border rounded bg-white text-break"
                                                            style="min-height: 100px;">
                                                            {{ $contact->message }}
                                                        </div>
                                                    </div>

                                                    <hr class="my-4">

                                                    <!-- فرم پاسخ ادمین -->
                                                    <div class="col-12">
                                                        <h6 class="fw-bold text-primary mb-3">💬 ثبت پاسخ مدیریت</h6>
                                                        <form action="{{ route('admin.contacts.update', $contact->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label class="form-label">متن پاسخ</label>
                                                                <textarea name="reply_text" class="form-control" rows="4" placeholder="پاسخ خود را اینجا بنویسید...">{{ $contact->reply_text }}</textarea>
                                                            </div>

                                                            <div class="d-flex justify-content-end gap-2">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">بستن</button>
                                                                <button type="submit" class="btn btn-success">
                                                                    ✅ ثبت پاسخ و تغییر وضعیت
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- پایان مودال -->

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        هیچ پیامی یافت نشد! 📭
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- صفحه‌بندی -->
            <div class="card-footer bg-white py-3">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection
