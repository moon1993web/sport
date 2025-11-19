<aside class="layout-menu menu-vertical menu bg-menu-theme" id="layout-menu">
    <div class="app-brand demo">
        <a class="app-brand-link" href="index.html">
            <span class="app-brand-logo demo">
                <svg fill="none" height="22" viewBox="0 0 32 22" width="32" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" fill-rule="evenodd"/>
                    <path clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" fill-rule="evenodd" opacity="0.06"/>
                    <path clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" fill-rule="evenodd" opacity="0.06"/>
                    <path clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" fill-rule="evenodd"/>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>
        <a class="layout-menu-toggle menu-link text-large ms-auto" href="javascript:void(0);">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.about-us.edit') }}">
                <i class="menu-icon tf-icons fa fa-info-circle"></i>
                <div data-i18n="Aboutus">درباره ما</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.contacts.index') }}">
                <i class="menu-icon tf-icons fa fa-envelope"></i>
                <div data-i18n="Contact">تماس با ما</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.classes.index') }}">
                <i class="menu-icon tf-icons fa fa-chalkboard-teacher"></i>
                <div data-i18n="Classes">کلاس ها</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Service.html">
                <i class="menu-icon tf-icons fa fa-briefcase-medical"></i>
                <div data-i18n="Services">خدمات</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.coaches.index') }}">
                <i class="menu-icon tf-icons fa fa-user-graduate"></i>
                <div data-i18n="Trainers">مربی ها</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.social-networks.index') }}">
                <i class="menu-icon tf-icons fa fa-share-alt"></i>
                <div data-i18n="Socialmedia">شبکه های اجتماعی</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.skills.index') }}">
                <i class="menu-icon tf-icons fa fa-tools"></i>
                <div data-i18n="Skills">مهارت ها</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Pricing.html">
                <i class="menu-icon tf-icons fa fa-dollar-sign"></i>
                <div data-i18n="Pricing">قیمت گذاری</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Pages.html">
                <i class="menu-icon tf-icons fa fa-file-alt"></i>
                <div data-i18n="Pages">صفحات</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.menus.index') }}">
                <i class="menu-icon tf-icons fa fa-bars"></i>
                <div data-i18n="Menu">منو</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.icons.index') }}">
                <i class="menu-icon tf-icons fa fa-icons"></i>
                <div data-i18n="Icons">آیکون ها</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Counter.html">
                <i class="menu-icon tf-icons fa fa-tachometer-alt"></i>
                <div data-i18n="Counter">شمارنده</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Comment.html">
                <i class="menu-icon tf-icons fa fa-comment"></i>
                <div data-i18n="Comments">نظرات</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.categories.index') }}">
                <i class="menu-icon tf-icons fa fa-folder"></i>
                <div data-i18n="Category">دسته بندی</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="{{ route('admin.blogs.index') }}">
                <i class="menu-icon tf-icons fa fa-blog"></i>
                <div data-i18n="Blogs">بلاگ ها</div>
            </a>
        </li>
        <li class="menu-item">
            <a class="menu-link" href="Setting.html">
                <i class="menu-icon tf-icons fa fa-cog"></i>
                <div data-i18n="Setting">مدیریت تنظیمات</div>
            </a>
        </li>
    </ul>
</aside>