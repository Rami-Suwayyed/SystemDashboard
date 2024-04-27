@extends('layouts.master')
@section('title')
    {{__('abouts')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset("assets/css/sort.css")}}">
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
                <a href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-circle-left fa-2xl fs-2" aria-hidden="true"></i>
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route("sort.abouts")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 m-auto">
                            <ul id="sortable">
                                @foreach($abouts as $about)
                                    <li class="ui-state-default">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <span class="text"><i class="fas fa-sort"></i>{{$about->title}}</span>
                                        <input type="hidden" name="sort[]" value="{{$about->sort}}" id="Sort">
                                        <input type="hidden" name="about[]" value="{{$about->id}}">
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
