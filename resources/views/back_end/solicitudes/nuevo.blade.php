@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Solicitud Sala
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Ingreso de Solicitud en Sala
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
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Solicitud en Sala</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Solicitud/Guardar" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="rut"><strong>Seleccione Sesión</strong></label>
                                <select class="form-control" name="id_sesion">
                                    @foreach($actas as $actas)
                                        <option value="{{ $actas->idActas }}">
                                            {{ date("d/M/Y",strtotime($actas -> fechaComision))  }}
                                            - {{ $actas->nombreComisiones }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="rut"><strong>Solicitado por:</strong></label>
                                <select class="form-control" name="id_consejero">
                                    @foreach($consejeros as $consejeros)
                                        <option value="{{ $consejeros->idConsejeros }}">
                                            {{ $consejeros -> nombreConsejeros }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="nombres"><strong>Dirigido a:</strong></label>
                                <input class="form-control" type="text" name="dirigido_a" required>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Fecha de Envio</strong></label>
                                <input class="form-control" type="date" name="fecha_envio" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="exampleInputFile"><strong>Documento Solicitud</strong></label>
                                <input type="file" id="exampleInputFile" name="doc_digital" required>
                                <p class="help-block">Archivo en formato .pdf ó .docx</p>
                            </div>

                            <div class="col-md-4">
                                <label for="nombres"><strong>Funcionario que registra Solicitud</strong></label>
                                <input type="hidden" name="id_func" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                       placeholder="Teléfono Personal" readonly>
                            </div>

                            <div class="col-md-5">
                                <label for="telefono"><strong>Observaciones de la Carga:</strong></label>
                                <textarea class="form-control" name="obs_solicitud" rows="3"
                                          placeholder="Observaciones a la solicitud."></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-danger pull-right">Ingresar Nueva Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
