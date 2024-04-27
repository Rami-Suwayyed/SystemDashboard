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
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('edit')}}</h5>

                            <form method="post" action="{{route("abouts.update",$about->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_english">{{__('title_english')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_english"  placeholder="{{__('enter_title_english')}}" value="{{ old('title.en',$about->getTranslation('title', 'en')) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_arabic">{{__('title_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_arabic" placeholder="{{__('enter_title_arabic')}}" name="title[ar]" value="{{ old('title.ar',$about->getTranslation('title', 'ar')) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="editor">{{__('description_english')}}</label>
                                            <textarea  id="editor"  rows="5" name="description[en]">{{ old('description.en' , $about->getTranslation('description', 'en')) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="editor_arabic">{{__('description_arabic')}}</label>
                                            <textarea id="editor_arabic" rows="5" name="description[ar]">{{ old('description.ar',$about->getTranslation('description', 'ar')) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <h5 class="font-size-14 mb-3">{{__('status')}}</h5>
                                        <div>
                                            <input type="checkbox" id="switch7" switch="info" {{old('status',$about->status) ? 'checked' : ''}} name="status" />
                                            <label for="switch7" data-on-label="{{__('active')}}" data-off-label="{{__('inactive')}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if(!($about->show_home || $about->doctor_word ))
                                        <div class="mt-2">
                                            <label for="sort">{{__('sort')}}</label>
                                            <input type="number" class="form-control form-control-lg @if ($errors->has('sort')) is-invalid @endif" id="sort" min="1" name="sort" value="{{ old('sort',$about->sort) }}">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-5">
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
                                            @if($about->image)
                                                <div class="img-container " id="trash-{{$about->image->id }}">
                                                    <img class="rounded" width="100" src="{{  $about->image->url  }}" alt="{{$about->image->filename}}">
                                                    <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$about->image->id])}}"  data-id="{{$about->image->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            @endif
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
                                        @error("icon")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                        <div class="uploaded-icon mt-5">
                                            <div class="img-container" id="trash-{{$about->icon ? $about->icon->id : ''}}">
                                                @if($about->icon)
                                                    <img class="rounded"  src="{{$about->icon->url}}" alt="{{$about->icon->filename}}">
                                                    <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$about->icon->id])}}"  data-id="{{$about->icon->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                                @endif
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
