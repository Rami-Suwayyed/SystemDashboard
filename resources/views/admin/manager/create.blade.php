@extends('layouts.master')
@section('title')
    {{__('managers')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("managers.index")}}">{{__('managers')}}</a> @endslot
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

                            <form method="Post" action="{{route("managers.store")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="name">{{__('name')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name" placeholder="{{__('enter')}}{{__('name')}}" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="email">{{__('email')}}</label>
                                            <input type="email" class="form-control form-control-lg" id="email" placeholder="{{__('enter')}}{{__('email')}}" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-2">
                                            <label for="roles" >{{__("roles")}}</label>
                                            <select class="form-control form-control-lg" id="floatingSelectGrid" aria-label="{{ __('role') }}" name="role">
                                                <option selected="" disabled>{{__('open_this_select')}}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if(old("role")) {{selected("role", $role->id)}} @endif >{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error("role")
                                        <div class="input-error">{{$message}}</div>
                                        @enderror
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

@endsection
