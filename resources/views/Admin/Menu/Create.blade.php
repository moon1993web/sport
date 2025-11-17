
<form action="{{ route('admin.menus.store') }}" method="POST">
    @csrf
    {{-- تمام فیلدهای فرم که در Create.blade.php بود در اینجا قرار می‌گیرد --}}
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="name">نام منو</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="parent_id">منوی والد (اختیاری)</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- بدون والد --</option>
                @foreach($parentMenus as $parentMenu)
                    <option value="{{ $parentMenu->id }}" {{ old('parent_id') == $parentMenu->id ? 'selected' : '' }}>
                        {{ $parentMenu->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- ... سایر فیلدها ... --}}
     <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">ذخیره</button>
    </div>
</form>