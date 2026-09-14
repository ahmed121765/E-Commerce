<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

@include('admin.layouts.head')

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                @include('admin.layouts.main-sidebar')
                <div class="section-content-right">

                    @include('admin.layouts.main-headerbar')
                    <div class="main-content">

                    @yield('content')

                        @include('admin.layouts.footer')
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
</body>

</html>