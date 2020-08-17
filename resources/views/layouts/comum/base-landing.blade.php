<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" prefix="og: http://ogp.me/ns#">
<head>
    @yield('head')
</head>
<body class="smoothscroll grain-blue">
{{-- plugins do tag manager e analytics--}}
    @yield('page-plugins')
<div id="app-core">
    <div id="container">
        @yield('container')
    </div>
</div>

@yield('scripts')

</body>
</html>

