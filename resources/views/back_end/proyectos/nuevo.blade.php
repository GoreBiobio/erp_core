@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Proyectos
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Ingreso de Proyectos Aprobados
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo Proyecto</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Guardar" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="rut"><strong>Seleccione Sesión</strong></label>
                                <select class="form-control" name="id_sesion">
                                    @foreach($actas as $actas)
                                        <option value="{{ $actas->idActas }}">
                                            {{ date("d/M/Y",strtotime($actas -> fechaSesion))  }}
                                            - {{ $actas->numActa }}
                                            - {{ $actas->tipoSesion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>N° Certificado</strong></label>
                                <input class="form-control" type="number" min="0" name="num_certificado" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Código Proyecto (BIP)</strong></label>
                                <input class="form-control" type="text" name="cod_proy">
                            </div>

                            <div class="col-md-4">
                                <label for="rut"><strong>Mandato</strong></label>
                                <input class="form-control" type="text" name="mandato">
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Seleccione Comuna</strong></label>
                                <select class="form-control" name="id_comuna">
                                    @foreach($comunas as $comunas)
                                        <option
                                            value="{{ $comunas -> idComunas }}">{{ $comunas->nombreComunas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- text input -->
                        <div class="form-group">

                            <div class="col-md-4">
                                <label for="nombres"><strong>Nombre del Proyecto</strong></label>
                                <input type="text" class="form-control" name="nombre_proyecto" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Línea Presupuestaria</strong></label>
                                <input type="text" class="form-control" name="linea_presup">
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Inversión FNDR (Miles de Millones)</strong></label>
                                <input type="number" class="form-control" min="0" name="inversion_fndr">
                            </div>

                            <div class="col-md-4">
                                <label for="nombres"><strong>Funcionario que registra Proyecto</strong></label>
                                <input type="hidden" name="id_funcionario" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                       placeholder="Teléfono Personal" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputFile"><strong>Certificado Firmado y Ord.</strong></label>
                                <input type="file" id="exampleInputFile" name="certificado_proyecto" required>
                                <p class="help-block">Archivo en formato .pdf ó .docx</p>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Seleccione Área Proyecto</strong></label>
                                <select class="form-control" name="id_area">
                                    @foreach($areas as $areas)
                                        <option
                                            value="{{ $areas -> idAreas }}">{{ $areas->nombreArea }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono"><strong>Observaciones del Proyecto:</strong></label>
                                <textarea class="form-control" name="obs_proyecto" rows="3"
                                          placeholder="Observaciones del Proyecto."></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-primary pull-right">Ingresar Nuevo Proyecto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
