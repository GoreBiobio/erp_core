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
                    <h3 class="box-title">Lista de Actas - Según Filtro: <i class="fa fa-arrow-right"></i>
                        <strong>Año: </strong> {{ $annio }}
                        <strong>Tipo:</strong> {{ $tipo }}
                        <strong>Acta:</strong> {{$acta}}
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Sesión</th>
                            <th>Periodo Sesión</th>
                            <th>N° de Acta</th>
                            <th>Tipo Sesión</th>
                            <th>Acta Digital</th>
                            <th>Observaciones</th>
                        </tr>
                        @foreach($actas as $actas)
                            <tr>
                                <td>{{ $actas -> idActas }}</td>
                                <td>{{ date("d/m/Y",strtotime($actas -> fechaSesion))  }}</td>
                                <td>{{ date("m/Y",strtotime($actas -> fechaSesion))  }}</td>
                                <td>{{ $actas -> numActa }}</td>
                                <td>
                                    @if($actas -> tipoSesion == 'Ordinario')
                                        <button class="btn btn-xs btn-success"><i class="fa fa-flag-o"></i> Ordinario
                                        </button>
                                    @elseif($actas -> tipoSesion== 'Extraordinaria')
                                        <button class="btn btn-xs btn-warning"><i class="fa fa-flag-o"></i>
                                            Extraordinario
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
                                <td><a href="/StorageCore/{{ $actas -> ulrActaDigital }}" target="_blank">
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o"></i>
                                            Descargar Documento
                                        </button>
                                    </a></td>
                                <td>{{ $actas -> obsActa }}</td>
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
