@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Filtro de Solicitudes
@endsection
@section('contentheader_title')
    Solicitudes
@endsection
@section('contentheader_description')
    Filtro de Solicitudes
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
                    <h3 class="box-title">Lista de Solicitudes - Según Filtro: <i class="fa fa-arrow-right"></i>
                        <strong>Año: </strong> XXXXXXXXXXXX
                        <strong>Tipo:</strong> XXXXXXXXXXXXX
                        <strong>Acta:</strong> XXXX
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Sesión / Comisión Solicitud</th>
                            <th>Fecha Solicitud</th>
                            <th>Días Transcurridos</th>
                            <th>Mandante</th>
                            <th>Dirigido A:</th>
                            <th>Fecha Salida Solicitud</th>
                            <th>Estado</th>
                            <th>Documento</th>
                        </tr>
                        @foreach($solicitudes as $solicitudes)
                            <tr>
                                <td>{{ date("m/Y",strtotime($solicitudes -> fechaSesion)) }}
                                    / {{ $solicitudes -> nombreComisiones }}</td>
                                <td>{{ date("d/m/Y H:i:s",strtotime($solicitudes -> fechaCreaSolicitud)) }}</td>
                                <td>X</td>
                                <td>{{ $solicitudes -> nombreConsejeros }}</td>
                                <td>{{ $solicitudes -> solicitudDirigido }}</td>
                                <td>{{ date("d/m/Y",strtotime($solicitudes -> fechaEnvioSolicitud)) }}</td>
                                <td>@if($solicitudes -> estadoSolicitud==1)
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-flag-o"></i> Ingresado
                                        </button>
                                    @elseif($solicitudes -> estadoSolicitud==2)
                                        <button class="btn btn-xs btn-danger"><i class="fa fa-flag-o"></i> Cerrado
                                        </button>
                                    @elseif($solicitudes -> estadoSolicitud==3)
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-flag-o"></i> Archivado
                                        </button>
                                    @endif
                                </td>
                                <td><a href="/StorageCore/{{ $solicitudes -> urlCertificadoSolicitud }}"
                                       target="_blank">
                                        <button class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i>
                                            Descargar Documento
                                        </button>
                                    </a></td>
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
