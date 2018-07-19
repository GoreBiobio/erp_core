@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Mantenedor de Usuarios
@endsection
@section('contentheader_title')
    Usuarios
@endsection
@section('contentheader_description')
    Mantenedor de Usuarios
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevo Usuario</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Mantenedor/Comisiones/Guardar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label><strong>Nombre</strong></label>
                                <input class="form-control" type="text" name="nombre" required>
                            </div>
                            <div class="col-md-2">
                                <label><strong>Nombre del Usuario</strong></label>
                                <input class="form-control" type="email" name="nombre_usuario" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <label><strong>Clave</strong></label>
                                <input class="form-control" type="password" name="clave" required>
                            </div>

                            <div class="col-md-2">
                                <label><strong>Nivel de Acceso</strong></label>
                                <select class="form-control" name="nivel_acceso">
                                    <option value="1">Administrador</option>
                                    <option value="2">Operador</option>
                                    <option value="3">Vista</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-warning pull-right">Ingresar Nuevo Usuario</button>
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
                    <h3 class="box-title">Lista de Usuarios - Año {{ date('Y') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Usuarios</th>
                            <th>Correo</th>
                            <th>Nivel</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        @foreach($usuarios as $usuarios)
                            <tr>
                                <td>{{ $usuarios->name }}</td>
                                <td>{{ $usuarios->email }}</td>
                                <td>
                                    @if($usuarios->level==1)
                                        <button class="btn btn-success btn-xs"><i class="fa fa-circle"></i>
                                            Administrator
                                        </button>
                                    @elseif($usuarios->level==2)
                                        <button class="btn btn-warning btn-xs"><i class="fa fa-circle"></i> Operador
                                        </button>
                                    @else
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-circle"></i> Solo Vista
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($usuarios->estado==1)
                                        <button class="btn btn-success btn-xs"><i class="fa fa-circle"></i>
                                            Administrator
                                        </button>
                                    @elseif($usuarios->estado==2)
                                        <button class="btn btn-warning btn-xs"><i class="fa fa-circle"></i> Operador
                                        </button>
                                    @else
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-circle"></i> Solo Vista
                                        </button>
                                    @endif
                                </td>
                                <td></td>
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
