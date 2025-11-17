@extends('Front.Layouts.Master')

@section('content')
    <!-- ... بخش header banner (بدون تغییر) ... -->
    <div class="carousel slide" data-ride="carousel" id="demo1">
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url({{ asset('Front/assets/img/blog_bg.png') }}); height:526px;">
                <div class="slider_text1"><h1>وبلاگ</h1></div>
                <div class="carousel-caption1"><div class="container"><div class="row"><div class="col-lg-12"><div class="inner_page_title"><h2>وبلاگ</h2></div></div></div></div></div>
            </div>
        </div>
    </div>
    <!-- end header banner section -->

    <!-- start Blog -->
    <div class="blog">
        <div class="container">
            <div class="row">
                {{-- ستون سایدبار (کاملاً داینامیک و کامل) --}}
                <div class="col-lg-4">
                    {{-- بخش جستجو --}}
                    <div class="search_box">
                        <div class="blog_title">
                            <h3>جستجو</h3>
                            <img class="img-fluid" src="{{ asset('Front/assets/img/border_blog.png') }}" alt="border"/>
                        </div>
                        <form action="{{ route('front.blogs.index') }}" method="GET">
                            <div class="show" id="searchbox">
                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <svg class="magnify" viewbox="0 0 48 48"><path d="M31 28h-1.59l-.55-.55C30.82 25.18 32 22.23 32 19c0-7.18-5.82-13-13-13S6 11.82 6 19s5.82 13 13 13c3.23 0 6.18-1.18 8.45-3.13l.55.55V31l10 9.98L40.98 38 31 28zm-12 0c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z"></path></svg>
                                </button>
                                <input name="search" id="search-input" placeholder="جستجو..." type="text" value="{{ request('search') }}" />
                            </div>
                        </form>
                    </div>

                    {{-- بخش پست‌های محبوب --}}
                    @if(isset($popularPosts) && $popularPosts->isNotEmpty())
                    <div class="popular_box">
                        <div class="blog_title">
                            <h3>پست های محبوب</h3>
                            <img class="img-fluid" src="{{ asset('Front/assets/img/border_blog.png') }}" alt="border"/>
                        </div>
                        @foreach($popularPosts as $post)
                        <div class="post_item">
                            <div class="post_img">
                                <a href="{{ route('front.blogs.show', $post) }}"><img class="img-fluid" src="{{ asset('Admin/assets/img/blog/' . $post->image) }}" alt="{{ $post->title }}"/></a>
                            </div>
                            <div class="post_con">
                                <h3><a href="{{ route('front.blogs.show', $post) }}">{{ $post->title }}</a></h3>
                                @if($post->date)
                                    <p><a href="#">{{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($post->date))->format('d F Y') }}</a></p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- ====== شروع بخش اضافه شده: دسته‌بندی‌ها ====== --}}
                    @if(isset($categories) && $categories->isNotEmpty())
                    <div class="categories_box">
                        <div class="blog_title">
                            <h3>دسته بندی ها</h3>
                            <img class="img-fluid" src="{{ asset('Front/assets/img/border_blog.png') }}" alt="border"/>
                        </div>
                        <div class="categories_con">
                            <div class="sidebar-info">
                                <ul>
                                    @foreach($categories as $category)
                                    <li><a href="#">{{ $category->name }} <span class="categories_left">{{ $category->blogs_count }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- ====== پایان بخش اضافه شده: دسته‌بندی‌ها ====== --}}

                    {{-- ====== شروع بخش اضافه شده: برچسب‌ها ====== --}}
                    @if(isset($tags) && $tags->isNotEmpty())
                    <div class="tags_box">
                        <div class="blog_title">
                            <h3>برچسب ها</h3>
                            <img class="img-fluid" src="{{ asset('Front/assets/img/border_blog.png') }}" alt="border"/>
                        </div>
                        <div class="tags">
                            <ul>
                                @foreach($tags as $tag)
                                <li><a href="#">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    {{-- ====== پایان بخش اضافه شده: برچسب‌ها ====== --}}
                </div>

                {{-- ستون اصلی محتوای بلاگ‌ها (بدون تغییر) --}}
                <div class="col-lg-8">
                    @forelse ($blogs as $blog)
                        <div class="blog_page_box">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="blog_img_inner">
                                        <a href="{{ route('front.blogs.show', $blog) }}">
                                            <img class="img-fluid" src="{{ asset('Admin/assets/img/blog/' . $blog->image) }}" alt="{{ $blog->title }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="blog_con_inner">
                                        <h4>{{ $blog->category->name ?? 'بدون دسته‌بندی' }}</h4>
                                        <h3><a href="{{ route('front.blogs.show', $blog) }}">{{ $blog->title }}</a></h3>
                                        <div class="date_con">
                                            <div class="date_box">
                                                @if($blog->date)
                                                    <p><i aria-hidden="true" class="fa fa-calendar-check-o"></i> {{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($blog->date))->format('d F Y') }}</p>
                                                @endif
                                            </div>
                                            <div class="time_box">
                                                <p><i aria-hidden="true" class="fa fa-user-o"></i> توسط {{ $blog->author ?? 'ادمین' }}</p>
                                            </div>
                                        </div>
                                        <p>{{ $blog->short_description }}</p>
                                        <div class="read_more_blog">
                                            <a class="blog_btn" href="{{ route('front.blogs.show', $blog) }}">
                                                ادامه مطلب <i aria-hidden="true" class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center">
                            هیچ پستی برای نمایش وجود ندارد.
                        </div>
                    @endforelse

                    {{-- نمایش لینک‌های صفحه‌بندی --}}
                    <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                        {{ $blogs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Blog -->
@endsection