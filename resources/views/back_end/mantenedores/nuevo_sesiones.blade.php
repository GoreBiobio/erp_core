@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Sesiones
@endsection
@section('contentheader_title')
    Sesiones
@endsection
@section('contentheader_description')
    Mantenedor de Sesiones
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Sesión CORE</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Sesiones/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="rut"><strong>Fecha de Sesión</strong></label>
                                <input class="form-control" type="date" name="fec_sesion" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>N° de Sesión</strong></label>
                                <input class="form-control" type="number" name="num_sesion" required>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Tipo de Sesión</strong></label>
                                <select class="form-control" name="tipo_sesion">
                                    <option value="Comision">Comision</option>
                                    <option value="Ordinario">Ordinaria</option>
                                    <option value="Extraordinaria">Extraordinaria</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="nombres"><strong>Funcionario que registra Sesión</strong></label>
                                <input type="hidden" name="id_funcionario" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label for="telefono"><strong>Observaciones de la Carga:</strong></label>
                                <textarea class="form-control" name="obs_carga" rows="3"
                                          placeholder="Ingrese el detalle de la reserva."></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nueva Sesión</button>
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
                    <h3 class="box-title">Sesiones Ordinarias y Extraordinarias Gore Biobío - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Fecha Sesión</th>
                            <th>N° Sesión</th>
                            <th>Tipo de Sesión</th>
                            <th>Observaciones</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($listado as $listado)
                            <tr>
                                <td>{{ date("d/M/Y",strtotime($listado -> fechaSesion))  }}</td>
                                <td>{{ $listado -> numeroSesion }}</td>
                                <td>@if($listado -> tipoSesion == 'Ordinario')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-flag-o"></i> Ordinario
                                        </button>
                                    @elseif($listado -> tipoSesion== 'Extraordinaria')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-flag-o"></i>
                                            Extraordinario
                                        </button>
                                    @elseif($listado -> tipoSesion== 'Comision')
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-flag-o"></i>
                                            Comisión
                                        </button>
                                    @endif
                                </td>
                                <td>{{ $listado -> obsSesion }}</td>
                                <td>@if($listado -> estadoSesion == '1')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-circle-o"></i> Activa
                                        </button>
                                    @elseif($listado -> estadoSesion== '2')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-circle-o"></i> Suspendida
                                        </button>
                                    @endif</td>
                                <td>
                                    @if($listado -> estadoSesion == '1')
                                        <form action="/Mantenedor/Sesiones/Suspender" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $listado -> idSesiones }}">
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-close"></i>
                                                Suspender
                                            </button>
                                        </form>
                                    @elseif($listado -> estadoSesion== '2')
                                        <form action="/Mantenedor/Sesiones/Activar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $listado -> idSesiones }}">
                                            <button type="submit" class="btn btn-success btn-xs"><i
                                                    class="fa fa-check-circle-o"></i>
                                                Activar
                                            </button>
                                        </form>
                                    @endif
                                </td>
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
