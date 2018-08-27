@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Gestión de Invitaciones
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Gestión de Invitaciones
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
                    <h3 class="box-title">Nueva Invitación</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Agenda/Guardar" method="POST" files=”true”
                          class="form-horizontal"
                          enctype="multipart/form-data">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">

                            <div class="col-md-2">
                                <label for="nombres"><strong>Fecha Inicio Actividad</strong></label>
                                <input class="form-control" type="date" min="0" name="fec_ini" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Hora Inicio Actividad</strong></label>
                                <input class="form-control" type="time" name="hora_ini" required>
                            </div>

                            <div class="col-md-2">
                                <label for="rut"><strong>Seleccione Circunscripciones</strong></label>
                                <select class="form-control" name="id_circ">
                                    @foreach($circunscripciones as $circunscripciones)
                                        <option
                                            value="{{ $circunscripciones -> idCirc }}">{{ $circunscripciones->nombreCirc }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Fecha Fin Actividad</strong></label>
                                <input class="form-control" type="date" min="0" name="fec_fin" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Hora Fin Actividad</strong></label>
                                <input class="form-control" type="time" name="hora_fin" required>
                            </div>
                        </div>

                        <!-- text input -->
                        <div class="form-group">

                            <div class="col-md-3">
                                <label for="nombres"><strong>Nombre o Tenor Invitación</strong></label>
                                <input type="text" class="form-control" name="nombre_inv" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Remitente Invitación</strong></label>
                                <input type="text" class="form-control" name="remitente_inv" required>
                            </div>

                            <div class="col-md-3">
                                <label for="nombres"><strong>Lugar</strong></label>
                                <input type="text" class="form-control" name="lugar_inv" required>
                            </div>

                            <div class="col-md-2">
                                <label for="nombres"><strong>Funcionario que registra Invitación</strong></label>
                                <input type="hidden" name="id_funcionario" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control" value="{{ Auth::user()->name  }}"
                                       placeholder="Teléfono Personal" readonly>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-success pull-right">Ingresar Nueva Invitación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Gestión de Invitaciones</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Fecha / Hora Invitación</th>
                            <th>Invitación</th>
                            <th>Remitente</th>
                            <th>Circunscripción</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($invitaciones as $inv)
                            <tr>
                                <td>{{ $inv -> idInvitaciones }}</td>
                                <td>{{ date("d/M/Y H:i:s",strtotime($inv -> fecIniInv))  }}</td>
                                <td>{{ $inv -> nombreInv }}</td>
                                <td>{{ $inv -> nombreRemInv }}</td>
                                <td>
                                    <button type="submit" class="btn btn-block btn-xs"
                                            style="color: #ffffff; background-color: {{ $inv->colorCirc }}">
                                        <strong>{{ $inv -> nombreCirc }}</strong>
                                    </button>
                                </td>
                                <td>
                                    <center>
                                        <form action="/Agenda/Eliminar" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="tipo" value="Salon">
                                            <input type="hidden" name="idItem" value="{{ $inv -> idInvitaciones }}">
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <strong><i class="fa fa-calendar-minus-o"></i> Eliminar Invitación</strong>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
