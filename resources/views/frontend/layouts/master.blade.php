<!DOCTYPE html>
<html dir="ltr" lang="en-US">

@include('frontend.layouts.head')


<body class="gradient-bg">
    @include('frontend.layouts.svg-sprite')

    @include('frontend.layouts.main-headerbar')

    @yield('content')

    @include('frontend.layouts.footer')

    @include('frontend.layouts.scripts')
</body>

</html>