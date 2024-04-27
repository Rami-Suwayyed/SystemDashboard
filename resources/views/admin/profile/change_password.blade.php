@extends('layouts.master')
@section('title')
    {{__('profile')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title')  {{__('profile')}} @endslot
        @slot('title') <a href="{{route("profile.index")}}">{{__('profile')}}</a> / {{__('change_password')}} @endslot
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
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('change_password')}}</h5>

                            <form method="post" action="{{route('profile.change_password.update')}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="current_password" >{{__('current_password')}}</label>
                                            <div class="input-group mb-3">
                                                <input  type="password" class="form-control form-control-lg password"  id="current_password" name="current_password" placeholder="{{__('enter')}} {{__('current_password')}}" autocomplete="off">
                                                <span class="input-group-text togglePassword" id="">
                                               <i class="fa fa-eye eye" aria-hidden="true"></i>
                                          </span>
                                            </div>
                                        </div>
                                        @error("current_password")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="password" >{{__('password')}}</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control form-control-lg password "  id="password" name="password" placeholder="{{__('enter')}} {{__('password')}}" autocomplete="off">
                                                <span class="input-group-text togglePassword" id="">
                                              <i class="fa fa-eye eye" aria-hidden="true"></i>
                                          </span>
                                            </div>
                                        </div>
                                        @error("password")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label class="control-label" for="password_confirmation">{{__("password_confirmation")}}</label>
                                            <div class="input-group mb-3">
                                                <input type="password"  class="form-control form-control-lg  password" id="password_confirmation" name="password_confirmation" placeholder="{{__('enter')}} {{__('password_confirmation')}}" autocomplete="off">
                                                <span class="input-group-text togglePassword" id="">
                                             <i class="fa fa-eye eye" aria-hidden="true"></i>
                                          </span>
                                            </div>
                                        </div>
                                        @error("password_confirmation")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <br>
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
