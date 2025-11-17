<html dir="rtl" lang="fa">

@include('Front.Layouts.Head-tags')

<body>
@include('Front.Layouts.Loader')

@include('Front.Layouts.Header')

<!--content-->

@yield('content')
<!--/content-->

@include('Front.Layouts.Footer')


@include('Front.Layouts.Script')

</body>
</html>