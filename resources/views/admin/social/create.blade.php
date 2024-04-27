@extends('layouts.master')
@section('title')
    {{__('social_media')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') {{__('social_media')}} @endslot
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

                            <form method="Post" action="{{route("socials.store")}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="floatingSelectGrid">{{ __('type') }}</label>
                                            <select class="form-control form-control-lg" id="floatingSelectGrid" aria-label="{{ __('type') }}" name="type">
                                                <option selected="" disabled>{{__('open_this_select')}}</option>
                                                <option value="youtube" @if(old('type') == 'youtube') selected @endif> {{__('youtube')}}</option>
                                                <option value="facebook" @if(old('type') == 'facebook') selected @endif > {{__('facebook')}}</option>
                                                <option value="twitter" @if(old('type') == 'twitter') selected @endif> {{__('twitter')}}</option>
                                                <option value="instagram" @if(old('type') == 'instagram') selected @endif> {{__('instagram')}}</option>
                                                <option value="snapchat" @if(old('type') == 'snapchat') selected @endif> {{__('snapchat')}}</option>
                                                <option value="linkedin" @if(old('type') == 'linkedin') selected @endif> {{__('linkedin')}}</option>
                                                <option value="tiktok" @if(old('type') == 'tiktok') selected @endif> {{__('tiktok')}}</option>
                                                <option value="pinterest" @if(old('type') == 'pinterest') selected @endif> {{__('pinterest')}}</option>
                                            </select>
                                        </div>
                                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <label for="link">{{__('link')}}<code> *</code></label>
                                            <input type="text" class="form-control form-control-lg" id="link" placeholder="Enter link" name="link" value="{{ old('link') }}">
                                        </div>
                                        @error('link')<span class="text-danger">{{ $message }}</span>@enderror
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
