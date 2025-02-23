<html class="no-js" lang="">
<head>
@include('includes.head')
@yield('customStyle')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
    @include('includes.navigation')
    @include('includes.sidebar')
    @yield('content')
    @include('includes.footer')
    </div>
    @include('includes.script')
@yield('customScript')
</body>
</html>