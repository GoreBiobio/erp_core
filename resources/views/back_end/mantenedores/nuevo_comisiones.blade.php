@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Comisiones
@endsection
@section('contentheader_title')
    Comisiones
@endsection
@section('contentheader_description')
    Mantenedor de Comisiones
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Comisión</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Comisiones/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-8">
                                <label for="rut"><strong>Nombre de la Comisión</strong></label>
                                <input class="form-control" type="text" name="nombre_comision" required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nueva Comisión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Comisiones (Mantenedor de Solicitudes) - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Comisiones</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($comisiones as $comisiones)
                            <tr>
                                <td>{{ $comisiones -> nombreComisiones }}</td>
                                <td>@if($comisiones -> estadoComisiones == '1')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-circle-o"></i> Activa
                                        </button>
                                    @elseif($comisiones -> estadoComisiones== '2')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-circle-o"></i> Suspendida
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($comisiones -> estadoComisiones == '1')
                                        <form action="/Mantenedor/Comisiones/Suspender" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $comisiones -> idComisiones }}">
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-close"></i>
                                                Suspender
                                            </button>
                                        </form>
                                    @elseif($comisiones -> estadoComisiones== '2')
                                        <form action="/Mantenedor/Comisiones/Activar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $comisiones -> idComisiones }}">
                                            <button type="submit" class="btn btn-success btn-xs"><i
                                                    class="fa fa-check-circle-o"></i>
                                                Activar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
