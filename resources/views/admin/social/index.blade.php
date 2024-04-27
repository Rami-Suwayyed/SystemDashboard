@extends('layouts.master')
@section('title')
    {{__('social_media')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')  {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("socials.index")}}">{{__('social_media')}}</a> @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
                        <a href="{{route("socials.create")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>
                        <a href="{{route("sort.view.social_media")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-sort"></i> {{__("sort")}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>#{{__('id')}}</th>
                                <th>{{__('type')}}</th>
                                <th>{{__('link')}}</th>
                                <th>{{__('status')}}</th>
                                <th>{{__('sort')}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                           @forelse($socials as $social)
                               <tr>
                                   <th scope="row">{{$social->id}}</th>
                                   <td>{{$social->type}}</td>
                                   <td>{{$social->link}}</td>
{{--                                   <td>@if($social->status) <span class=" btn btn-success btn-rounded waves-effect waves-light">{{__('active')}}</span>@else  <span class=" btn btn-danger btn-rounded waves-effect waves-light">{{__('inactive')}}</span> @endif</td>--}}
                                   <td>
                                       <div class="toggle-flip changes-status">
                                           <label>
                                               <input type="checkbox" class="changes-status" onclick="changesStatus()" data-url="{{route("ajax.change_status")}}" id="{{$social->id}}}" data-status-type="social" {{old('status',$social->status) ? 'checked' : '' }} data-id="{{$social->id}}"><span class="flip-indecator" data-toggle-on="{{__("active")}}" data-toggle-off="{{__("inactive")}}"></span>
                                           </label>
                                       </div>
                                   </td>
                                   <td>{{$social->sort}}</td>
                                   <td>
                                       <div class="d-flex align-items-center gap-3">
                                           <a href="{{route("socials.edit", $social->id)}}" class="text-success  edit"><i class="fas fa-edit"></i></a>
                                           <form method="POST" action="{{route("socials.destroy", $social->id)}}">
                                               @csrf
                                               <input name="_method" type="hidden" value="DELETE">
                                               <span href="#" class="text-danger remove show_confirm" data-toggle="tooltip" title='Delete'><i class="far fa-trash-alt"></i></span>
                                           </form>
                                       </div>

                                   </td>

                               </tr>

                           @empty
                               <tr>
                                   <td colspan="4" class="text-center">{{ __('no_data_found') }}</td>
                               </tr>
                           @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($socials->hasPages())
                        <div class="align-items-center justify-content-end">
                            {{ $socials->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
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
