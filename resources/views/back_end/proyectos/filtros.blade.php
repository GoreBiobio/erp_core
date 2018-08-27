@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Ingreso de Proyectos
@endsection
@section('contentheader_title')
    Formulario
@endsection
@section('contentheader_description')
    Filtro de Proyectos
@endsection
@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Año - Comuna</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="1">
                        <div class="form-group">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="rut"><strong>Seleccione por Comuna</strong></label>
                                <select class="form-control" name="comuna">
                                    @foreach($comunas as $comunas)
                                        <option
                                            value="{{ $comunas ->idComunas }}">{{ $comunas -> nombreComunas }}</option>
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

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Año - Provincia</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="2">
                        <div class="form-group">
                            <div class="col-md-6">
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

                            <div class="col-md-6">
                                <label for="rut"><strong>Seleccione por Provincia</strong></label>
                                <select class="form-control" name="provincia">
                                    @foreach($provincias as $provincias)
                                        <option
                                            value="{{ $provincias ->idProvincias }}">{{ $provincias -> nombreProvincia }}</option>
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

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Año - Región</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="3">
                        <div class="form-group">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="rut"><strong>Seleccione por Región</strong></label>
                                <select class="form-control" name="region">
                                    @foreach($regiones as $regiones)
                                        <option
                                            value="{{ $regiones ->idRegiones }}">{{ $regiones -> nombreRegion }}</option>
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

        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Código Proyecto</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><strong>Por Código Proyecto</strong></label>
                                <input class="form-control" type="number" name="cod_proyecto" required>
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

        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / N° Certificado</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="5">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><strong>Por N° Certificado</strong></label>
                                <input class="form-control" type="number" name="num_certificado" required>
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

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Monto Proyectos</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="6">
                        <div class="col-md-6">
                            <label><strong>Por Monto</strong></label>
                            <input class="form-control" type="number" name="monto" required>
                        </div>

                        <div class="col-md-6 radio">
                            <label>
                                <input type="radio" name="opciones" id="optionsRadios1" value="mayor"
                                       checked="">
                                Mayor
                            </label>
                        </div>
                        <div class="col-md-6 radio">
                            <label>
                                <input type="radio" name="opciones" id="optionsRadios2" value="menor">
                                Menor
                            </label>
                        </div>
                        <div class="col-md-6 radio">
                            <label>
                                <input type="radio" name="opciones" id="optionsRadios3" value="igual">
                                Igual
                            </label>
                        </div>

                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-success pull-right">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Año - Región</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="7">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label><strong>Nombre Proyecto</strong></label>
                                <input class="form-control" type="text" name="nombre_proyecto" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rut"><strong>Seleccione Provincia</strong></label>
                                <select class="form-control" name="prov">
                                    @foreach($prov as $prov)
                                        <option
                                            value="{{ $prov ->idProvincias }}">{{ $prov -> nombreProvincia }}</option>
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

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro / Año - Región</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" action="/Proyecto/Filtrar" method="POST" class="form-horizontal">
                        <!-- text input -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="tipo_sol" value="8">
                        <div class="form-group">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="rut"><strong>Seleccione Circunscripciones</strong></label>
                                <select class="form-control" name="cir">
                                    @foreach($cir as $cir)
                                        <option
                                            value="{{ $cir ->idCirc }}">{{ $cir -> nombreCirc }}</option>
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
