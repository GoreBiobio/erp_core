@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Filtro de Solicitudes
@endsection
@section('contentheader_title')
    Solicitudes
@endsection
@section('contentheader_description')
    Filtro y Gestión de Solicitudes
@endsection
@section('main-content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Solicitudes</h3>
                    <center>
                        <a class="btn btn-xs btn-primary" id="btnExport" href="#">
                            <i class="fa fa-file-excel-o"></i> Exportar Planilla a Excel
                        </a>
                    </center>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Sesión / Comisión Solicitud</th>
                            <th>Carga Sistema</th>
                            <th>Mandante</th>
                            <th>Dirigido A:</th>
                            <th>Fecha Salida Solicitud</th>
                            <th>Estado</th>
                            <th>Solicitud</th>
                        </tr>
                        @foreach($solicitudes as $solicitudes)
                            <tr>
                                <td>{{ date("m/Y",strtotime($solicitudes -> fechaSesion)) }}
                                    / {{ $solicitudes -> nombreComisiones }}</td>
                                <td>{{ date("d/m/Y H:i:s",strtotime($solicitudes -> fechaCreaSolicitud)) }}</td>
                                <td>{{ $solicitudes -> nombreConsejeros }}</td>
                                <td>{{ $solicitudes -> solicitudDirigido }}</td>
                                <td>{{ date("d/m/Y",strtotime($solicitudes -> fechaEnvioSolicitud)) }}</td>
                                <td>@if($solicitudes -> estadoSolicitud==1)
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-flag-o"></i> En Trámite
                                        </button>
                                    @elseif($solicitudes -> estadoSolicitud==2)
                                        <button class="btn btn-xs btn-success"><i class="fa fa-flag-o"></i> Cerrado
                                        </button>
                                    @elseif($solicitudes -> estadoSolicitud==3)
                                        <button class="btn btn-xs btn-default"><i class="fa fa-flag-o"></i> Archivado
                                            con respuesta
                                        </button>
                                    @elseif($solicitudes -> estadoSolicitud==4)
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-flag-o"></i> Archivado sin
                                            Respuesta
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <center>
                                        <form action="/Solicitud/Ficha" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="idSolicitud"
                                                   value="{{ $solicitudes -> idSolicitudes }}">
                                            <button type="submit" class="btn btn-primary btn-xs"><i
                                                    class="fa fa-gears"></i>
                                                Gestionar Solicitud
                                            </button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <center><strong>{{ $num }}</strong></center>
            <!-- /.box -->
        </div>
    </div>

@endsection
