@extends('layouts.master')
@section('title')
    {{__('profile')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("profile.index")}}">{{__('profile')}}</a> @endslot
    @endcomponent
<div class="row">
    <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="user-thumb text-center mb-4">
                    @if($admin->image)
                        <img class="rounded-circle img-thumbnail avatar-lg" width="100" src="{{  $admin->image->url  }}" alt="{{$admin->image->filename}}">
                    @else
                        <img src="{{ URL::asset('/assets/images/users/avatar-4.jpg') }}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                    @endif
                    <h3 class="profile-username text-center">{{$admin->name}}</h3>
                </div>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{__('email')}} : </b> <a class="float-right">{{$admin->email}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{__('role')}} : </b> <a class="float-right">{{$admin->user_role}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{__('role_type')}} : </b> <a class="float-right">{{$admin->role->name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{__('username')}} : </b> <a class="float-right">{{$admin->username}}</a>
                    </li>
                </ul>
                <div class="text-end">
                    <a href="{{route('profile.edit')}}" class="btn btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> <b> {{__('edit')}}</b></a>
                    <a href="{{route('profile.change_password')}}" class="btn btn-primary"><i class="fa fa-key" aria-hidden="true"></i> <b> {{__('change_password')}}</b></a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

@endsection
