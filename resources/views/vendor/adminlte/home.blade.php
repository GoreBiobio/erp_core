@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Consejo Regional del Biobío
@endsection
@section('contentheader_title')
    Consejo Regional del Biobío
@endsection
@section('contentheader_description')
    / Sistema de Gestión Consejo Regional
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Consejo Regional - Región del Biobío -
                        Fecha/Hora: {{  date('d / m / y - H:i:s')  }}</div>

                    <div class="panel-body">

                        <div class="col-md-6">
                        @if( Auth::user()->level == 1 )
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-success">
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">Solicitudes en Sala</h3>
                                    <h5 class="widget-user-desc">de Consejeros Regionales Biobío</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="/Solicitud/Filtro">En Trámite <span
                                                    class="pull-right badge bg-blue">{{ $num_tramite }}</span></a></li>

                                            <li><a href="/Solicitud/Filtro">Sin Respuesta +30 días <span
                                                        class="pull-right badge bg-yellow">{{ $sum }}</span></a>
                                            </li>
                                            <li><a href="/Solicitud/Filtro">Concluido sin Archivar <span
                                                        class="pull-right badge bg-green">{{ $num_concluido }}</span></a>
                                            </li>
                                            <li><a href="/Solicitud/Filtro">Archivado <strong>NO</strong> Respondido
                                                    <span
                                                        class="pull-right badge bg-red">{{ $num_archivo_sr }}</span></a>
                                            </li>
                                            <li><a href="/Solicitud/Filtro">Archivado Respondido <span
                                                        class="pull-right badge bg-success">{{ $num_archivo  }}</span></a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
