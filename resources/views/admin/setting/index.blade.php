@extends('layouts.master')
@section('title')
    {{__('settings')}}
@endsection

@section('css')
    /*<!-- plugin css -->*/
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.css') }}">

@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("settings.index")}}">{{__('settings')}}</a> @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
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

                            <form method="post" action="{{route("settings.update",$setting->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label" for="site_name">{{__('site_name')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="site_name"  placeholder="{{__('enter_site_name')}}" name="site_name" value="{{ old('site_name',$setting->site_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label" for="phone_number">{{__('phone_number')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="phone_number" placeholder="{{__('enter_phone')}}" name="phone_number" value="{{ old('phone_number',$setting->phone_number) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label"  for="email">{{__('email')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="email" placeholder="{{__('enter_email')}}" name="email" value="{{ old('email',$setting->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label"  for="address">{{__('address')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="address" placeholder="{{__('enter_address')}}" name="address" value="{{ old('address',$setting->address) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label"  for="colorpicker-showintial">{{__('main_color')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="colorpicker-showintial" name="main_color" value="{{ old('main_color',$setting->main_color) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="form-label"  for="colorpicker-showinput-intial">{{__('secondary_color')}}</label>
                                            <input class="form-control form-control-lg" type="text" id="colorpicker-showinput-intial" name="secondary_color" value="{{ old('secondary_color',$setting->secondary_color) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("fav_icon")}}</label>
                                            <div>
                                                <button class="btn btn-primary form-control button-upload-file" >
                                                    <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images"  accept="fav_icon/*" type="file" name="fav_icon">
                                                    <span class="upload-file-content">
                                                        <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                        <span class="upload-file-content-text">{{__("upload_photo")}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        @error("fav_icon")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                        <div class="uploaded-images  mt-5">
                                            @if($setting->fav_icon)
                                                <div class="img-container " id="trash-{{$setting->fav_icon->id }}">
                                                    <img class="rounded" width="100"  src="{{  $setting->fav_icon->url  }}" alt="{{$setting->fav_icon->filename}}">
                                                    <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$setting->fav_icon->id])}}"  data-id="{{$setting->fav_icon->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("header_icon")}}</label>
                                            <div>
                                                <button class="btn btn-primary form-control button-upload-file" >
                                                    <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-logo"  accept="fav_icon/*" type="file" name="header_icon">
                                                    <span class="upload-file-content">
                                                        <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                        <span class="upload-file-content-text">{{__("upload_photo")}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        @error("header_icon")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror

                                        <div class="uploaded-logo mt-5">
                                            @if($setting->header_icon)
                                                <div class="img-container " id="trash-{{$setting->header_icon->id }}">
                                                    <img class="rounded"  width="100" src="{{  $setting->header_icon->url  }}" alt="{{$setting->header_icon->filename}}">
                                                    <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$setting->header_icon->id])}}"  data-id="{{$setting->header_icon->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__("footer_icon")}}</label>
                                            <div>
                                                <button class="btn btn-primary form-control button-upload-file" >
                                                    <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-caver"  accept="fav_icon/*" type="file" name="footer_icon">
                                                    <span class="upload-file-content">
                                                        <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                        <span class="upload-file-content-text">{{__("upload_photo")}}</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        @error("footer_icon")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                        <div class="uploaded-caver mt-5">
                                            @if($setting->footer_icon)
                                                <div class="img-container " id="trash-{{$setting->footer_icon->id }}">
                                                    <img class="rounded" width="100"  src="{{  $setting->footer_icon->url  }}" alt="{{$setting->footer_icon->filename}}">
                                                    <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$setting->footer_icon->id])}}"  data-id="{{$setting->footer_icon->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            @endif
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(e) {--}}
{{--        function addQuestion(){--}}
{{--        var useful_link = $('#useful_link-template').clone();--}}
{{--        useful_link.css("display","block").removeAttr('id');--}}
{{--        $('#useful_link').append(useful_link);--}}
{{--        }--}}

{{--        function renameQuestions(){--}}
{{--        $('.useful_link-box').each(function(i,v){--}}
{{--        $(this).find('.useful_link_id').html(i);--}}
{{--        });--}}
{{--        }--}}

{{--        $('#add-useful_link').on('click', function() {--}}
{{--        addQuestion();--}}
{{--        renameQuestions();--}}
{{--        });--}}

{{--        $(document).on('click','.del-useful_link', function()--}}
{{--        {--}}
{{--        $(this).closest('.useful_link-box').remove();--}}
{{--        renameQuestions();--}}
{{--        });--}}
{{--        });--}}
{{--    </script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
@endsection
