@yield('css')

@switch(app()->getLocale())
    @case('ar')
        <link href="{{ URL::asset('assets/css/bootstrap.rtl.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/icons.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/app.rtl.css')}}" id="app-rtl" rel="stylesheet" type="text/css" />
        @break
    @case('en')
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ URL::asset('/assets/css/icons.min.css')}}" id="icons-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ URL::asset('/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
@endswitch

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
