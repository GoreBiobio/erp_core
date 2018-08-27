@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Consejeros
@endsection
@section('contentheader_title')
    Consejeros
@endsection
@section('contentheader_description')
    Mantenedor de Consejeros
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo Consejero</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Consejeros/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="rut"><strong>Nombre Consejero(a)</strong></label>
                                <input class="form-control" type="text" name="nombre_consejero" required>
                            </div>

                            <div class="col-md-3">
                                <label for="rut"><strong>Circunscripción</strong></label>
                                <select class="form-control" name="id_cir">
                                    @foreach($circ as $circ)
                                        <option value="{{ $circ->idCirc }}">{{ $circ -> nombreCirc }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nuevo Consejero(a)</button>
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
                    <h3 class="box-title">Consejeros Regionales (Mantenedor de Solicitudes) - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Consejero</th>
                            <th>Zona</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($consejeros as $consejeros)
                            <tr>
                                <td>{{ $consejeros -> nombreConsejeros }}</td>
                                <td>{{ $consejeros -> nombreCirc }}</td>
                                <td>@if($consejeros -> estadoConsejeros == '1')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-circle-o"></i> Activo(a)
                                        </button>
                                    @elseif($consejeros -> estadoConsejeros== '2')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-circle-o"></i> Suspendido(a)
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($consejeros -> estadoConsejeros == '1')
                                        <form action="/Mantenedor/Consejeros/Suspender" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $consejeros -> idConsejeros }}">
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-close"></i>
                                                Suspender
                                            </button>
                                        </form>
                                    @elseif($consejeros -> estadoConsejeros== '2')
                                        <form action="/Mantenedor/Consejeros/Activar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id"
                                                   value="{{ $consejeros -> idConsejeros }}">
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
