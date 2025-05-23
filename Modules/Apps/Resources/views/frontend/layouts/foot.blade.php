<!-- Core -->
<script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('frontend/vendor/popper/popper.min.js')}}"></script>
<script src="{{asset('frontend/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/vendor/headroom/headroom.min.js')}}"></script>
<!-- Optional JS -->
<script src="{{asset('frontend/vendor/onscreen/onscreen.min.js')}}"></script>
<script src="{{asset('frontend/vendor/nouislider/js/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Argon JS -->
<script src="{{asset('frontend/js/argon.js?v=1.1.0')}}"></script>

<script src="{{asset('inspina/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>

    @if( session()->get('success'))

    swal({
        title: "success!",
        text: '{{session('success')}}',
        type: "success",
        confirmButtonText: "OK"
    });


    @elseif(session()->get('fail'))

    swal({
        title: "Fail!",
        text: '{{session('fail')}}',
        type: "error",
        confirmButtonText: "OK"
    });

    @endif

</script>
@yield('script')
</body>

</html>


{{--UPLOAD--}}