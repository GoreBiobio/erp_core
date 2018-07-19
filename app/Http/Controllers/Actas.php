<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use DateTime;
use DB;

class Actas extends Controller
{

    public function formulario_ingreso_nuevo()
    {

        $sesiones = DB::table('sesiones')
            ->where('estadoSesion', '=', 1)
            ->OrderBy('numeroSesion', 'ASC')
            ->OrderBy('fechaSesion', 'DESC')
            ->get();

        $comisiones = DB::table('comisiones')->get();

        $archivo = DB::table('actas')->get();

        return view('back_end.actas.nuevo', compact('sesiones', 'archivo', 'comisiones'));

    }

    public function guardar_ingreso_nuevo(Request $request)
    {

        $tipo = 'ActasCore';
        $annio = date("Y");
        $file = $request->file('doc_digital');
        $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/StorageCore/', $name);

        DB::table('actas')->insert([
            'fechaCargaActa' => new Datetime(),
            'numActa' => $request->input('num_acta'),
            'ulrActaDigital' => $name,
            'obsActa' => $request->input('obs_acta'),
            'estadoActa' => 1,
            'sesiones_idSesiones' => $request->input('id_sesion'),
            'users_id' => $request->input('id_funcionario'),
            'comisiones' => $request->input('id_comision')
        ]);

        return back()->with('status', '¡Acta almacenada correctamente!');
    }

    public function filtros_muestras()
    {
        return view('back_end.actas.filtros');
    }

    public function filtrar_muestras(Request $request)
    {

        $annio = $request->input('annio_sesion');
        $tipo = $request->input('tipo_session');
        $acta = $request->input('num_acta');

        if ($annio != 'Todos' && $tipo != 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.tipoSesion', '=', $tipo],
                    ['sesiones.fechaSesion', 'LIKE', $annio . '-%'],
                    ['actas.numActa', '=', $acta]
                ])
                ->get();
        } elseif ($annio != 'Todos' && $tipo != 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.tipoSesion', '=', $tipo],
                    ['sesiones.fechaSesion', 'LIKE', $annio . '-%'],
                ])
                ->get();
        } elseif ($annio == 'Todos' && $tipo == 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->get();
        } elseif ($annio == 'Todos' && $tipo == 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['actas.numActa', '=', $acta]
                ])
                ->get();
        } elseif ($annio != 'Todos' && $tipo == 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.fechaSesion', 'LIKE', $annio . '-%'],
                ])
                ->get();
        } elseif ($annio != 'Todos' && $tipo == 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.fechaSesion', 'LIKE', $annio . '-%'],
                    ['actas.numActa', '=', $acta]
                ])
                ->get();
        } elseif ($annio == 'Todos' && $tipo != 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.tipoSesion', '=', $tipo],
                    ['actas.numActa', '=', $acta]
                ])
                ->get();
        } elseif ($annio == 'Todos' && $tipo != 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->join('sesiones', 'actas.sesiones_idSesiones', 'sesiones.idSesiones')
                ->where([
                    ['sesiones.tipoSesion', '=', $tipo]
                ])
                ->get();
        } else {
            echo 'ERROR EN BUSQUEDA FILTRADA';
            die();
        }

        $num = $actas->count();

        if ($num==0){
            $num = 'NO SE ENCONTRARON REGISTROS';
            return view('back_end.actas.filtrar', compact('actas', 'annio', 'tipo', 'acta', 'num'));
        }else{
            $num = '';
            return view('back_end.actas.filtrar', compact('actas', 'annio', 'tipo', 'acta', 'num'));

        }

    }
}
