@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Fotografías Consejeros Regionales
@endsection
@section('contentheader_title')
    Fotografías
@endsection
@section('contentheader_description')
    Consejeros Regionales
@endsection
@section('main-content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Consejeros Regionales</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Consejero Regional</th>
                            <th>Circunscripción</th>
                            <th>Fotografía</th>
                        </tr>
                        @foreach($cores as $cores)
                        <tr>
                            <td>{{ $cores -> nombreConsejeros }}</td>
                            <td>{{ $cores -> nombreCirc }}</td>
                            <td><a class="btn btn-xs btn-default" href=""><i class="fa fa-file-photo-o"></i> Descargar Fotografía</a></td>
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
