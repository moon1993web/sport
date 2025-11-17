@extends('Admin.Layouts.Master')

@section('title', 'ویرایش شبکه اجتماعی')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">شبکه‌های اجتماعی /</span> ویرایش
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">فرم ویرایش شبکه اجتماعی</h5>
                </div>
                <div class="card-body">
                    {{-- فرم ویرایش --}}
                    <form action="{{ route('admin.social-networks.update', $social_network->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- متد HTTP برای به‌روزرسانی --}}
                        
                        <div class="row g-3">
                            <!-- نام شبکه -->
                            <div class="col-md-6">
                                <label class="form-label" for="name">نام شبکه</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" placeholder="مثال: اینستاگرام" 
                                    value="{{ old('name', $social_network->name) }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- لینک -->
                            <div class="col-md-6">
                                <label class="form-label" for="link">لینک</label>
                                <input class="form-control @error('link') is-invalid @enderror" type="url" id="link"
                                    name="link" placeholder="https://example.com" 
                                    value="{{ old('link', $social_network->link) }}" />
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- آیکن -->
                            <div class="col-md-6">
                                <label class="form-label" for="icon_id">آیکن</label>
                                <select class="form-select @error('icon_id') is-invalid @enderror" id="icon_id" name="icon_id">
                                    <option disabled>یک آیکن انتخاب کنید...</option>
                                    @foreach ($icons as $icon)
                                        <option value="{{ $icon->id }}" 
                                            {{ old('icon_id', $social_network->icon_id) == $icon->id ? 'selected' : '' }}>
                                            {{ $icon->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('icon_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- وضعیت -->
                            <div class="col-md-6">
                                <label class="form-label" for="status">وضعیت</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1" {{ old('status', $social_network->status) == '1' ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ old('status', $social_network->status) == '0' ? 'selected' : '' }}>غیرفعال</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- دکمه‌ها -->
                            <div class="col-12 mt-4 pt-2 d-flex justify-content-end">
                                <a href="{{ route('admin.social-networks.index') }}" class="btn btn-label-secondary me-3">انصراف</a>
                                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection