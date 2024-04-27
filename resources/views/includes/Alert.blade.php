@php $messageName = $messageName ?? "page-message";@endphp
@if(\Illuminate\Support\Facades\Session::has($messageName))
    @php $data = \Illuminate\Support\Facades\Session::get($messageName);@endphp
        <div class="alert alert-border alert-border-{{$data["type"]}} alert-dismissible fade show" role="alert">
            @switch($data["type"])
                @case('success')
                    <i class="uil uil-check font-size-16 text-success me-2"></i>
                    @break
                @case('danger')
                    <i class="uil uil-exclamation-octagon font-size-16 text-danger me-2"></i>
                    @break
                @default
                    <i class="uil uil-exclamation-triangle font-size-16 text-warning me-2"></i>
            @endswitch
            <strong class="alert-heading">{{$data["title"]}}</strong>! {{$data["body"]}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

            </button>
    </div>

@endif
