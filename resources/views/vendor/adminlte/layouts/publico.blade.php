<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<br><br>
<div id="app">
    @yield('main-content')
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts_calendar')
@show

</body>
</html>
