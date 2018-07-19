@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Filtro de Proyectos
@endsection
@section('contentheader_title')
    Proyectos
@endsection
@section('contentheader_description')
    Filtro de Proyectos
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
                    <h3 class="box-title">Lista de Proyectos - Según Filtro: <i class="fa fa-arrow-right"></i>
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
                            <th>Sesión Aprobación</th>
                            <th>N° Certificado</th>
                            <th>Cod. Proyecto</th>
                            <th>Mandato</th>
                            <th>Nombre Proyecto</th>
                            <th>Comuna</th>
                            <th>Acta Aprobación</th>
                            <th>Monto</th>
                        </tr>
                        @foreach($proyectos as $proyectos)
                            <tr>
                                <td>{{ date("m/Y",strtotime($proyectos -> fechaSesion))  }}
                                    - {{ $proyectos ->numeroSesion }} - {{ $proyectos -> tipoSesion }}</td>
                                <td>{{ $proyectos -> numCertificado }}</td>
                                <td>{{ $proyectos -> codProyecto }}</td>
                                <td>{{ $proyectos -> mandatoProyecto }}</td>
                                <td>{{ $proyectos -> nombreProyecto }}</td>
                                <td>{{ $proyectos -> nombreComunas }}</td>
                                <td>
                                    <a href="/StorageCore/{{ $proyectos -> urlCertificadoProy }}" target="_blank">
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o"></i>
                                            Descargar Documento
                                        </button>
                                    </a>
                                </td>
                                <td>{{ $proyectos -> montoProyecto }}</td>
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
