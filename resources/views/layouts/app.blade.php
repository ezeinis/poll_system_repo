<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('head')
</head>
<body id="app-layout">

    @yield('nav')

    @yield('content')

    @include('includes.defaultjs')
    @yield('js')
</body>
</html>
