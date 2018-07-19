@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Consejo Regional del Biobío
@endsection
@section('contentheader_title')
    Consejo Regional del Biobío
@endsection
@section('contentheader_description')
    / Sistema de Gestión Consejo Regional
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
