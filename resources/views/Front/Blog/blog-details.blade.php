 @extends('Front.Layouts.Master')




@section('content')
 
 
 
 <!-- start Blog -->
    <div class="blog">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="search_box">
              <div class="blog_title">
                <h3>جستجو</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="show" id="searchbox">
                <svg class="magnify" viewbox="0 0 48 48">
                  <path
                    d="M31 28h-1.59l-.55-.55C30.82 25.18 32 22.23 32 19c0-7.18-5.82-13-13-13S6 11.82 6 19s5.82 13 13 13c3.23 0 6.18-1.18 8.45-3.13l.55.55V31l10 9.98L40.98 38 31 28zm-12 0c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z"
                  ></path>
                </svg>
                <input id="search-input" placeholder="Search..." type="text" />
              </div>
            </div>
            <div class="popular_box">
              <div class="blog_title">
                <h3>پست های محبوب</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="post_item">
                <div class="post_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/post1.jpg')}}" />
                </div>
                <div class="post_con">
                  <h3>یوگا چیست؟</h3>
                  <p><a href="#">14 ژوئیه 2018</a></p>
                </div>
              </div>
              <div class="post_item">
                <div class="post_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/post2.jpg')}}" />
                </div>
                <div class="post_con">
                  <h3>چگونه مراقبه آرام را پیدا کنیم</h3>
                  <p><a href="#">14 ژوئیه 2018</a></p>
                </div>
              </div>
              <div class="post_item">
                <div class="post_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/post3.jpg')}}" />
                </div>
                <div class="post_con">
                  <h3>کارگاه آینده یوگا در شهر</h3>
                  <p><a href="#">14 ژوئیه 2018</a></p>
                </div>
              </div>
              <div class="post_item">
                <div class="post_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/post4.jpg')}}" />
                </div>
                <div class="post_con">
                  <h3>برای صفحه کلید شماره.</h3>
                  <p><a href="#">14 ژوئیه 2018</a></p>
                </div>
              </div>
            </div>
            <div class="categories_box">
              <div class="blog_title">
                <h3>دسته</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="categories_con">
                <div class="sidebar-info">
                  <ul>
                    <li>
                      <a href="#"
                        >Business <span class="categories_left">15</span></a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >News <span class="categories_left">20</span></a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Strategy <span class="categories_left">09</span></a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Brand <span class="categories_left">20</span></a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Site <span class="categories_left">20</span></a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Internal <span class="categories_left">03</span></a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="tags_box">
              <div class="blog_title">
                <h3>برچسب ها</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="tags">
                <ul>
                  <li><a href="#">مرکز یوگا</a></li>
                  <li><a href="#">مربی</a></li>
                  <li><a href="#">یوگا</a></li>
                  <li><a href="#">مراقبت های بهداشتی</a></li>
                  <li><a href="#">جریان</a></li>
                  <li><a href="#">نکات</a></li>
                  <li><a href="#">تجهیزات</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="single_blog">
              <h4>رقص یوگا</h4>
              <h3>تا زمانی که Ultricies صورتحساب قوس باشد.</h3>
              <div class="date_con">
                <div class="date_box">
                  <p>
                    <i aria-hidden="true" class="fa fa-calendar-check-o"></i>
                    Mon, Tue, Wed
                  </p>
                </div>
                <div class="time_box">
                  <p>
                    <i aria-hidden="true" class="fa fa-user-o"></i> By Admin
                  </p>
                </div>
              </div>
              <div class="single_img">
                <img class="img-fluid" src="{{asset('Front/assets/img/single_blog.jpg')}}" />
              </div>
              <p>
                <i
                  >استرس یا وسایل نقلیه قطر A ماکرو استریل شده است. تا زمانی که
                  Ultricies الکل یک فوتبال لاورت باشد. در این انواع خیابان.
                  گلدان تولید ، نیاز به شکلات Quis Laoreet ، نویسنده در خنده.
                  مایکروفی دامن کارمند شکلات زشت فوتبال.</i
                >
              </p>
              <p>
                تغذیه در ترس عکاسی ، که Euismod Mauris. سالاد هدفمند غمگین زندگی
                کنید. اما بود درد ، استریل یا باردار و. هواپیمایی فوتبال
                Pulvinar Chili. ماشه عدد صحیح ، نه فوتبال والیبال الکل فوق
                العاده. اجرای زنده SAPIEN AC EUISMOD ULTRICIES. اخطار ماهانه
                مایکروویو آنتی اکسیدان ها ، فوق العاده زندگی بزرگترین. موریس
                الیفند کارمند فوتبال. برای تنظیم تخمیر
              </p>
              <h3>تعلیق عکاسی زمان Laoreet.</h3>
              <p>
                همچنین قطر ، بدون پیشرفت را دریافت می کند ، که فک های اصلی ماکرو
                است. هر پخش کننده صفحه کلید است اجباری بدون استریل و یک تغذیه
                تحریک گرم. فردا کارتون شیمیایی گربه استریل شده و گربه را سرمایه
                گذاری کنید گلو هواپیما. فوتبال یک درد بود ، گاهی اوقات تبلیغاتی
                که ، آنتی اکسیدان ها تأیید می کنند.
              </p>
              <div class="blog_video">
                <div class="blog_video_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/blog_video.jpg')}}" />
                  <p>Prime Alamam همچنین Lorem Soda</p>
                </div>
                <div class="blog_video_icon">
                  <img class="img-fluid" src="assets/img/video.png" />
                </div>
              </div>
              <p>
                اما توسعه دهنده تولید از عکاسی پشیمان نیست. شناسه moreofer چگونه
                اکنون گفته شده است. برای مواد شیمیایی Mi Vestibulum ، سالاد موز
                از ترس آرایش. یاس و موریس بعد از ظهر به لبخند عکاسی. برای
                اطمینان از تبلیغات تجمع ، گلو در ، تخمیر ساپین. فوتبال یا
                عزاداری یا توسعه دهنده Laoreet.
              </p>
              <div class="bottom-box">
                <span class="pull-left">
                  <ul>
                    <li><a href="#">مرکز یوگا</a></li>
                    <li><a href="#">مربی</a></li>
                    <li><a href="#">جریان</a></li>
                  </ul>
                </span>
                <ul class="pull-right share">
                  <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="comments_box">
              <div class="blog_title">
                <h3>نظرات</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="comments_box_1">
                <div class="comments_box_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/co1.jpg')}}" />
                </div>
                <div class="comments_box_con">
                  <div class="com_con">
                    <h4>جاناتان دو</h4>
                    <h5>2 روز پیش</h5>
                  </div>
                  <p>
                    آخرین آخر هفته Maecenas یا وسایل نقلیه فلفل دلمه ای ،
                    نوجوانان لبخند می زنند ، بالینی متنوع. هیچ تفاوتی وجود ندارد
                    شیر در مخزن شیر Imperdiet. حتی برای نفرت
                  </p>
                  <p>
                    <a href="#"
                      ><i aria-hidden="true" class="fa fa-reply"></i> Reply</a
                    >
                  </p>
                </div>
              </div>
              <div class="comments_box_1">
                <div class="comments_box_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/co2.jpg')}}" />
                </div>
                <div class="comments_box_con">
                  <div class="com_con">
                    <h4>جان دو</h4>
                    <h5>2 روز پیش</h5>
                  </div>
                  <p>
                    کارآفرینان مشق شب بالینی مگر اینکه ، و توسعه دهنده بسکتبال
                    دریافت می کند. Nam Cat Mauris ، شناسه Ullamcorper نظرسنجی.
                  </p>
                  <p>
                    <a href="#"
                      ><i aria-hidden="true" class="fa fa-reply"></i> Reply</a
                    >
                  </p>
                </div>
              </div>
              <div class="comments_box_1">
                <div class="comments_box_img">
                  <img class="img-fluid" src="{{asset('Front/assets/img/co3.jpg')}}" />
                </div>
                <div class="comments_box_con">
                  <div class="com_con">
                    <h4>کیلی استوارت</h4>
                    <h5>2 روز پیش</h5>
                  </div>
                  <p>
                    آخرین آخر هفته Maecenas یا وسایل نقلیه فلفل دلمه ای ،
                    نوجوانان لبخند می زنند ، بالینی متنوع. هیچ تفاوتی وجود ندارد
                    شیر در مخزن شیر Imperdiet. حتی برای نفرت
                  </p>
                  <p>
                    <a href="#"
                      ><i aria-hidden="true" class="fa fa-reply"></i> Reply</a
                    >
                  </p>
                </div>
              </div>
            </div>
            <div class="comments_from">
              <div class="blog_title">
                <h3>فکر خود را اینجا بگذارید</h3>
                <img class="img-fluid" src="{{asset('Front/assets/img/border_blog.png')}}" />
              </div>
              <div class="form_com">
                <form>
                  <div class="row">
                    <div class="col-lg-4">
                      <input
                        class="contact_from"
                        placeholder="Full Name"
                        required=""
                        type="text"
                      />
                    </div>
                    <div class="col-lg-4">
                      <input
                        class="contact_from"
                        placeholder="Your Email"
                        required=""
                        type="text"
                      />
                    </div>
                    <div class="col-lg-4">
                      <input
                        class="contact_from"
                        placeholder="Phone No."
                        required=""
                        type="text"
                      />
                    </div>
                    <div class="col-lg-12">
                      <textarea
                        class="contact_mes"
                        placeholder="Message..."
                        required=""
                      ></textarea>
                    </div>
                    <div class="col-lg-12">
                      <div class="submit_btn1">
                        <button class="submit_btn" type="submit">
                          اکنون ارسال کنید
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end Blog -->