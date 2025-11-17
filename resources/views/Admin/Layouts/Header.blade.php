         <!-- Navbar -->
         <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="ti ti-menu-2 ti-sm"></i>
                </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item navbar-search-wrapper mb-0">
                        <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                            <i class="ti ti-search ti-md me-2 h-mirror"></i>
                            <span class="d-none d-md-inline-block text-muted">جستجو (/+Ctrl)</span>
                        </a>
                    </div>
                </div>
                <!-- /Search -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- Language -->
                    <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <i class="ti ti-language rounded-circle ti-md"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" data-language="fa" data-text-direction="rtl" href="javascript:void(0);">
                                    <span class="align-middle">فارسی</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-language="en" data-text-direction="ltr" href="javascript:void(0);">
                                    <span class="align-middle">انگلیسی</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-language="fr" data-text-direction="ltr" href="javascript:void(0);">
                                    <span class="align-middle">فرانسوی</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-language="ar" data-text-direction="rtl" href="javascript:void(0);">
                                    <span class="align-middle">عربي</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-language="de" data-text-direction="ltr" href="javascript:void(0);">
                                    <span class="align-middle">آلمانی</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ Language -->
                    <!-- Style Switcher -->
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <i class="ti ti-md"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" data-theme="light" href="javascript:void(0);">
                                    <span class="align-middle">
                                        <i class="ti ti-sun me-2"></i>
                                        روز
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-theme="dark" href="javascript:void(0);">
                                    <span class="align-middle">
                                        <i class="ti ti-moon me-2"></i>
                                        شب
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" data-theme="system" href="javascript:void(0);">
                                    <span class="align-middle">
                                        <i class="ti ti-device-desktop me-2"></i>
                                        سیستم
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Style Switcher-->
                    <!-- Quick links  -->
                    <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                        <a aria-expanded="false" class="nav-link dropdown-toggle hide-arrow" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <i class="ti ti-layout-grid-add ti-md"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0">
                            <div class="dropdown-menu-header border-bottom">
                                <div class="dropdown-header d-flex align-items-center py-3">
                                    <h5 class="text-body mb-0 me-auto">میانبرها</h5>
                                    <a class="dropdown-shortcuts-add text-body" data-bs-placement="top" data-bs-toggle="tooltip" href="javascript:void(0)" title="افزودن میانبر">
                                        <i class="ti ti-sm ti-apps"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-shortcuts-list scrollable-container">
                                <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-calendar fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="app-calendar.html">تقویم</a>
                                        <small class="text-muted mb-0">قرارهای ملاقات</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-file-invoice fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="app-invoice-list.html">صورتحساب‌</a>
                                        <small class="text-muted mb-0">مدیریت پرداخت‌ها</small>
                                    </div>
                                </div>
                                <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-users fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="app-user-list.html">مشتریان</a>
                                        <small class="text-muted mb-0">مدیریت کاربران</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-lock fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="app-access-roles.html">سطح دسترسی</a>
                                        <small class="text-muted mb-0">موارد امنیتی</small>
                                    </div>
                                </div>
                                <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-chart-bar fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="index.html">داشبورد</a>
                                        <small class="text-muted mb-0">گزارش آماری</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-settings fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="pages-account-settings-account.html">تنظیمات</a>
                                        <small class="text-muted mb-0">مدیریت سیستم</small>
                                    </div>
                                </div>
                                <div class="row row-bordered overflow-visible g-0">
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-help fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="pages-faq.html">مرکز پشتیبانی</a>
                                        <small class="text-muted mb-0">سوالات متداول و راهنما</small>
                                    </div>
                                    <div class="dropdown-shortcuts-item col">
                                        <span class="dropdown-shortcuts-icon rounded-circle mb-2 mt-1">
                                            <i class="ti ti-square fs-4"></i>
                                        </span>
                                        <a class="stretched-link mb-0" href="modal-examples.html">مُـدال‌ها</a>
                                        <small class="text-muted mb-0">پاپ‌آپ‌های کاربردی</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Quick links -->
                    <!-- Notification -->
                    <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                        <a aria-expanded="false" class="nav-link dropdown-toggle hide-arrow" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <i class="ti ti-bell ti-md"></i>
                            <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end py-0">
                            <li class="dropdown-menu-header border-bottom">
                                <div class="dropdown-header d-flex align-items-center py-3">
                                    <h5 class="text-body mb-0 me-auto">اعلانات</h5>
                                    <a class="dropdown-notifications-all text-body" data-bs-placement="top" data-bs-toggle="tooltip" href="javascript:void(0)" title="همه خوانده شده">
                                        <i class="ti ti-mail-opened fs-4"></i>
                                    </a>
                                </div>
                            </li>
                            <li class="dropdown-notifications-list scrollable-container">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/1.png')}}"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">تبریک به شما 🎉</h6>
                                                <p class="mb-1">نشان برترین فروشنده ماه رو گرفتید</p>
                                                <small class="text-muted">الان</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded-circle bg-label-danger">ن‌م</span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">نوید محمدزاده</h6>
                                                <p class="mb-1">درخواست شمارا پذیرفت.</p>
                                                <small class="text-muted">1 ساعت قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/2.png')}}"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">پیام جدید از بهاره ✉️</h6>
                                                <p class="mb-1">شما یک پیام جدید از بهاره افشاری دارید</p>
                                                <small class="text-muted">12 ساعت قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded-circle bg-label-success">
                                                        <i class="ti ti-shopping-cart"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">ایول! سفارش جدید داری 🛒</h6>
                                                <p class="mb-1">شرکت یلدا سفارشی جدید ثبت کرد</p>
                                                <small class="text-muted">امروز</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/9.png')}}"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">اپلیکیشن بروزرسانی شد 🚀</h6>
                                                <p class="mb-1">پروژه شما باموفقیت آپدیت شد.</p>
                                                <small class="text-muted">دیروز</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded-circle bg-label-success">
                                                        <i class="ti ti-chart-pie"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">گزارش ماهانه دردسترس است</h6>
                                                <p class="mb-1">گزارش درآمد ماه شهریور آماده است</p>
                                                <small class="text-muted">2 روز قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/5.png')}}"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">ارسال درخواست همکاری</h6>
                                                <p class="mb-1">حسام درخواست همکاری فرستاد</p>
                                                <small class="text-muted">1 هفته قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/6.png')}}"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">پیام جدید از ترانه</h6>
                                                <p class="mb-1">شما یک پیام جدید دارید</p>
                                                <small class="text-muted">1 ماه قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <span class="avatar-initial rounded-circle bg-label-warning">
                                                        <i class="ti ti-alert-triangle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-2">میزان مصرف CPU بالاست</h6>
                                                <p class="mb-1">درصد استفاده از CPU درحال حاضر 90%</p>
                                                <small class="text-muted">1 ماه قبل</small>
                                            </div>
                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                <a class="dropdown-notifications-read" href="javascript:void(0)">
                                                    <span class="badge badge-dot"></span>
                                                </a>
                                                <a class="dropdown-notifications-archive" href="javascript:void(0)">
                                                    <span class="ti ti-x"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown-menu-footer border-top">
                                <a class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center" href="javascript:void(0);">
                                    نمایش همه اعلانات
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ Notification -->
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <div class="avatar avatar-online">
                                <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/1.png')}}"/>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img alt class="h-auto rounded-circle" src="{{ asset('Admin/assets/img/avatars/1.png')}}"/>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block mb-1">نوید محمدزاده</span>
                                            <small class="text-muted">مدیرکل</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pages-profile-user.html">
                                    <i class="ti ti-user-check me-2 ti-sm"></i>
                                    <span class="align-middle">پروفایل من</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                    <i class="ti ti-settings me-2 ti-sm"></i>
                                    <span class="align-middle">تنظیمات</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pages-account-settings-billing.html">
                                    <span class="d-flex align-items-center align-middle">
                                        <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                                        <span class="flex-grow-1 align-middle">خریدها</span>
                                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pages-faq.html">
                                    <i class="ti ti-help me-2 ti-sm"></i>
                                    <span class="align-middle">سوالات متداول</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="pages-pricing.html">
                                    <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                                    <span class="align-middle">قیمت گذاری</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                                    <i class="ti ti-logout me-2 ti-sm"></i>
                                    <span class="align-middle">خروج از حساب</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
                <input aria-label="جستجو..." class="form-control search-input container-xxl border-0" placeholder="جستجو..." type="text"/>
                <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
        </nav>
        <!-- / Navbar -->