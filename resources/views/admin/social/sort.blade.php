@extends('layouts.master')
@section('title')
    {{__('social_media')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset("assets/css/sort.css")}}">
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("socials.index")}}">{{__('social_media')}}</a> @endslot
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
                <form action="{{route("sort.social_media")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 m-auto">
                            <ul id="sortable">
                                @foreach($socials as $social)
                                    <li class="ui-state-default">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        <span class="text"><i class="fas fa-sort"></i>{{$social->name }}</span>
                                        <input type="hidden" name="sort[]" value="{{$social->sort}}" id="Sort">
                                        <input type="hidden" name="social[]" value="{{$social->id}}">
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
