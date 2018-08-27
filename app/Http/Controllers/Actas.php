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

        return view('back_end.actas.nuevo');

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
            'fechaSesion' => $request->input('fec_sesion'),
            'numActa' => $request->input('num_acta'),
            'ulrActaDigital' => $name,
            'tipoActa' => 'normal',
            'tipoSesion' => $request->input('tipo_sesion'),
            'obsActa' => $request->input('obs_acta'),
            'estadoActa' => 1,
            'numSesionActa' => $request->input('num_sesion'),
            'comisiones_idComisiones' => null,
            'users_id' => $request->input('id_funcionario'),
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
                ->where([
                    ['fechaSesion', 'LIKE', $annio . '%'],
                    ['tipoSesion', $tipo],
                    ['numActa', $acta],
                    ['tipoActa', 'normal']
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio != 'Todos' && $tipo != 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->where([
                    ['fechaSesion', 'LIKE', $annio . '%'],
                    ['tipoSesion', $tipo],
                    ['tipoActa', 'normal']
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio == 'Todos' && $tipo == 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->where('tipoActa', 'normal')
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio == 'Todos' && $tipo == 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->where([
                    ['tipoActa', 'normal'],
                    ['numActa', $acta]
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio != 'Todos' && $tipo == 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->where([
                    ['fechaSesion', 'LIKE', $annio . '%'],
                    ['tipoActa', 'normal']
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio != 'Todos' && $tipo == 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->where([
                    ['fechaSesion', 'LIKE', $annio . '%'],
                    ['numActa', $acta],
                    ['tipoActa', 'normal']
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio == 'Todos' && $tipo != 'Todos' && $acta != '') {
            $actas = DB::table('actas')
                ->where([
                    ['tipoSesion', $tipo],
                    ['numActa', $acta],
                    ['tipoActa', 'normal']
                ])
                ->OrderBy('fechaSesion', 'DESC')
                ->get();

        } elseif ($annio == 'Todos' && $tipo != 'Todos' && $acta == '') {
            $actas = DB::table('actas')
                ->where([
                    ['tipoSesion', $tipo],
                    ['tipoActa', 'normal']
                ])
                ->get();

        } else {
            echo 'ERROR EN BUSQUEDA FILTRADA';
            die();
        }

        $num = $actas->count();

        if ($num == 0) {
            $num = 'NO SE ENCONTRARON REGISTROS';
            return view('back_end.actas.filtrar', compact('actas', 'annio', 'tipo', 'acta', 'num'));
        } else {
            $num = '';
            return view('back_end.actas.filtrar', compact('actas', 'annio', 'tipo', 'acta', 'num'));

        }

    }
}
