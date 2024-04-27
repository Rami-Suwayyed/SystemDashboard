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

                            <form method="post" action="{{route("sliders.update",$slider->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <label for="title_{{$language->name}}">{{__('title')}} {{$language->name}}</label>
                                                <input type="text" class="form-control form-control-lg" id="title_{{$language->name}}" placeholder="{{__('enter')}} {{__('title')}} {{$language->name}}" name="title[{{$language->code}}]" value="{{ old('title.'.$language->code , $slider->getTranslation('title', $language->code)) }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    @foreach($languages as $language)
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <label for="{{__('description')}}_{{$language->name}}">{{__('description')}} {{$language->name}}</label>
                                                <textarea  class="editor" id="{{__('description')}}_{{$language->name}}"  name="description[{{$language->code}}]"> {!! old('description.'.$language->code , $slider->getTranslation('description', $language->code)) !!}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6">
                                        <div class="mt-2">
                                            <h5 class="font-size-14 mb-3">{{__('status')}}</h5>
                                            <div>
                                                <input type="checkbox" id="switch7" switch="info" @if(old('status',$slider->status)) checked @endif  name="status" />
                                                <label for="switch7" data-on-label="{{__('active')}}" data-off-label="{{__('inactive')}}"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="sort">{{__('sort')}}</label>
                                            <input type="number" class="form-control form-control-lg @if ($errors->has('sort')) is-invalid @endif" id="sort" min="1" name="sort" value="{{ old('sort',$slider->sort) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 " style="min-height: 250px">
                                    <div class="col-md-4">
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
                                        @if($slider->image)
                                            <div class="img-container " id="trash-{{$slider->image->id }}">
                                                <img class="rounded" width="100" src="{{  $slider->image->url  }}" alt="{{$slider->image->filename}}">
                                                <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$slider->image->id])}}"  data-id="{{$slider->image->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        @endif
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

    <script type="text/javascript">
        $(function () {
            $('#trash').click(function () {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var url =  $(this).attr('data-url');
                var data = {
                    _token: '{{ csrf_token() }}',
                    id: id
                };
                console.log(data);
                console.log(url);
                console.log(id)
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: data,
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            $('#trash').parent().remove();
                        }
                    }
                });
            });
        });

    </script>
@endsection
