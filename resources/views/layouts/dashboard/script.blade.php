<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="{{ asset('assets/vendors/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/scrollbar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/vendors/scrollbar/custom.js') }}"></script>
<script src="{{asset('assets/vendors/aos/aos.js')}}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
        $(".according-menu.other" ).css( "display", "none" );
        $(".sidebar-submenu" ).css( "display", "block" );
    }

    feather.replace()
    AOS.init();
</script>
