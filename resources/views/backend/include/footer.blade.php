<footer class="main-footer no-print">
    <strong>Copyright &copy; {{ date('Y', time()) }} <a target="_blank" href="#">Web
            Care</a>.</strong> All rights reserved.
</footer>
<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/img_css/js/vendors.js')}}"></script>
<script src="{{ asset('public/img_css/js/aiz-core.js')}}"></script>
<script src="{{ asset('public/dashboard_css/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('public/dashboard_css/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/sparklines/sparkline.js') }}"></script>
{{-- <script src="{{ asset('dashboard_css/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('dashboard_css/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<script src="{{ asset('public/dashboard_css/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<script src="{{ asset('public/dashboard_css/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
</script>
<script src="{{ asset('public/dashboard_css/dist/js/adminlte.js') }}"></script>
{{-- <script src="{{ asset('dashboard_css/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- SweetAlert2 -->
<script src="{{ asset('public/dashboard_css/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('public/dashboard_css/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('public/dashboard_css/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function() {
        $('.select2').select2();
        $('.summernote').summernote()

        $(document).ready(function() {
            var success_message = "{{ Session::get('success') }}";
            var info_message = "{{ Session::get('info') }}";
            var error_message = "{{ Session::get('error') }}";
            var warning_message = "{{ Session::get('warning') }}";
            if (success_message != "") {
                success_alert(success_message);
            }
            if (info_message != "") {
                info_alert(info_message);
            }
            if (error_message != "") {
                error_alert(error_message)
            }
            if (warning_message != "") {
                warning_alert(warning_message)
            }
        });

        function success_alert(success_message) {
            toastr.success(success_message)
        }

        function info_alert(info_message) {
            toastr.info(info_message)
        }

        function error_alert(error_message) {
            toastr.error(error_message)
        }

        function warning_alert(warning_message) {
            toastr.warning(warning_message)
        }
    });
</script>
<link rel="stylesheet" href="{{ URL::asset('public/input_tag/tagsinput.css')  }}">
    <script src="{{ URL::asset('public/input_tag/tagsinput.js')  }}"></script>
