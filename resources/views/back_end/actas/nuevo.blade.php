@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Actas
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Ingreso de Actas
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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Nueva Acta</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Acta/Guardar" method="POST" files=”true” class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="rut"><strong>Seleccione Sesión</strong></label>
                                <select class="form-control" name="id_sesion">
                                    @foreach($sesiones as $sesiones)
                                        <option value="{{ $sesiones->idSesiones }}">
                                            {{ date("M/Y",strtotime($sesiones -> fechaSesion))  }}
                                            - {{ $sesiones->numeroSesion }}
                                            - {{ $sesiones->tipoSesion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Seleccione Comisión</strong></label>
                                <select class="form-control" name="id_comision">
                                    <option value="0">-- NORMAL --</option>
                                    @foreach($comisiones as $comisiones)
                                        <option
                                            value="{{ $comisiones->nombreComisiones }}">{{ $comisiones -> nombreComisiones }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label><strong>N° Acta</strong></label>
                                <input class="form-control" type="number" name="num_acta" maxlength="6" min="0" required>
                            </div>

                            <div class="col-md-2">
                                <label><strong>Funcionario que registra Acta</strong></label>
                                <input type="hidden" name="id_funcionario" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                       placeholder="Teléfono Personal" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label><strong>Acta Digital del Consejo</strong></label>
                                <input type="file" name="doc_digital" required>
                                <p class="help-block">Archivo en formato .pdf ó .docx</p>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono"><strong>Observaciones de la Carga:</strong></label>
                                <textarea class="form-control" name="obs_acta" rows="3"
                                          placeholder="Ingrese el detalle de la reserva."></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-success pull-right">Ingresar Nueva Acta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
