@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ficha de Solicitudes
@endsection
@section('contentheader_title')
    Solicitudes
@endsection
@section('contentheader_description')
    Ficha de Solicitudes
@endsection
@section('main-content')

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <h3>GOBIERNO REGIONAL DEL BIOBÍO</h3>
                    <h5>Consejo Regional</h5>
                    <i class="fa fa-file-pdf-o"></i> Ficha de Solicitud -
                    <strong>N° {{ $solicitudes -> idSolicitudes }}</strong>
                    <small class="pull-right">Fecha Actual: {{ date("d-m-Y") }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-5 invoice-col">
                Mandante:
                <address>
                    <strong>{{ $solicitudes -> nombreConsejeros }}</strong><br>
                    Sistema:
                    <strong>{{ date("d-m-Y H:i:s",strtotime($solicitudes -> fechaCreaSolicitud)) }}</strong><br>
                    Sesión: <strong>{{ date("d/m/Y",strtotime($solicitudes -> fechaComision)) }}</strong>
                    en <strong>{{ $solicitudes -> nombreComisiones }}</strong><br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
                Dirigido A:
                <address>
                    <strong>{{ $solicitudes -> solicitudDirigido }}</strong><br>
                    Despachado: <strong>{{ date("d-m-Y",strtotime($solicitudes -> fechaEnvioSolicitud)) }}</strong><br>
                    Gestionado Por: <strong>{{ $solicitudes -> name }}</strong><br>
                    <strong>
                        @if($solicitudes -> estadoSolicitud == 1)
                            @php
                                $date = new datetime($solicitudes -> fechaComision);
                                $date2 = new datetime('now');
                                $dif = $date->diff($date2);
                                if ($dif->format('a')>=30){
                                echo $dif->format('%R%a días transcurridos');
                                }else{
                                echo $dif->format('%R%a días transcurridos');
                                }
                            @endphp
                        @else
                            -
                        @endif
                    </strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col">
                Estado:
                @if($solicitudes -> estadoSolicitud==1)
                    <button class="btn btn-xs btn-primary"><i class="fa fa-flag-o"></i> En Trámite
                    </button>
                @elseif($solicitudes -> estadoSolicitud==2)
                    <button class="btn btn-xs btn-success"><i class="fa fa-flag-o"></i> Cerrado
                    </button>
                @elseif($solicitudes -> estadoSolicitud==3)
                    <button class="btn btn-xs btn-default"><i class="fa fa-flag-o"></i> Archivado con respuesta
                    </button>
                @elseif($solicitudes -> estadoSolicitud==4)
                    <button class="btn btn-xs btn-danger"><i class="fa fa-flag-o"></i> Archivado sin
                        Respuesta
                    </button>
                @endif
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">
                    <small><strong>Observaciones Solicitud:</strong></small>
                </p>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    {{ $solicitudes -> obsSolicitud }}
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6 no-print">
                <p class="lead">
                    <small><strong>Gestión Solicitud</strong></small>
                </p>
                @if($solicitudes->estadoSolicitud == 1)
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddDocument"><i
                            class="fa fa-file-pdf-o"></i> Agregar Documento
                    </button>
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddGestion"><i
                            class="fa fa-gears"></i> Agregar Gestión
                    </button>
                @else
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddDocument" disabled>
                        <i
                            class="fa fa-file-pdf-o"></i> Agregar Documento
                    </button>
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddGestion" disabled>
                        <i
                            class="fa fa-gears"></i> Agregar Gestión
                    </button>
                @endif
                <br> <br>

                <table>
                    <tr>
                        <td>
                            @if($num_docs <> 0)
                                @if($solicitudes->estadoSolicitud <> 2)
                                    @if($solicitudes->estadoSolicitud <> 3)
                                        <form action="/Solicitud/Cerrar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="idSolicitud"
                                                   value="{{ $solicitudes -> idSolicitudes }}">
                                            <button type="submit" class="btn btn-danger btn-xs"><i
                                                    class="fa fa-close"></i>
                                                Cerrar Solicitud
                                            </button>
                                        </form>
                                    @else
                                        <button type="submit" class="btn btn-danger btn-xs" disabled><i
                                                class="fa fa-close"></i>
                                            Cerrar Solicitud
                                        </button>
                                    @endif
                                @endif
                            @elseif($num_docs == 0)
                                <button type="submit" class="btn btn-danger btn-xs" disabled><i
                                        class="fa fa-close"></i>
                                    Cerrar Solicitud
                                </button>
                            @endif
                        </td>
                        <td>
                            @if($num_docs == 0 && $btn_arc_sr == 1 && $solicitudes->estadoSolicitud == 1)
                                <form action="/Solicitud/ArchivarSR" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="idSolicitud"
                                           value="{{ $solicitudes -> idSolicitudes }}">
                                    <button type="submit" class="btn btn-warning btn-xs"><i
                                            class="fa fa-archive"></i>
                                        Archivar Solicitud + 30 días
                                    </button>
                                </form>
                            @else
                                <button type="submit" class="btn btn-warning btn-xs" disabled><i
                                        class="fa fa-archive"></i>
                                    Archivar Solicitud + 30 días
                                </button>
                            @endif
                        </td>
                        <td>
                            @if($solicitudes->estadoSolicitud == 2)
                                <form action="/Solicitud/Archivar" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="idSolicitud"
                                           value="{{ $solicitudes -> idSolicitudes }}">
                                    <button type="submit" class="btn btn-success btn-xs"><i
                                            class="fa fa-archive"></i>
                                        Archivar Solicitud
                                    </button>
                                </form>
                            @else
                                <button type="submit" class="btn btn-success btn-xs" disabled><i
                                        class="fa fa-archive"></i>
                                    Archivar Solicitud
                                </button>
                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row no-print">
            <div class="col-xs-5 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre Documento</th>
                        <th>Documento</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> {{ date("d-m-Y H:i:s",strtotime($solicitudes -> fechaCreaSolicitud)) }}</td>
                        <td> Solicitud en Sala</td>
                        <td>
                            <a href="/StorageCore/{{ $solicitudes -> urlCertificadoSolicitud }}"
                               target="_blank">
                                <button class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i>
                                    Descargar Documento
                                </button>
                            </a>
                        </td>
                    </tr>
                    @foreach($documentos as $documentos)
                        <tr>
                            <td> {{ date("d-m-Y H:i:s",strtotime($documentos -> fecCargaDocumento)) }}</td>
                            <td>{{ $documentos -> nombreDocumento }}</td>
                            <td><a href="/StorageCore/{{ $documentos -> urlDocumento }}"
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

            <div class="col-xs-7 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Fecha / Hora</th>
                        <th>Gestión</th>
                        <th>Gestionado Por</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gestiones as $gestiones)
                        <tr>
                            <td>{{ date("d-m-Y H:i:s",strtotime($gestiones -> fechaGestion)) }}</td>
                            <td>{{ $gestiones -> gestion }}</td>
                            <td>{{ $gestiones -> name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href='javascript:window.print();' target="_blank" target="_blank" class="btn btn-default"><i
                        class="fa fa-print"></i>
                    Imprimir Ficha</a>
            </div>
        </div>
    </section>

    <div id="ModalAddDocument" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Documento a la Solicitud</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Solicitud/NuevoDocumento" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idSolicitud" value="{{ $solicitudes -> idSolicitudes }}">

                        <div class="form-group">
                            <div class="col-md-10">
                                <label><strong>Nombre del Documento</strong></label>
                                <input class="form-control" type="text" maxlength="200" name="nombre_documento"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <label><strong>Documento a Agregar</strong></label>
                                <input type="file" name="doc_digital" required>
                                <p class="help-block">Archivo en formato .pdf ó .docx</p>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar
                                Documento
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

    <div id="ModalAddGestion" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Documento a la Solicitud</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Solicitud/NuevaGestion" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idSolicitud" value="{{ $solicitudes -> idSolicitudes }}">

                        <div class="form-group">
                            <div class="col-md-10">
                                <label><strong>Gestión Realizada</strong></label>
                                <input class="form-control" type="text" maxlength="200" name="gestion"
                                       required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar
                                Gestión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

@endsection
