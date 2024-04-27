@extends('layouts.master')
@section('title')
    {{__('roles')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("roles.index")}}">{{__('roles')}}</a> @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
                        <a href="{{route("roles.create")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table table-primary">
                            <tr>
                                <th>#{{__('id')}}</th>
                                <th>{{__("role_name")}}</th>
                                <th>{{__("Permissions")}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>

                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        <!-- Permission View Button -->
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal-{{$role->id}}"> {{__("view")}}</button>
                                    </td>
                                    <!-- sample modal content -->
                                    <div id="myModal-{{$role->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">{{__("permissions")}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach($role->permissions as $permission)
                                                        <span class="field-view">{{$permission->name}}</span>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <td>
                                        <a href="{{route("roles.edit", $role->id)}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{route("roles.destroy", $role->id)}}" method="post" id="delete{{$role->id}}" style="display: none" data-swal-title="{{__("Delete Role")}}" data-swal-text="{{__('Are Your Sure To Delete This Role?' )}}" data-yes="{{__('Yes')}}" data-no="{{__('No')}}" data-success-msg="{{__('the role has been deleted succssfully')}}" > @csrf @method("delete")</form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$role->id}}"><i class="far fa-trash-alt"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

@endsection
