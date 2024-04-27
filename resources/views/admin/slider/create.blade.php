@extends('layouts.master')
@section('title')
    {{__('sliders')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("sliders.index")}}">{{__('sliders')}}</a> @endslot
    @endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}"><i class="fa fa-arrow-circle-left fa-2xl fs-2" aria-hidden="true"></i></a>
            </div>
            <div class="card-body">
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
                    <form method="post" action="{{route("sliders.store")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @foreach($languages as $language)
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <label for="title_{{$language->name}}">{{__('title')}} {{$language->name}}</label>
                                        <input type="text" class="form-control form-control-lg" id="title_{{$language->name}}" placeholder="{{__('enter')}} {{__('title')}} {{$language->name}}" name="title[{{$language->code}}]" value="{{ old('title.'.$language->code) }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach($languages as $language)
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <label for="{{__('description')}} {{$language->name}}">{{__('description')}} {{$language->name}}</label>
                                        <textarea  class="editor" id="{{__('description')}}_{{$language->name}}"  name="description[{{$language->code}}]">{!!  old('description.'.$language->code) !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-3 " style="min-height: 250px">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">{{__("image")}}<code> *</code></label>
                                    <div>
                                        <button class="btn btn-primary form-control button-upload-file" >
                                            <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images"  accept="image/*" type="file" name="image">
                                            <span class="upload-file-content">
                                                <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                <span class="upload-file-content-text">{{__("upload_photo")}}</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                @error("image")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                                <div class="uploaded-images mt-5">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-3 mt-3 justify-content-end">
                            <button type="submit" class="btn btn-primary waves-effect waves-light w-md">{{__('save')}}</button>
                        </div><!-- end col -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- end row -->
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>--}}

    <!-- App js -->
    <script src="{{ asset('assets/js/ckeditor_editor.js')}}"></script>
@endsection
