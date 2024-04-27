<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
</head>

@section('body')

    <body class="authentication-bg">
    @show
    @yield('content')
    @include('layouts.vendor-scripts')
</body>

</html>
