<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/waypoints/waypoints.min.js')}}"></script>
<script src="{{ URL::asset('/assets/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>
<script src="{{ URL::asset('/assets/js/pages/fontawesome.init.js') }}"></script>
<script type="module" src="{{asset("assets/js/master.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
@yield('script')

<!-- App js -->
<script src="{{ URL::asset('/assets/js/app.min.js')}}"></script>

@yield('script-bottom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}

<script type="text/javascript">
    $(function () {
        $(".MediaTrash").click(function () {
            event.preventDefault();
            var id = $(this).attr('data-id');
            var url =  $(this).attr('data-url');
            var data = {
                _token: '{{ csrf_token() }}',
                id: id
            };
            // console.log(data);
            // console.log(url);
            // console.log(id)
            $.ajax({
                url: url,
                type: 'DELETE',
                data: data,
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $(`#trash-${response}`).remove();
                    }
                }
            });
        });
    });
</script>

