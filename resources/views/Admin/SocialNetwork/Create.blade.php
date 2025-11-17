 <div class="tab-pane fade" id="social-add" role="tabpanel" aria-labelledby="social-add-tab">
     <form action="{{ route('admin.social-networks.store') }}" method="POST">
         @csrf
         <div class="row g-3">
             <!-- نام شبکه -->
             <div class="col-md-6">
                 <label class="form-label" for="name">نام شبکه</label>
                 <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                     name="name" placeholder="مثال: اینستاگرام" value="{{ old('name') }}" />
                 @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div>

             <!-- لینک -->
             <div class="col-md-6">
                 <label class="form-label" for="link">لینک</label>
                 <input class="form-control @error('link') is-invalid @enderror" type="url" id="link"
                     name="link" placeholder="https://example.com" value="{{ old('link') }}" />
                 @error('link')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div>

             <!-- آیکن -->
             {{-- <div class="col-md-6">
                 <label class="form-label" for="icon_id">آیکن</label>
                 <select class="form-select @error('icon_id') is-invalid @enderror" id="icon_id" name="icon_id">
                     <option selected disabled>یک آیکن انتخاب کنید...</option>
                     @foreach ($icons as $icon)
                         <option value="{{ $icon->id }}" {{ old('icon_id') == $icon->id ? 'selected' : '' }}>
                             {{ $icon->name }}
                         </option>
                     @endforeach
                 </select>
                 @error('icon_id')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div> --}}



<div class="col-md-6">
    <label class="form-label" for="icon_id">آیکن</label>

    {{-- از input-group برای چسباندن پیش‌نمایش به select استفاده می‌کنیم --}}
    <div class="input-group">

        <select class="form-select icon-select @error('icon_id') is-invalid @enderror" id="icon_id" name="icon_id">
            {{-- مقدار value را خالی بگذارید تا رویداد change به درستی کار کند --}}
            <option value="" selected disabled>یک آیکن انتخاب کنید...</option>
            @foreach ($icons as $icon)
                <option 
                    value="{{ $icon->id }}" 
                    data-icon-class="{{ $icon->tag }}" 
                    {{ old('icon_id', $social_network->icon_id ?? '') == $icon->id ? 'selected' : '' }}>
                    {{ $icon->name }}
                </option>
            @endforeach
        </select>

        {{-- این بخش، محل نمایش پیش‌نمایش آیکن است --}}
        <span class="input-group-text" id="icon-preview">
            <i class="ti ti-question-mark"></i> {{-- یک آیکن پیش‌فرض --}}
        </span>

    </div>

    @error('icon_id')
        {{-- کلاس d-block برای نمایش صحیح خطا در input-group لازم است --}}
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>














             <!-- وضعیت -->
             <div class="col-md-6">
                 <label class="form-label" for="status">وضعیت</label>
                 <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                     <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>فعال</option>
                     <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>غیرفعال</option>
                 </select>
                 @error('status')
                     <div class="invalid-feedback">{{ $message }}</div>
                 @enderror
             </div>

             <!-- دکمه‌ها -->
             <div class="col-12 mt-4 d-flex justify-content-between">
                 <a href="{{ route('admin.social-networks.index') }}" class="btn btn-label-secondary">انصراف</a>
                 <button type="submit" class="btn btn-primary">ذخیره</button>
             </div>
         </div>
     </form>
 </div>





<script>
    $(document).ready(function() {
        // این تابع برای فرمت‌دهی گزینه‌های داخل لیست است (بدون تغییر)
        function formatIcon(icon) {
            if (!icon.id) { return icon.text; }
            var iconClass = $(icon.element).data('icon-class');
            if (!iconClass) { return icon.text; }
            var $icon = $('<span><i class="' + iconClass + ' me-2"></i> ' + icon.text + '</span>');
            return $icon;
        }

        // راه‌اندازی Select2 (بدون تغییر)
        $('.icon-select').select2({
            templateResult: formatIcon,
            templateSelection: formatIcon,
            escapeMarkup: function(m) { return m; }
        });

        // ==========================================================
        // ===== کد جدید برای پیش‌نمایش زنده در اینجا اضافه می‌شود =====
        // ==========================================================

        // یک رویداد (event listener) برای زمان تغییر مقدار select-box تعریف می‌کنیم
        $('.icon-select').on('change', function() {
            // گزینه انتخاب شده را پیدا کن
            var selectedOption = $(this).find('option:selected');
            
            // کلاس آیکن را از data attribute آن بخوان
            var iconClass = selectedOption.data('icon-class');
            
            // عنصر پیش‌نمایش را پیدا کن
            var previewElement = $('#icon-preview');
            
            if (iconClass) {
                // اگر کلاس آیکن وجود داشت، محتوای HTML عنصر پیش‌نمایش را به‌روز کن
                previewElement.html('<i class="' + iconClass + '"></i>');
            } else {
                // در غیر این صورت (مثلا اگر گزینه "انتخاب کنید" انتخاب شد)، آیکن پیش‌فرض را نشان بده
                previewElement.html('<i class="ti ti-question-mark"></i>');
            }
        });

        // برای اینکه در صفحه ویرایش یا در صورت وجود old()، پیش‌نمایش از ابتدا نمایش داده شود
        // رویداد change را یک بار به صورت دستی فراخوانی می‌کنیم
        $('.icon-select').trigger('change');
    });
</script>
