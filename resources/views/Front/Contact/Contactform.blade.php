@extends('Front.Layouts.Master')

@section('content')

<!-- start contact -->
<div class="contact_form">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="title_box">
          <h2>با ما در تماس باشید</h2> <!-- 🟩 اصلاح ترجمه -->
          <img class="img-fluid" src="assets/img/title_line.png" />
        </div>
      </div>
      <div class="col-lg-10">
        
        <!-- 🟩 نمایش پیام موفقیت -->
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- 🟩 افزودن اکشن و متد -->
        <form action="{{ route('front.contact.store') }}" method="POST">
            @csrf <!-- 🟩 توکن امنیتی الزامی -->
            
          <div class="row">
            
            <!-- 1. نام کامل -->
            <div class="col-lg-6">
              <input
                class="contact_from @error('name') border-danger @enderror" 
                name="name"
                value="{{ old('name') }}" 
                placeholder="نام و نام خانوادگی"
                type="text"
              />
              <!-- 🟩 نمایش خطای اعتبارسنجی -->
              @error('name')
                  <small class="text-danger d-block mb-2">{{ $message }}</small>
              @enderror
            </div>

            <!-- 2. موبایل (جایگزین Last Name شد تا با دیتابیس هماهنگ شود) -->
            <div class="col-lg-6">
              <input
                class="contact_from @error('mobile') border-danger @enderror"
                name="mobile"
                value="{{ old('mobile') }}"
                placeholder="شماره تماس"
                type="text"
              />
              @error('mobile')
                  <small class="text-danger d-block mb-2">{{ $message }}</small>
              @enderror
            </div>

            <!-- 3. ایمیل -->
            <div class="col-lg-6">
              <input
                class="contact_from @error('email') border-danger @enderror"
                name="email"
                value="{{ old('email') }}"
                placeholder="ایمیل (اختیاری)"
                type="email"
              />
              @error('email')
                  <small class="text-danger d-block mb-2">{{ $message }}</small>
              @enderror
            </div>

            <!-- 4. موضوع (این فیلد در HTML اصلی نبود ولی در دیتابیس الزامی است) -->
            <div class="col-lg-6">
              <input
                class="contact_from @error('subject') border-danger @enderror"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="موضوع پیام"
                type="text"
              />
              @error('subject')
                  <small class="text-danger d-block mb-2">{{ $message }}</small>
              @enderror
            </div>

            <!-- 5. متن پیام -->
            <div class="col-lg-12">
              <textarea
                class="contact_mes @error('message') border-danger @enderror"
                name="message"
                placeholder="متن پیام شما..."
                rows="5"
              >{{ old('message') }}</textarea> <!-- 🟩 مقدار old برای textarea باید بین تگ‌ها باشد -->
              @error('message')
                  <small class="text-danger d-block mb-2">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-lg-12">
              <div class="submit_btn1">
                <button class="submit_btn" type="submit">
                  ارسال پیام
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- start contact -->
@endsection