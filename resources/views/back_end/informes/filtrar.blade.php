@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Filtro de Informes
@endsection
@section('contentheader_title')
    Informes
@endsection
@section('contentheader_description')
    Filtro de Informes
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
                    <h3 class="box-title">Lista de Informes - Según Filtro: <i class="fa fa-arrow-right"></i>
                        <strong>Año: </strong> {{ $annio }}
                        @if($tipo=='SubComisiones')
                            <strong>Sub Comisión:</strong>
                            {{ $nom_comision -> nombreComisiones }}
                        @else
                            <strong>Comisión:</strong>
                            {{ $nom_comision -> nombreComisiones }}
                        @endif
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
                            <th>Fecha Comisión / Subcomisión</th>
                            <th>Periodo Sesión</th>
                            <th>Comisión / Sub Comisión</th>
                            <th>Acta Digital</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($actas as $actas)
                            <tr>
                                <td>{{ $actas -> idActas }}</td>
                                <td>{{ date("d/m/Y",strtotime($actas -> fechaComision))  }}</td>
                                <td>{{ date("d/m/Y",strtotime($actas -> fechaSesion))  }}</td>
                                <td>
                                    @if($tipo=='SubComisiones')
                                        {{ $actas -> nombreComisiones }}
                                    @else
                                        {{ $actas -> nombreComisiones }}
                                    @endif
                                </td>
                                <td><a href="/StorageCore/{{ $actas -> ulrActaDigital }}" target="_blank">
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o"></i>
                                            Descargar Documento
                                        </button>
                                    </a></td>
                                <td>{{ $actas -> obsActa }}</td>
                                <td>
                                    @if($actas -> estadoActa == 1)
                                        <center>
                                            <form action="/Mantenedor/Promocion" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                @if($actas->tipoActa == 'comision')
                                                    <input type="hidden" name="tipo" value="comision">
                                                @elseif($actas->tipoActa == 'subcom')
                                                    <input type="hidden" name="tipo" value="subcomision">
                                                @endif
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
                                                @if($actas->tipoActa == 'comision')
                                                    <input type="hidden" name="tipo" value="comision">
                                                @elseif($actas->tipoActa == 'subcom')
                                                    <input type="hidden" name="tipo" value="subcomision">
                                                @endif
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
