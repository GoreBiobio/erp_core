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
                    <i class="fa fa-folder-open"></i><h3 class="box-title">Lista de Proyectos</h3>
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
                            <th>ID - FICHA</th>
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
                                <td>
                                    <center>
                                        <form action="/Proyecto/Ficha" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id_proyecto"
                                                   value="{{ $proyectos -> idProyecto }}">
                                            <button type="submit" class="btn btn-primary btn-xs"><i
                                                    class="fa fa-folder-open-o"></i>
                                                Ver Ficha
                                            </button>
                                        </form>
                                    </center>
                                </td>
                                <td>{{ date("d/m/Y",strtotime($proyectos -> fechaSesion))  }}
                                    - {{ $proyectos ->numActa }} - {{ $proyectos -> tipoSesion }}</td>
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
