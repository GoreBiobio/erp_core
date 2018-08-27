@extends('adminlte::layouts.publico')
@section('htmlheader_title')
    Reservas Salón
@endsection
@section('contentheader_title')
    Reservas Salón
@endsection
@section('contentheader_description')
    / Calendario de Disponibilidad
@endsection
@section('main-content')

    <div class="container">
        <div class="row">
            <div class="col-md-3  no-print">

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Agenda</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <center><a href="/home"><img src="/img/logo.png" alt=""></a></center>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Glosario Circunscripción</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            @foreach($data2 as $data2)
                                <button type="submit" class="btn btn-block btn-flat"
                                        style="color: #ffffff; background-color: {{ $data2->colorCirc }}">
                                    <strong>{{ $data2 -> nombreCirc }}</strong>
                                </button>
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-calendar"></i> AGENDA PÚBLICA DE INVITACIONES</div>

                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

