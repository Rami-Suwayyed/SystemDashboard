@extends('layouts.master')
@section('title')
    {{__('languages')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("languages.index")}}">{{__('languages')}}</a> @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
                        <a href="{{route("languages.create")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> {{__('create')}}</a>
                        <a href="{{route("sort.view.languages")}}" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-sort"></i> {{__("sort")}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>#{{__('id')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('code')}}</th>
                                <th>{{__('direction')}}</th>
                                <th>{{__('sort')}}</th>
                                <th>{{__('status')}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                           @forelse($languages as $language)
                               <tr>
                                   <th scope="row">{{$language->id}}</th>
                                   <td>{{$language->name}}</td>
                                   <td>{{$language->code}}</td>
                                   <td>{{$language->direction}}</td>
                                   <td>{{$language->sort}}</td>
                                   <td>@if($language->status) <span class=" btn btn-success btn-rounded waves-effect waves-light">{{__('active')}}</span>@else  <span class=" btn btn-danger btn-rounded waves-effect waves-light">{{__('inactive')}}</span> @endif</td>
                                   <td>
                                       <div class="d-flex align-items-center gap-3">
                                           @if($language->code != 'en')
                                               <a href="{{route("languages.edit", $language->id)}}" class="text-success  edit"><i class="fas fa-edit"></i></a>
                                               <form method="POST" action="{{route("languages.destroy", $language->id)}}">
                                                   @csrf
                                                   <input name="_method" type="hidden" value="DELETE">
                                                   <span href="#" class="text-danger remove show_confirm" data-toggle="tooltip" title='Delete'><i class="far fa-trash-alt"></i></span>
                                               </form>
                                           @endif
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

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
