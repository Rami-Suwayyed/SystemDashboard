@extends('layouts.master')
@section('title')
    {{__('menu')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("menus.index")}}">{{__('menu')}}</a> @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
{{--                        <a href="{{route("menus.create", ['product_id'=>$product->id])}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>--}}
                        <a href="{{route("sort.view.menus")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-sort"></i> {{__("sort")}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#{{__('id')}}</th>
                                    <th>{{__('title')}}</th>
                                    <th>{{__('sort')}}</th>
                                    <th>{{__("control")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                           @forelse($menus as $menu)
                               <tr>
                                   <th scope="row">{{$menu->id}}</th>
                                   <td>{{$menu->title}}</td>
                                   <td>{{$menu->sort}}</td>
                                   <td>
                                       <div class="d-flex align-items-center gap-3">
                                           <a href="{{route("menus.edit", [ 'menu'=>$menu->id])}}" class="text-success  edit"><i class="fas fa-edit"></i></a>
                                       </div>
                                   </td>
                               </tr>

                               <!--  Extra Large modal example -->
                               <div class="modal fade" id="bs-example-modal-xl-{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                   <div class="modal-dialog modal-xl">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="myExtraLargeModalLabel">{{$menu->title}}</h5>
                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               {!! $menu->description !!}
                                           </div>
                                           <div class="modal-footer">
{{--                                               <a href="" class="text-success  edit"><i class="fas fa-edit"></i></a>--}}
                                           </div>
                                       </div><!-- /.modal-content -->
                                   </div><!-- /.modal-dialog -->
                               </div><!-- /.modal -->
                           @empty
                               <tr>
                                   <td colspan="4" class="text-center">{{ __('no_data_found') }}</td>
                               </tr>
                           @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
