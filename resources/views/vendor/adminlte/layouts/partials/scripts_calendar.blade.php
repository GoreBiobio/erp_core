<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>

<script src="/js/moment_calendar.js"></script>
<script src="/js/calendar.js"></script>

<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>

<link rel="stylesheet"
      href="https://adminlte.io/themes/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet"
      href="https://adminlte.io/themes/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css"
      media="print">

{!! $calendar->script() !!}

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>


