<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins 
<script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>-->

<!-- Page level custom scripts -->
<!-- <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script> -->

<script src="{{ asset ("/admin/js/jquery-ui.js") }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
        }
    });
    (function($) {
        $('.alert[data-auto-dismiss]').each(function (index, element) {
            var $element = $(element),
                timeout  = $element.data('auto-dismiss') || 5000;
            setTimeout(function () {
                $element.alert('close');
            }, timeout);
        });
    })(jQuery); // End of use strict
</script>
@yield('js')