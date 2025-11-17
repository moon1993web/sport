
@extends('Admin.Layouts.master')

@section('title', 'ویرایش منو')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ویرایش منو: {{ $menu->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">نام منو</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="parent_id">منوی والد (اختیاری)</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">-- بدون والد --</option>
                            @foreach($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->id }}" {{ old('parent_id', $menu->parent_id) == $parentMenu->id ? 'selected' : '' }}>
                                    {{ $parentMenu->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="link">لینک</label>
                        <input type="text" name="link" id="link" class="form-control" value="{{ old('link', $menu->link) }}" required>
                        @error('link')
                             <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="type">نوع منو</label>
                        <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $menu->type) }}" required>
                        @error('type')
                             <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="position">موقعیت</label>
                        <input type="number" name="position" id="position" class="form-control" value="{{ old('position', $menu->position) }}" required min="0">
                        @error('position')
                             <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="status">وضعیت</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', $menu->status) == 1 ? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ old('status', $menu->status) == 0 ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                        @error('status')
                             <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">بروزرسانی</button>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
@endsection