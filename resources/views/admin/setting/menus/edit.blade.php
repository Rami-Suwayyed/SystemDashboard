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
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('edit')}}</h5>

                            <form method="post" action="{{route("menus.update", ['menu'=>$menu->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_english">{{__('title_english')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_english" placeholder="Enter title" name="title[en]" value="{{ old('title.en',$menu->getTranslation('title', 'en')) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="title_arabic">{{__('title_arabic')}}</label>
                                            <input type="text" class="form-control form-control-lg" id="title_arabic" placeholder="Enter title" name="title[ar]" value="{{ old('title.ar',$menu->getTranslation('title', 'ar')) }}">
                                        </div>
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
