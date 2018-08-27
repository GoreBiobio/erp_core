@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ficha de Proyecto
@endsection
@section('contentheader_title')
    Ficha
@endsection
@section('contentheader_description')
    Ficha de Proyecto
@endsection
@section('main-content')

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="/img/logo.png" width="60" alt=""> Gobierno Regional del Biobío - Proyectos
                    <h4><i class="fa fa-file-pdf-o"></i> <strong>Ficha de Proyecto</strong></h4>
                    <small class="pull-right">Fecha y Hora Actual: <strong>{{ date("d-m-Y / H:i:s") }}</strong></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <br>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-5 invoice-col">
                <strong>Identificación</strong><br>
                <address>
                    N° Certificado: <strong>{{ $proyectos -> numCertificado }}</strong><br>
                    Cod. Proyecto: <strong>{{ $proyectos -> codProyecto }}</strong><br>
                    Mandato: <strong>{{ $proyectos -> mandatoProyecto }}</strong> <br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-5 invoice-col">
                <strong>Proyecto</strong><br>
                <address>
                    Nombre Proyecto: <strong>{{ $proyectos -> nombreProyecto }}</strong><strong></strong><br>
                    Línea: <strong>{{ $proyectos -> lineaProyecto }}</strong><br>
                    Monto Proyecto: <strong>{{ $proyectos -> montoProyecto }}</strong> <br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col">
                <strong>Proyecto</strong><br>
                <address>
                    Fecha de Aprobación: <strong>{{ date("d/m/Y",strtotime($proyectos -> fechaSesion))  }}</strong><br>
                    Comuna: <strong>{{ $proyectos -> nombreComunas }}</strong><br>
                    Circunscripción: <strong>{{ $proyectos -> nombreCirc }}</strong> <br>
                </address>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">
                    <small><strong>Observaciones del Proyecto:</strong></small>
                </p>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    {{ $proyectos -> obsProy }}
                </p>
            </div>
            <!-- /.col -->
            @if($proyectos->urlPresProy==null)
                <div class="col-xs-6 no-print">
                    <p class="lead">
                        <small><strong>Agregar Documentos</strong></small>
                    </p>
                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#ModalAddDocument"><i
                            class="fa fa-file-pdf-o"></i> Agregar Presentación
                    </button>
                    <br> <br>

                </div>
        @else
        @endif
        <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row no-print">
            <div class="col-xs-5 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nombre Documento</th>
                        <th>Documento</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Certificado de Aprobación</td>
                        <td>
                            <a href="/StorageCore/{{ $proyectos->urlCertificadoProy }}"
                               target="_blank">
                                <button class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i>
                                    Descargar Documento
                                </button>
                            </a>
                        </td>
                    </tr>
                    @if($proyectos->urlPresProy==null)
                    @else
                        <tr>
                            <td> Presentación Proyecto</td>
                            <td>
                                <a href="/StorageCore/{{ $proyectos->urlPresProy }}"
                                   target="_blank">
                                    <button class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i>
                                        Descargar Documento
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endif
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
                    <h4 class="modal-title">Agregar Documento al Proyecto</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Proyecto/NuevoDocumento" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_proyecto" value="{{ $proyectos ->idProyecto }}">

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

@endsection
