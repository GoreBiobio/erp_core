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
                    <i class="fa fa-file-pdf-o"></i> Ficha de Solicitud - N° {{ $solicitudes -> idSolicitudes }}
                    <small class="pull-right">Fecha: {{ date("d-m-Y") }}</small>
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
                    Solicitado: {{ date("d-m-Y H:i:s",strtotime($solicitudes -> fechaCreaSolicitud)) }}<br>
                    Sesión: {{ date("m/Y",strtotime($solicitudes -> fechaSesion)) }}
                    en {{ $solicitudes -> nombreComisiones }}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
                Dirigido A:
                <address>
                    <strong>{{ $solicitudes -> solicitudDirigido }}</strong><br>
                    Despachado: {{ date("d-m-Y",strtotime($solicitudes -> fechaEnvioSolicitud)) }}<br>
                    Gestionado Por: {{ $solicitudes -> name }}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col">

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
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddDocument"><i
                        class="fa fa-file-pdf-o"></i> Agregar Documento
                </button>
                <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddGestion"><i
                        class="fa fa-gears"></i> Agregar Gestión
                </button>
                <br> <br>
                @if($solicitudes -> estadoSolicitud==1)
                    <form action="/Solicitud/Cerrar" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idSolicitud"
                               value="{{ $solicitudes -> idSolicitudes }}">
                        <button type="submit" class="btn btn-danger btn-xs"><i
                                class="fa fa-close"></i>
                            Cerrar Solicitud
                        </button>
                    </form>
                @elseif($solicitudes -> estadoSolicitud == 2)
                    <button class="btn btn-danger btn-xs" disabled><i class="fa fa-close"></i> Cerrar Solicitud</button>
                @elseif($solicitudes -> estadoSolicitud == 3)
                    <button class="btn btn-danger btn-xs" disabled><i class="fa fa-close"></i> Cerrar Solicitud</button>
                @endif

                @if($solicitudes -> estadoSolicitud == 1)
                    <button class="btn btn-success btn-xs" disabled><i class="fa fa-archive"></i> Archivar Solicitud</button>
                @elseif($solicitudes -> estadoSolicitud == 2)
                    <form action="/Solicitud/Archivar" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idSolicitud"
                               value="{{ $solicitudes -> idSolicitudes }}">
                        <button type="submit" class="btn btn-success btn-xs"><i
                                class="fa fa-close"></i>
                            Archivar Solicitud
                        </button>
                    </form>
                @elseif($solicitudes -> estadoSolicitud == 3)
                    <button class="btn btn-success btn-xs" disabled><i class="fa fa-archive"></i> Archivar Solicitud</button>
                @endif

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
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
