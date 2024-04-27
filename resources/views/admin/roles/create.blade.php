@extends('layouts.master')
@section('title')
    {{__('roles')}}
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.css') }}">
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

                            <form method="Post" action="{{route("roles.store")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="name_english">{{__('name_english')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name_english" placeholder="Enter name" name="name[en]" value="{{ old('name.en') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="name_arabic">{{__('name_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="name_arabic" placeholder="Enter name" name="name[ar]" value="{{ old('name.ar') }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="table-responsive">
                                        <table class="table mb-0 permissionTable">
                                            <thead class="table-light">
                                            <tr>
                                                <th>{{__('collection')}}</th>
                                                <th>
                                                    <input class="grand_selectall" type="checkbox">
                                                    {{__('select_all')}}
                                                </th>
                                                <th>{{__('create')}}</th>
                                                <th>{{__('delete')}}</th>
                                                <th>{{__('update')}}</th>
                                                <th>{{__('read')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($permissions as $key => $group)
                                                <tr>
                                                    <td>
                                                        <b>{{  ucfirst(str_replace('_',' ',$key)) }}</b>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input class="selectall" type="checkbox">
                                                            {{__('Select All') }}
                                                        </label>
                                                    </td>
                                                    @forelse($group as $permission)
                                                        <td>
                                                            <label style="width: 30%" class="">
                                                                <input name="permissions[]" class="permissioncheckbox rounded-md border" type="checkbox" value="{{ $permission->id }}">
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
                                        <hr>
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
    </div><!-- end row -->
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

        function selectall(){

            $('.selectall').each(function (i) {

                var allchecked = new Array();

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

        function calcu_allchkbox(){

            var allchecked = new Array();

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

            var allchecked = new Array;

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
