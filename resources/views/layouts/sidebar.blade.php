<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('home')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="20">
            </span>
        </a>
        <a href="{{url('index')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">{{__('menu')}}</li>
                <li>
                    <a href="{{route('home')}}">
                        <i class="uil-home-alt"></i>
                        <span>{{__('dashboard')}}</span>
                    </a>
                </li>
                @if(isPermissionsAllowed("control-slider"))
                    <li>
                        <a href="{{route('sliders.index')}}">
                            <i class='bx bx-images'></i><span>{{__('slider')}}</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{route('abouts.index')}}">
                        <i class='bx bx-info-circle' ></i><span>{{__('about')}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('socials.index')}}">
                        <i class='bx bx-hash'></i><span>{{__('social_media')}}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-cog"></i>
                        <span>{{__('settings')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{route('settings.edit',1)}}">{{__('settings')}}</a></li>
                        <li><a href="{{route('languages.index')}}">{{__('languages')}}</a></li>
                        <li><a href="{{route('menus.index')}}">{{__('menus')}}</a></li>
                    </ul>
                </li>
                <!------------------------- Managers -------------------------->
                @if(isPermissionsAllowed("admin-control"))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users-cog"></i>
                        <span>{{__('managers')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route("managers.index") }}">{{__('managers')}}</a></li>
                        <li><a href="{{route('roles.index')}}">{{__("roles")}}</a></li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{route('contact_us.index')}}">
                        <i class='bx bxs-chat'></i> <span>{{__('contact_us')}}</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
