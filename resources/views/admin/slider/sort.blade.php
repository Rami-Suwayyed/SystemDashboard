@extends('layouts.master')
@section('title')
    {{__('sliders')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset("assets/css/sort.css")}}">
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("sliders.index")}}">{{__('sliders')}}</a> @endslot
    @endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h1 class="m-0">{{__("sort")}}</h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route("sort.sliders")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 m-auto">
                            <ul id="sortable">
                                @foreach($sliders as $slider)
                                    <li class="ui-state-default">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <span class="text"><i class="fas fa-sort"></i>{{trim(strip_tags($slider->title) )}}</span>
                                        <input type="hidden" name="sort[]" value="{{$slider->sort}}" id="Sort">
                                        <input type="hidden" name="slider[]" value="{{$slider->id}}">
                                    </li>
                                @endforeach
                            </ul>
                            <hr>
                            <hr>
                        </div>
                    </div>
                    <button class="btn btn-primary" >{{__("save")}}</button>
                    </form>
                </div><!-- /.card-body -->
            </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div><!-- end row -->
<!-- end row -->
@endsection

@section('script')
    <script>
        $( function() {
            $( "#sortable" ).sortable({
                update: function( event, ui ) {
                    let count = 1
                    $("#sortable li input#Sort").each((index, el) => {
                        $(el).val(count)
                        count++;
                    })
                }
            });
        } );
    </script>
@endsection
