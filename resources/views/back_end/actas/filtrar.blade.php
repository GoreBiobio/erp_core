@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Filtro de Actas
@endsection
@section('contentheader_title')
    Actas
@endsection
@section('contentheader_description')
    Filtro de Actas
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
                    <i class="fa fa-info"></i>
                    <h3 class="box-title">Lista de Actas - Según Filtro: <i class="fa fa-arrow-right"></i>
                        <strong>Año: </strong> {{ $annio }}
                        <strong>Tipo:</strong> {{ $tipo }}
                        <strong>Acta:</strong> {{$acta}}
                    </h3>
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
                            <th>ID</th>
                            <th>Fecha Sesión</th>
                            <th>Periodo Sesión</th>
                            <th>N° de Sesión</th>
                            <th>N° de Acta</th>
                            <th>Tipo Sesión</th>
                            <th>Acta Digital</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($actas as $actas)
                            <tr>
                                <td>{{ $actas -> idActas }}</td>
                                <td>{{ date("d/m/Y",strtotime($actas -> fechaSesion))  }}</td>
                                <td>{{ date("M/Y",strtotime($actas -> fechaSesion))  }}</td>
                                <td>{{ $actas -> numSesionActa }}</td>
                                <td>{{ $actas -> numActa }}</td>
                                <td>
                                    @if($actas -> tipoSesion == 'Ordinaria')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-flag-o"></i> Sesión
                                            Ordinaria
                                        </button>
                                    @elseif($actas -> tipoSesion== 'Extraordinaria')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-flag-o"></i>
                                            Sesión Extraordinaria
                                        </button>
                                    @elseif($actas -> tipoSesion== 'Comision')
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-flag-o"></i>
                                            Comisión
                                        </button>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-book"></i>
                                            {{ $actas -> comisiones }}
                                        </button>
                                    @endif
                                </td>
                                <td>@if($actas->ulrActaDigital == null)
                                            <button class="btn btn-xs btn-warning" disabled><i class="fa fa-file-pdf-o"></i>
                                                Acta NO Cargada
                                            </button>
                                        @else
                                        <a href="/StorageCore/{{ $actas -> ulrActaDigital }}" target="_blank">
                                            <button class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o"></i>
                                                Descargar Documento
                                            </button>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $actas -> obsActa }}</td>
                                <td>
                                    @if( Auth::user()->level == 1 )
                                        @if($actas -> estadoActa == 1)
                                            <center>
                                                <form action="/Mantenedor/Promocion" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="tipo" value="sesion">
                                                    <input type="hidden" name="tipo_prom" value="quitar">
                                                    <input type="hidden" name="id"
                                                           value="{{ $actas -> idActas }}">
                                                    <button type="submit" class="btn btn-danger btn-xs"><i
                                                            class="fa fa-arrow-down"></i>
                                                        Dejar de Promover
                                                    </button>
                                                </form>
                                            </center>
                                        @else
                                            <center>
                                                <form action="/Mantenedor/Promocion" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="tipo" value="sesion">
                                                    <input type="hidden" name="tipo_prom" value="promover">
                                                    <input type="hidden" name="id"
                                                           value="{{ $actas -> idActas }}">
                                                    <button type="submit" class="btn btn-success btn-xs"><i
                                                            class="fa fa-arrow-up"></i>
                                                        Promover
                                                    </button>
                                                </form>
                                            </center>
                                        @endif
                                        @else
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-close"></i> NO DISPONIBLE</button>
                                    @endif
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
