@extends('layouts.master')
@section('title')
    {{__('contact_us')}}
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') {{__('home_page')}} @endslot
        @slot('title') <a href="{{route("contact_us.index")}}">{{__('contact_us')}}</a> @endslot

    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> {{__('messages')}}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>#{{__('id')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('email')}}</th>
                                <th>{{__('phone_number')}}</th>
                                <th>{{__('company_name')}}</th>
                                <th>{{__('message')}}</th>
                                <th>{{__("control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                           @forelse($contact_us as $contact)
                               <tr>
                                   <td scope="row">{{$contact->id}}</td>
                                   <td>{{$contact->name}}</td>
                                   <td>{{$contact->email}}</td>
                                   <td>{{$contact->phone_number}}</td>
                                   <td>{{$contact->company_name}}</td>
                                   <td>{{$contact->message}}</td>
                                   <td>
                                       <div class="d-flex align-items-center gap-3">
                                           <form method="POST" action="{{route("contact_us.destroy", $contact->id)}}">
                                               @csrf
                                               <input name="_method" type="hidden" value="DELETE">
                                               <span href="#" class="text-danger remove show_confirm" data-toggle="tooltip" title='Delete'><i class="far fa-trash-alt"></i></span>
                                           </form>
                                       </div>

                                   </td>

                               </tr>
                           @empty
                               <tr>
                                   <td colspan="7" class="text-center">{{ __('no_data_found') }}</td>
                               </tr>
                           @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($contact_us->hasPages())
                        <div class="align-items-center justify-content-end">
                            {{ $contact_us->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
