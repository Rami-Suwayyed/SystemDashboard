@extends('layouts.master')
@section('title')
    {{__('languages')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("languages.index")}}">{{__('languages')}}</a> @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url()->previous() }}">
                        <i class="fa fa-arrow-circle-left fa-2xl fs-2" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (count($errors) > 0)
                            <div  class="is-invalid">
                                <ul>
                                    @foreach ($errors->all() as $key => $error)
                                        <li>
                                            <span style="color: red">{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-xl-12 mt-4">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('create')}}</h5>

                            <form method="Post" action="{{route("languages.store")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mt-2">
                                            <label for="name">{{__('name')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-2">
                                            <label for="code">{{__('code')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="code" placeholder="Enter code" name="code" value="{{ old('code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-2">
                                            <label for="direction">{{__('direction')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="direction" placeholder="Enter direction" name="direction" value="{{ old('direction') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-3 mt-3 justify-content-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light w-md">{{__('save')}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
