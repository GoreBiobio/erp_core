@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Proyectos
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Filtro de Proyectos
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Solicitudes en Trámite</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Solicitud/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="1">
                        <div class="box-footer">
                            <button id="btn" class="btn btn-success pull-right">Filtrar Tramite</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Solicitudes en Archivo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Solicitud/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="2">
                        <div class="box-footer">
                            <button id="btn" class="btn btn-warning pull-right">Filtrar Archivo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
