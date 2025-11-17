<div class="tab-pane fade" id="class-add" role="tabpanel" aria-labelledby="add-tab">
    {{-- <form onsubmit="alert('کلاس جدید ذخیره شد'); return true;"> --}}
    <div class="row g-3">

        <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- این بخش را اضافه کنید --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>خطا! لطفاً موارد زیر را بررسی کنید:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- پایان بخش اضافه شده --}}

            <div class="row g-3">
                {{-- بقیه فیلدهای فرم شما --}}




                <!--image-->
                <div class="col-md-6 form-group">
                    <label for="image" class="form-label">آپلود عکس</label>
                    <input type="file" class="form-control" id="image" name="image"
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/tiff" />
                </div>

                <div id="image-preview" class="mt-3">
                    <img id="preview-img" src="#" alt="پیش‌نمایش تصویر"
                        style="max-width: 100%; max-height: 200px; display: none;" />
                </div>
                @error('image')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror

                <!--/image-->
                <!-- عنوان کلاس -->
                <div class="col-md-6 form-group">
                    <label for="name" class="form-label">عنوان کلاس </label>
                    <input type="text" class="form-control" id="name" name="title"
                        placeholder="مثال: برنامه‌نویسی پایتون" required>
                </div>
                <!-- دسته‌بندی کلاس‌ها -->
                <!-- دسته‌بندی کلاس‌ها -->
                <div class="col-md-6">
                    <label class="form-label" for="class-category">دسته‌بندی کلاس‌ها</label>
                    {{-- ویژگی name برای ارسال category_id به کنترلر ضروری است --}}
                    <select class="form-select" id="class-category" name="category_id" required>
                        <option value="" selected disabled>انتخاب کنید</option>

                        {{-- حلقه برای نمایش داینامیک دسته‌بندی‌ها --}}
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                    @error('category_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- مربی -->
                <!-- مربی -->
                <div class="col-md-6">
                    <label class="form-label" for="class-coach">مربی</label>
                    {{-- ویژگی name برای ارسال coach_id به کنترلر ضروری است --}}
                    <select class="form-select" id="class-coach" name="coach_id" required>
                        <option value="" selected disabled>انتخاب کنید</option>

                        {{-- حلقه برای نمایش داینامیک مربیان --}}
                        @foreach ($coaches as $coach)
                            <option value="{{ $coach->id }}">
                                {{ $coach->full_name }}
                            </option>
                        @endforeach

                    </select>
                    @error('coach_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- روزهای کلاس (چک‌باکس) -->
                <!-- روزهای کلاس (چک‌باکس) -->
                <div class="col-md-12">
                    <label class="form-label">روزهای کلاس</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="shanbe"
                                value="شنبه">
                            <label class="form-check-label" for="shanbe">شنبه</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="yekshanbe"
                                value="یک‌شنبه">
                            <label class="form-check-label" for="yekshanbe">یک‌شنبه</label>
                        </div>
                        <!-- بقیه روزها نیز به همین شکل با name="days[]" -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="doshanbe"
                                value="دوشنبه">
                            <label class="form-check-label" for="doshanbe">دوشنبه</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="seshanbe"
                                value="سه‌شنبه">
                            <label class="form-check-label" for="seshanbe">سه‌شنبه</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="chaharshanbe"
                                value="چهارشنبه">
                            <label class="form-check-label" for="chaharshanbe">چهارشنبه</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="panjshanbe"
                                value="پنج‌شنبه">
                            <label class="form-check-label" for="panjshanbe">پنج‌شنبه</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="days[]" id="jome"
                                value="جمعه">
                            <label class="form-check-label" for="jome">جمعه</label>
                        </div>
                    </div>
                </div>
                <!-- زمان کلاس -->
                <div class="col-md-12">
               
                    <div id="custom-time-input" class="mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="class-start-time">زمان شروع</label>
                                <input class="form-control" type="time" id="class-start-time" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="class-end-time">زمان پایان</label>
                                <input class="form-control" type="time" id="class-end-time" required />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- دکمه‌ها -->
                <div class="col-12 d-flex justify-content-between">
                    <button type="reset" class="btn btn-label-secondary">انصراف</button>
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </form>
    </div>
