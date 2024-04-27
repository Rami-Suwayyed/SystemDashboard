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
                    <h4 class="card-title">{{__('language')}}</h4>
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
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('edit')}} </h5>

                            <form method="post" action="{{route("languages.update",$language->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_arabic">{{__('title_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_arabic" placeholder="Enter name" name="name" value="{{ old('name',$language->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="code">{{__('code')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="code" placeholder="Enter code" name="code" value="{{ old('code',$language->code) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="direction">{{__('direction')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="direction" placeholder="Enter direction" name="direction" value="{{ old('direction',$language->direction) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-2">
                                            <label for="sort">{{__('sort')}}</label>
                                            <input type="number" class="form-control form-control-lg @if ($errors->has('sort')) is-invalid @endif" id="sort" min="1" name="sort" value="{{ old('sort',$language->sort) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h5 class="font-size-14 mb-3">{{__('status')}}</h5>
                                        <div>
                                            <input type="checkbox" id="switch7" switch="info" @if(old('status',$language->status) == '1') checked @endif  name="status" />
                                            <label for="switch7" data-on-label="{{__('active')}}" data-off-label="{{__('inactive')}}"></label>
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
