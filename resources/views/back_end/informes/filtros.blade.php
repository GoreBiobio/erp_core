@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Informes
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Filtro de Informes
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro de Informes Comisiones</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Informes/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipoCom" value="comision">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label><strong>Seleccione Año Sesión</strong></label>
                                <select class="form-control" name="annio_sesion">
                                    <option value="Todos">-- Todos --</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="rut"><strong>Comisión</strong></label>
                                <select class="form-control" name="id_comision">
                                    @foreach($comisiones as $comisiones)
                                        <option value="{{ $comisiones->idComisiones }}">
                                            {{ $comisiones->nombreComisiones  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-success pull-right">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
