@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Áreas
@endsection
@section('contentheader_title')
    Áreas
@endsection
@section('contentheader_description')
    Mantenedor de Áreas
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Área</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Areas/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="rut"><strong>Nombre del Área</strong></label>
                                <input class="form-control" type="text" maxlength="30" name="nombre_area" required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nueva Área</button>
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
                    <i class="fa fa-info"></i> <h3 class="box-title">Lista de Áreas (Mantenedor de Proyectos) - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Areas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($areas as $areas)
                            <tr>
                                <td>{{ $areas -> nombreArea }}</td>
                                <td>@if($areas -> estadoArea == '1')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-circle-o"></i> Activa
                                        </button>
                                    @elseif($areas -> estadoArea== '2')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-circle-o"></i> Suspendida
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($areas -> estadoArea == '1')
                                        <form action="/Mantenedor/Areas/Suspender" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $areas -> idAreas }}">
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-close"></i>
                                                Suspender
                                            </button>
                                        </form>
                                    @elseif($areas -> estadoArea== '2')
                                        <form action="/Mantenedor/Areas/Activar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $areas -> idAreas }}">
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
