@extends('layouts.master')
@section('title')
    {{__('roles')}}
@endsection


@section('css')

@endsection


@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            {{__('home_page')}}
        @endslot
        @slot('title')
            <a href="{{route("roles.index")}}">{{__('roles')}}</a>
        @endslot
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
                            <div class="is-invalid">
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
                            <h5 class="font-size-14 mb-4"><i
                                    class="mdi mdi-arrow-right text-primary me-1"></i> {{__('edit')}}</h5>

                            <form method="post" action="{{route("roles.update",$role->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="name_english">{{__('name_english')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name_english"
                                                   placeholder="{{__('enter_name_english')}}" name="name[en]"
                                                   value="{{ old('name.en',$role->getTranslation('name', 'en')) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="name_arabic">{{__('name_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name_arabic"
                                                   placeholder="{{__('enter_name_arabic')}}" name="name[ar]"
                                                   value="{{ old('name.ar',$role->getTranslation('name', 'ar')) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped mb-0 permissionTable">
                                            <thead class="table-dark">
                                            <tr>
                                                <th scope="col">{{__('collection')}}</th>
                                                <th scope="col">
                                                    <input class="grand_selectall" type="checkbox">
                                                    {{__('select_all')}}
                                                </th>
                                                <th scope="col">{{__('create')}}</th>
                                                <th scope="col">{{__('delete')}}</th>
                                                <th scope="col">{{__('update')}}</th>
                                                <th scope="col">{{__('read')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($permissions as $key => $group)
                                                <tr>
                                                    <th scope="row">
                                                        <b>{{  ucfirst(str_replace('_',' ',$key)) }}</b>
                                                    </th>
                                                    <td>
                                                        <label>
                                                            <input class="selectall" type="checkbox">
                                                            {{__('Select All') }}
                                                        </label>
                                                    </td>
                                                    @forelse($group as $permission)
                                                        <td>
                                                            <label style="width: 30%" class="">
                                                                <input name="permissions[]"
                                                                       class="permissioncheckbox rounded-md border"
                                                                       {{ $role->permissions->contains('id',$permission->id) ? "checked" : "" }} type="checkbox"
                                                                       value="{{ $permission->id }}">
                                                            </label>
                                                        </td>
                                                    @empty
                                                        {{ __("No permission in this group !") }}
                                                    @endforelse
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-3 mt-3 justify-content-end">
                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-light w-md">{{__('save')}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>

        $(".permissionTable").on('click', '.selectall', function () {

            if ($(this).is(':checked')) {
                $(this).closest('tr').find('[type=checkbox]').prop('checked', true);

            } else {
                $(this).closest('tr').find('[type=checkbox]').prop('checked', false);

            }

            calcu_allchkbox();

        });

        $(".permissionTable").on('click', '.grand_selectall', function () {
            if ($(this).is(':checked')) {
                $('.selectall').prop('checked', true);
                $('.permissioncheckbox').prop('checked', true);
            } else {
                $('.selectall').prop('checked', false);
                $('.permissioncheckbox').prop('checked', false);
            }
        });

        $(function () {

            calcu_allchkbox();
            selectall();

        });

        function selectall() {

            $('.selectall').each(function (i) {

                var allchecked = [];

                $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
                    if ($(this).is(":checked")) {
                        allchecked.push(1);
                    } else {
                        allchecked.push(0);
                    }
                });

                if ($.inArray(0, allchecked) != -1) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }

            });
        }

        function calcu_allchkbox() {

            var allchecked = [];

            $('.selectall').each(function (i) {


                $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
                    if ($(this).is(":checked")) {
                        allchecked.push(1);
                    } else {
                        allchecked.push(0);
                    }
                });


            });

            if ($.inArray(0, allchecked) != -1) {
                $('.grand_selectall').prop('checked', false);
            } else {
                $('.grand_selectall').prop('checked', true);
            }

        }


        $('.permissionTable').on('click', '.permissioncheckbox', function () {

            var allchecked = [];

            $(this).closest('tr').find('.permissioncheckbox').each(function (index) {
                if ($(this).is(":checked")) {
                    allchecked.push(1);
                } else {
                    allchecked.push(0);
                }
            });

            if ($.inArray(0, allchecked) != -1) {
                $(this).closest('tr').find('.selectall').prop('checked', false);
            } else {
                $(this).closest('tr').find('.selectall').prop('checked', true);

            }

            calcu_allchkbox();

        });

    </script>
@endsection
