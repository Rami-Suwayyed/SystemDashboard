@extends('layouts.master')
@section('title')
    {{__('profile')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title')  {{__('profile')}} @endslot
        @slot('title')  <a href="{{route("profile.index")}}">{{__('profile')}}</a> / {{__('edit')}} @endslot
    @endcomponent
<div class="row">
    <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
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

                        <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method("put")
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <label class="control-label" for="name">{{__("name")}}</label>
                                        <input type="text" class="form-control form-control-lg @if($errors->has('name')) is-invalid @endif"  id="name" name="name" placeholder="{{__("enter_name")}}" value="{{$admin->name}}">
                                    </div>
                                    @error("name")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <label class="control-label" for="username">{{__('username')}}</label>
                                        <input type="text" class="form-control form-control-lg @if($errors->has('username')) is-invalid @endif"  id="username" name="username"  placeholder="{{__("enter_username")}}"  value="{{$admin->username}}" >
                                    </div>
                                    @error("username")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mt-2">
                                        <label class="control-label" for="email">{{__("email")}}</label>
                                        <input type="email" class="form-control form-control-lg @if($errors->has('email')) is-invalid @endif"  id="email" name="email" placeholder="example : example@example.com" value="{{$admin->email}}">
                                    </div>
                                    @error("email")
                                    <div class="input-error">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 " style="min-height: 250px">
                                <div class="col-md-4">
                                        <div class="mt-2">
                                        <label class="control-label">{{__("image")}}</label>
                                        <div>
                                            <button class="btn btn-primary form-control form-control-lg button-upload-file" >
                                                <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images" type="file"  accept="image/*" name="image">
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
                                        @if($admin->image)
                                            <div class="img-container " id="trash-{{$admin->image->id }}">
                                                <img class="rounded" width="100" src="{{  $admin->image->url  }}" alt="{{$admin->image->filename}}">
                                                <a href="#" class="btn-outline-danger text-danger m-3 MediaTrash"  data-url="{{route("ajax.media.destroy", ['id'=>$admin->image->id])}}"  data-id="{{$admin->image->id}}"  title='Delete'><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-3 mt-3 justify-content-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> {{__('update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
