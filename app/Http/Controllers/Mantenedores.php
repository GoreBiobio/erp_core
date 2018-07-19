<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;

class Mantenedores extends Controller
{
    public function formulario_ingreso_nuevo_sesiones()
    {
        $listado = DB::table('sesiones')
            ->OrderBy('numeroSesion', 'ASC')
            ->OrderBy('fechaSesion', 'DESC')
            ->get();
        return view('back_end.mantenedores.nuevo_sesiones', compact('listado'));
    }

    public function guardar_ingreso_nuevo_sesiones(Request $request)
    {
        DB::table('sesiones')->insert([
            'fechaCreaSesiones' => new DateTime(),
            'fechaSesion' => $request->input('fec_sesion'),
            'numeroSesion' => $request->input('num_sesion'),
            'tipoSesion' => $request->input('tipo_sesion'),
            'obsSesion' => $request->input('obs_carga'),
            'funcionarioRegistro' => $request->input('id_funcionario'),
            'estadoSesion' => 1
        ]);

        return back();
    }

    public function suspender_sesiones(Request $request)
    {
        DB::table('sesiones')
            ->where('idSesiones', $request->input('id'))
            ->update(['estadoSesion' => 2]);
        return back();
    }

    public function activar_sesiones(Request $request)
    {
        DB::table('sesiones')
            ->where('idSesiones', $request->input('id'))
            ->update(['estadoSesion' => 1]);
        return back();
    }

    /////////////////////////
    ////////////////////////
    ////////////////////////

    public function formulario_ingreso_nuevo_consejero()
    {
        $consejeros = DB::table('consejeros')
            ->OrderBy('nombreConsejeros', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_consejeros', compact('consejeros'));
    }

    public function guardar_ingreso_nuevo_consejero(Request $request)
    {
        DB::table('consejeros')->insert([
            'nombreConsejeros' => $request->input('nombre_consejero'),
            'estadoConsejeros' => 1
        ]);

        return back();
    }

    public function suspender_consejeros(Request $request)
    {
        DB::table('consejeros')
            ->where('idConsejeros', $request->input('id'))
            ->update(['estadoConsejeros' => 2]);
        return back();
    }

    public function activar_consejeros(Request $request)
    {
        DB::table('consejeros')
            ->where('idConsejeros', $request->input('id'))
            ->update(['estadoConsejeros' => 1]);
        return back();
    }

    /////////////////////////
    /// ////////////////////
    /// ////////////////////

    public function formulario_ingreso_nuevo_comisiones()
    {
        $comisiones = DB::table('comisiones')
            ->OrderBy('nombreComisiones', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_comisiones', compact('comisiones'));
    }

    public function guardar_ingreso_nuevo_comisiones(Request $request)
    {
        DB::table('comisiones')->insert([
            'nombreComisiones' => $request->input('nombre_comision'),
            'estadoComisiones' => 1
        ]);

        return back();
    }

    public function suspender_comisiones(Request $request)
    {
        DB::table('comisiones')
            ->where('idComisiones', $request->input('id'))
            ->update(['estadoComisiones' => 2]);
        return back();
    }

    public function activar_comisiones(Request $request)
    {
        DB::table('comisiones')
            ->where('idComisiones', $request->input('id'))
            ->update(['estadoComisiones' => 1]);
        return back();
    }

    /////////////////////////
    /// ////////////////////
    /// ////////////////////

    public function formulario_ingreso_nuevo_usuarios()
    {

        $usuarios = DB::table('users')->get();
        return view('back_end.mantenedores.nuevo_usuarios',compact('usuarios'));
    }

    public function guardar_ingreso_nuevo_usuarios()
    {

    }

    public function suspender_usuarios()
    {

    }

    public function activar_usuarios()
    {

    }

    /////////////////////////
    /// ////////////////////
    /// ////////////////////

    public function acercade()
    {
        return view('back_end.mantenedores.acercade');
    }

}
