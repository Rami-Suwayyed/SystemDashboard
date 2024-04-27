@extends('layouts.master')
@section('title') {{__('dashboard')}} @endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') {{__('dashboard')}} @endslot
    @endcomponent


    <div class="row">
        <div class="col-md-4">
            <div class="card bg-dark border-dark text-light">
                <a href="{{route('settings.edit',1)}}">
                    <div class="card-body">
                        <h2 class="mb-4 text-light">  <i class='bx bx-bar-chart-alt me-3'></i><span>{{__('count_visitors')}}</span></h2>
                        <h2 class="mb-4 text-white"> {{$count_visitors}}</h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
        <div class="col-md-4">
            <div class="card bg-danger border-danger text-white-50">
                <a href="{{route('socials.index')}}">
                    <div class="card-body">
                        <h2 class="mb-4 text-white"> <i class='bx bx-hash me-3'></i><span>{{__('social_media')}}</span></h2>
                        <h2 class="mb-4 text-white">{{$count_social_media}}</h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
        <div class="col-md-4">
            <div class="card bg-secondary border-secondary text-white-50">
                <a href="{{route('contact_us.index')}}">
                    <div class="card-body">
                        <h2 class="mb-4 text-white">  <i class='bx bxs-chat me-3'></i><span>{{__('contact_messages')}}</span></h2>
                        <h2 class="mb-4 text-white">{{$count_contact}}</h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
    </div><!-- end row -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary border-primary text-white-50">
                <a href="">
                    <div class="card-body">
                        <h2 class="mb-4 text-white">  <i class='bx bx-purchase-tag me-3'></i> <span></span></h2>
                        <h2 class="mb-4 text-white"> </h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
        <div class="col-md-4">
            <div class="card bg-info border-info text-white-50">
                <a href="">
                    <div class="card-body">
                        <h2 class="mb-4 text-white"><i class='bx bx-user-pin me-3'></i><span></span></h2>
                        <h2 class="mb-4 text-white"> </h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
        <div class="col-md-4">
            <div class="card bg-success border-success text-white-50">
                <a href="">
                    <div class="card-body">
                        <h2 class="mb-4 text-white">  <i class='bx bx-git-branch me-3'></i><span></span></h2>
                        <h2 class="mb-4 text-white"></h2>
                    </div><!-- end card-body -->
                </a>
            </div><!-- end card -->
        </div><!-- end col-md-4 -->
    </div>
    <!-- end row -->
@endsection
@section('script')

@endsection
