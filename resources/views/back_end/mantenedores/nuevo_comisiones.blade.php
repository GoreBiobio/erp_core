@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Comisiones / Sub Comisión
@endsection
@section('contentheader_title')
    Comisiones / Sub Comisión
@endsection
@section('contentheader_description')
    Mantenedor de Comisiones / Sub Comisión
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Comisión / Sub Comisión</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Comisiones/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="rut"><strong>Nombre de la Comisión o Sub Comisión</strong></label>
                                <input class="form-control" type="text" maxlength="50" name="nombre_comision" required>
                            </div>

                            <div class="col-md-3">
                                <label for="rut"><strong>Tipo</strong></label>
                                <select class="form-control" name="tipo_com_sub">
                                    <option value="1">Comisión</option>
                                    <option value="2">SubComisión</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nueva Comisión / Sub Comisión</button>
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
                   <i class="fa fa-info"></i> <h3 class="box-title">Lista de Comisiones / Sub Comisiones (Mantenedor de Informes y Solicitudes) - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Tipo</th>
                            <th>Comisiones / Subcomisiones</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($comisiones as $comisiones)
                            <tr>
                                <td>
                                    @if($comisiones->tipoComisiones==1)
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-circle-o"></i> Comisión
                                        </button>
                                    @else
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-circle-o"></i> Sub Comisión
                                        </button>
                                    @endif
                                </td>
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
