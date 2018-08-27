@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Informes
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Ingreso de Informes
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
                    <h3 class="box-title">Nuevo Informe Sub Comisiones</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Informes/Guardar" method="POST" files=”true” class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipoCom" value="subcomision">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label><strong>Fecha Comisión</strong></label>
                                <input class="form-control" type="date" name="fec_comision" maxlength="6" min="0"
                                       required>
                            </div>

                            <div class="col-md-2">
                                <label><strong>Fecha Sesión</strong></label>
                                <input class="form-control" type="date" name="fec_sesion" maxlength="6" min="0"
                                       required>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Sub Comisión</strong></label>
                                <select class="form-control" name="id_sub_comision">
                                        @foreach($subcom as $subcom)
                                            <option value="{{ $subcom->idComisiones }}">
                                                {{ $subcom->nombreComisiones  }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label><strong>Funcionario que registra Informe</strong></label>
                                <input type="hidden" name="id_funcionario" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                       placeholder="Teléfono Personal" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label><strong>Informe Digital de la Sub Comisión</strong></label>
                                <input type="file" name="doc_digital" required>
                                <p class="help-block">Archivo en formato .pdf ó .docx</p>
                            </div>

                            <div class="col-md-4">
                                <label for="telefono"><strong>Observaciones de la Carga:</strong></label>
                                <textarea class="form-control" name="obs_acta" rows="3"
                                          placeholder="Observaciones del informe y/o comisión."></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-primary pull-right">Ingresar Nuevo Informe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
