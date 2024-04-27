@extends('layouts.master')
@section('title')
    {{__('abouts')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("abouts.index")}}">{{__('abouts')}}</a> @endslot
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

                            <form method="Post" action="{{route("abouts.store")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_english">{{__('title_english')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_english" placeholder="{{__('enter_title_english')}}" name="title[en]" value="{{ old('title.en') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_arabic">{{__('title_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_arabic" placeholder="{{__('enter_title_arabic')}}" name="title[ar]" value="{{ old('title.ar') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="editor">{{__('description_english')}}</label>
                                            <textarea  id="editor"  name="description[en]">{!!  old('description.en') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="editor_arabic">{{__('description_arabic')}}</label>
                                            <textarea id="editor_arabic" name="description[ar]">{!!  old('description.ar') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3 " style="min-height: 250px">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__("image")}}</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{__("icon")}}</label>
                                                <div>
                                                    <button class="btn btn-primary form-control button-upload-file" >
                                                        <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-icon"  accept="image/*" type="file" name="icon">
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
                                            <div class="uploaded-icon mt-5">

                                            </div>
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

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/ckeditor_editor.js')}}"></script>
@endsection
