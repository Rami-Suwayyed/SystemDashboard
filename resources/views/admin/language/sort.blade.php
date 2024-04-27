@extends('layouts.master')
@section('title')
    {{__('languages')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset("assets/css/sort.css")}}">
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
                <a href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-circle-left fa-2xl fs-2" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{route("sort.languages")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 m-auto">
                            <ul id="sortable">
                                @foreach($languages as $language)
                                    <li class="ui-state-default">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <span class="text"><i class="fas fa-sort"></i>{{$language->name }}</span>
                                        <input type="hidden" name="sort[]" value="{{$language->sort}}" id="Sort">
                                        <input type="hidden" name="language[]" value="{{$language->id}}">
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
