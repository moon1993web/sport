 <div class="tab-pane fade" id="create-icon" role="tabpanel" aria-labelledby="create-icon-tab">
            <div class="card p-4">
                <h5>ایجاد آیکون جدید</h5>
                <form action="{{ route('admin.icons.store') }}" method="POST" id="createIconForm">
                    @csrf
                    <div class="mb-3">
                        <label for="iconTag" class="form-label">تگ آیکون (مثال: &lt;i class="fa-solid fa-face-smile"&gt;&lt;/i&gt;)</label>
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" id="iconTag" name="tag" value="{{ old('tag') }}" placeholder="تگ کامل آیکون را وارد کنید" required>
                        @error('tag')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <!-- کانتینر پیش‌نمایش آیکون -->
                        <div class="text-center my-3" id="iconPreview" style="font-size: 40px;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="iconName" class="form-label">نام آیکون</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="iconName" name="name" value="{{ old('name') }}" placeholder="نام آیکون را وارد کنید" required>
                         @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">اضافه کردن آیکون</button>
                </form>
            </div>
        </div>




      
<script>
document.addEventListener('DOMContentLoaded', function () {
    const iconTagInput = document.getElementById('iconTag');
    const iconPreview = document.getElementById('iconPreview');

    // تابع برای نمایش پیش‌نمایش زنده آیکون در فرم ایجاد
    if (iconTagInput) {
        iconTagInput.addEventListener('input', function () {
            iconPreview.innerHTML = this.value;
        });
    }
});
</script>
