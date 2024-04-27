@extends('layouts.master')
@section('title')
    {{__('abouts')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("abouts.index")}}">{{__('abouts')}}</a> @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <h4>{{__('about_us_paragraphs')}}</h4>
                    </div>
                    <div class="text-end">
                        <a href="{{route("abouts.create")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>
                        <a href="{{route("sort.view.abouts")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-sort"></i> {{__("sort")}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table table-primary">
                            <tr>
                                <th>#{{__('id')}}</th>
                                <th>{{__('title')}}</th>
                                <th>{{__('icon')}}</th>
                                <th>{{__('description')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('sort')}}</th>
                                <th>{{__('status')}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($abouts as $about)
                                <tr>
                                    <th scope="row">{{$about->id}}</th>
                                    <td>{{$about->title}}</td>
                                    <td>
                                        @if($about->icon)
                                            <img class="rounded me-2"  width="100" src="{{ $about->icon->url }}" data-holder-rendered="true" alt="{{ $about->icon->filename}}"></td>
                                        @endif
                                    <td>{!!  Str::limit($about->description , 500, ' ...') !!}</td>
                                    <td>
                                        @if($about->image)
                                            <img class="rounded me-2" width="100" src="{{  $about->image->url  }}" data-holder-rendered="true"  alt="{{ $about->image->filename}}"></td>
                                        @endif
                                    <td>{{$about->sort}}</td>
{{--                                    <td>@if($about->status) <span class=" btn btn-success btn-rounded waves-effect waves-light">{{__('active')}}</span>@else  <span class=" btn btn-danger btn-rounded waves-effect waves-light">{{__('inactive')}}</span> @endif</td>--}}
                                    <td>
                                        <div class="toggle-flip changes-status">
                                            <label>
                                                <input type="checkbox" class="changes-status" onclick="changesStatus()" data-url="{{route("ajax.change_status")}}" id="{{$about->id}}}" data-status-type="about" {{old('status',$about->status) ? 'checked' : '' }} data-id="{{$about->id}}"><span class="flip-indecator" data-toggle-on="{{__("active")}}" data-toggle-off="{{__("inactive")}}"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <a href="{{route("abouts.edit", $about->id)}}" class="text-success  edit"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{route("abouts.destroy", $about->id)}}">
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
                    @if ($abouts->hasPages())
                        <div class="align-items-center justify-content-end">
                            {{ $abouts->links() }}
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
