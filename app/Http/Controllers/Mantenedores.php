<?php

namespace App\Http\Controllers;

use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Carbon;
use Illuminate\Http\Request;
use DateTime;
use DB;

class Mantenedores extends Controller
{

    public function agenda_ver()
    {

        $color = null;
        $events = [];
        $data = $invitaciones = DB::table('invitaciones')
            ->where([
                ['estadoInv', '=', '1'],
            ])
            ->join('circunscripciones', 'circunscripciones.idCirc', 'invitaciones.circunscripciones_idCirc')
            ->get();

        $data2 = DB::table('circunscripciones')
            ->get();

        foreach ($data as $key => $value) {
            $events[] = Calendar::event(
                'Invitación: ' . $value->nombreInv . ' Remitente: ' . $value->nombreRemInv . ' / Lugar: ' . $value->lugar,
                false,
                new \DateTime($value->fecIniInv),
                new \DateTime($value->fecFinInv),
                null,
                [
                    'color' => $value->colorCirc,
                ]
            );
        }

        $calendar = Calendar::addEvents($events);

        return view('back_end.mantenedores.ver_agenda', compact('calendar', 'data2'));

    }

    public function agenda_nuevo()
    {

        $circunscripciones = DB::table('circunscripciones')
            ->where('estadoCirc', 1)
            ->get();

        $invitaciones = DB::table('invitaciones')
            ->join('circunscripciones', 'circunscripciones.idCirc', 'invitaciones.circunscripciones_idCirc')
            ->where([
                ['estadoInv', 1],
                ['fecFinInv', '>=', NOW()],

            ])
            ->orderby('fecIniInv', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_agenda', compact('circunscripciones', 'invitaciones'));

    }

    public function agenda_guarda_nuevo(Request $request)
    {

        DB::table('invitaciones')->insert([
            'fecCreaInv' => new datetime(),
            'fecIniInv' => $request->input('fec_ini') . ' ' . $request->input('hora_ini'),
            'fecFinInv' => $request->input('fec_fin') . ' ' . $request->input('hora_fin'),
            'nombreInv' => $request->input('nombre_inv'),
            'nombreRemInv' => $request->input('remitente_inv'),
            'tipoInv' => 1,
            'estadoInv' => 1,
            'lugar' => $request->input('lugar_inv'),
            'circunscripciones_idCirc' => $request->input('id_circ')
        ]);
        return redirect('/Agenda/Nuevo')->with('status', '¡Invitación guardada con éxito!');

    }

    public function agenda_guarda_eliminar(Request $request){

        DB::table('invitaciones')
            ->where('idInvitaciones', $request->input('idItem'))
            ->update([
                'estadoInv' => 2
            ]);

        return back();

    }

/////////////////////////
////////////////////////
////////////////////////

    public
    function ver_fotos_cores()
    {

        $cores = DB::table('consejeros')
            ->join('circunscripciones', 'circunscripciones.idCirc', 'consejeros.circunscripciones_idCirc')
            ->get();

        return view('back_end.mantenedores.cores', compact('cores'));

    }

/////////////////////////
////////////////////////
////////////////////////

    public
    function formulario_ingreso_nuevo_areas()
    {

        $areas = DB::table('areas')
            ->OrderBy('nombreArea', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_areas', compact('areas'));
    }

    public
    function guardar_ingreso_nuevo_areas(Request $request)
    {

        DB::table('areas')->insert([
            'nombreArea' => $request->input('nombre_area'),
            'estadoArea' => 1
        ]);

        return back();
    }

    public
    function suspender_areas(Request $request)
    {

        DB::table('areas')
            ->where('idAreas', $request->input('id'))
            ->update(['estadoArea' => 2]);

        return back();

    }

    public
    function activar_areas(Request $request)
    {
        DB::table('areas')
            ->where('idAreas', $request->input('id'))
            ->update(['estadoArea' => 1]);

        return back();
    }

/////////////////////////
////////////////////////
////////////////////////

    public
    function formulario_ingreso_nuevo_consejero()
    {

        $circ = DB::table('circunscripciones')
            ->get();

        $consejeros = DB::table('consejeros')
            ->join('circunscripciones', 'consejeros.circunscripciones_idCirc', 'circunscripciones.idCirc')
            ->OrderBy('nombreConsejeros', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_consejeros', compact('consejeros', 'circ'));
    }

    public
    function guardar_ingreso_nuevo_consejero(Request $request)
    {
        DB::table('consejeros')->insert([
            'nombreConsejeros' => $request->input('nombre_consejero'),
            'circunscripciones_idCirc' => $request->input('id_cir'),
            'estadoConsejeros' => 1
        ]);

        return back();
    }

    public
    function suspender_consejeros(Request $request)
    {
        DB::table('consejeros')
            ->where('idConsejeros', $request->input('id'))
            ->update(['estadoConsejeros' => 2]);
        return back();
    }

    public
    function activar_consejeros(Request $request)
    {
        DB::table('consejeros')
            ->where('idConsejeros', $request->input('id'))
            ->update(['estadoConsejeros' => 1]);
        return back();
    }

/////////////////////////
/// ////////////////////
/// ////////////////////

    public
    function formulario_ingreso_nuevo_comisiones()
    {
        $comisiones = DB::table('comisiones')
            ->OrderBy('nombreComisiones', 'ASC')
            ->get();

        return view('back_end.mantenedores.nuevo_comisiones', compact('comisiones'));
    }

    public
    function guardar_ingreso_nuevo_comisiones(Request $request)
    {
        DB::table('comisiones')->insert([
            'nombreComisiones' => $request->input('nombre_comision'),
            'tipoComisiones' => $request->input('tipo_com_sub'),
            'estadoComisiones' => 1
        ]);

        return back();
    }

    public
    function suspender_comisiones(Request $request)
    {
        DB::table('comisiones')
            ->where('idComisiones', $request->input('id'))
            ->update(['estadoComisiones' => 2]);
        return back();
    }

    public
    function activar_comisiones(Request $request)
    {
        DB::table('comisiones')
            ->where('idComisiones', $request->input('id'))
            ->update(['estadoComisiones' => 1]);
        return back();
    }

/////////////////////////
/// ////////////////////
/// ////////////////////

    public
    function formulario_ingreso_nuevo_usuarios()
    {

        $usuarios = DB::table('users')->get();
        return view('back_end.mantenedores.nuevo_usuarios', compact('usuarios'));
    }

    public
    function guardar_ingreso_nuevo_usuarios()
    {

    }

    public
    function suspender_usuarios()
    {

    }

    public
    function activar_usuarios()
    {

    }

/////////////////////////
/// ////////////////////
/// ////////////////////

    public
    function promocion(Request $request)
    {

        if ($request->input('tipo') == 'sesion') {
            if ($request->input('tipo_prom') == 'quitar') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 0]);

                return redirect('/Acta/Filtro');

            } elseif ('promover') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 1]);

                return redirect('/Acta/Filtro');

            }

        } elseif ($request->input('tipo') == 'comision') {

            if ($request->input('tipo_prom') == 'quitar') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 0]);

                return redirect('/InformesCom/Filtro');

            } elseif ('promover') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 1]);

                return redirect('/InformesCom/Filtro');

            }

        } elseif ($request->input('tipo') == 'subcomision') {

            if ($request->input('tipo_prom') == 'quitar') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 0]);

                return redirect('/InformeSComision/Filtro');

            } elseif ('promover') {

                DB::table('actas')
                    ->where('idActas', $request->input('id'))
                    ->update(['estadoActa' => 1]);

                return redirect('/InformeSComision/Filtro');

            }

        }
    }

    public
    function acercade()
    {
        return view('back_end.mantenedores.acercade');
    }

}
