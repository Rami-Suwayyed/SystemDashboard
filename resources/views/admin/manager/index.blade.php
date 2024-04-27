@extends('layouts.master')
@section('title')
    {{__('managers')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("managers.index")}}">{{__('managers')}}</a> @endslot
    @endcomponent
    <!-- end row -->
    @if(session()->has("Manager_register_info"))
        @include("admin.manager.register_info", ["manager" => session()->get("Manager_register_info")])
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
                        <a href="{{route("managers.create")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table table-primary">
                            <tr>
                                <th>#{{__("id")}}</th>
                                <th>{{__("name")}}</th>
                                <th>{{__("username")}}</th>
                                <th>{{__("role")}}</th>
                                <th>{{__("email")}}</th>
                                <th>{{__("email verified")}}</th>
                                <th>{{__("activation")}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($managers as $manager)
                                <tr>
                                    <td>{{$manager->id}}</td>
                                    <td>{{$manager->name}}</td>
                                    <td>{{$manager->username}}</td>
                                    <td>{{$manager->role->name}}</td>
                                    <td>{{$manager->email}}</td>
                                    <td>
                                        @if(!empty($manager->email_verified_at))
                                            <span class=" btn btn-success btn-rounded waves-effect waves-light">{{__('activated')}}</span>
                                        @else
                                            <a href="{{route("SendEmail", ["id"=>$manager->id])}}" class="btn btn-danger"><i class="fa fa-envelope"></i> {{__("Activation")}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="toggle-flip changes-status">
                                            <label>
                                                <input type="checkbox" class="changes-status" onclick="changesStatus()" data-url="{{route("ajax.change_status")}}" id="{{$manager->id}}}" data-status-type="manager" {{old('status',$manager->status) ? 'checked' : '' }} data-id="{{$manager->id}}"><span class="flip-indecator" data-toggle-on="{{__("active")}}" data-toggle-off="{{__("inactive")}}"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <a href="{{route("managers.edit", $manager->id)}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{route("managers.destroy", $manager->id)}}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <span href="#" class="text-danger remove show_confirm" data-toggle="tooltip" title='Delete'><i class="far fa-trash-alt"></i></span>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">{{ __('no_data_found') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($managers->hasPages())
                        <div class="align-items-center justify-content-end">
                            {{ $managers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
    @if(session()->has("Manager_register_info"))
        <script>
            $("#Register").modal('show')
        </script>
    @endif
    <script type="module" src="{{asset("assets/js/pages/managers.js")}}"></script>

    <script type="text/javascript">
        function changesStatus() {
            $(".changes-status").change(function () {
                var value = $(this).prop('checked') === true ? 1 : 0;
                var id = $(this).data('id');
                var url = $(this).data('url');
                var status_type = $(this).data('status-type');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    data: {'value': value, 'id': id, 'type': status_type},
                    success: function (data) {
                        console.log(data.success)
                        // toastr.success(data.success)
                    }
                });
            })
        }
        $(document).ready(function () {
            changesStatus();
        });
    </script>
@endsection
