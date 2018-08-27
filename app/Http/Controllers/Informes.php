<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use DateTime;
use DB;

class Informes extends Controller
{

    public function formulario_ingreso_nuevo_com()
    {

        $comisiones = DB::table('comisiones')
            ->where([
                ['estadoComisiones', 1],
                ['tipoComisiones', 1]
            ])
            ->get();

        return view('back_end.informes.nuevo_com', compact('comisiones'));

    } // OK

    public function formulario_ingreso_nuevo_subcom()
    {
        $subcom = DB::table('comisiones')
            ->where([
                ['estadoComisiones', 1],
                ['tipoComisiones', 2]
            ])
            ->get();

        return view('back_end.informes.nuevo_subcom', compact('subcom'));
    } //OK

    public function guardar_ingreso_nuevo(Request $request)
    {

        $tipo_guardar = $request->input('tipoCom');

        if ($tipo_guardar == 'comision') {

            $tipo = 'Comisiones';
            $annio = date("Y");
            $file = $request->file('doc_digital');
            $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/StorageCore/', $name);

            DB::table('actas')->insert([
                'fechaCargaActa' => new Datetime(),
                'fechaSesion' => $request->input('fec_sesion'),
                'fechaComision' => $request->input('fec_comision'),
                'ulrActaDigital' => $name,
                'tipoActa' => 'comision',
                'tipoSesion' => $request->input('tipo_sesion'),
                'obsActa' => $request->input('obs_acta'),
                'estadoActa' => 1,
                'comisiones_idComisiones' => $request->input('id_comision'),
                'users_id' => $request->input('id_funcionario'),
            ]);

            return back()->with('status', '¡Informe almacenado correctamente!');

        } elseif ($tipo_guardar == 'subcomision') {

            $tipo = 'SubComisiones';
            $annio = date("Y");
            $file = $request->file('doc_digital');
            $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/StorageCore/', $name);

            DB::table('actas')->insert([
                'fechaCargaActa' => new Datetime(),
                'fechaSesion' => $request->input('fec_sesion'),
                'fechaComision' => $request->input('fec_comision'),
                'ulrActaDigital' => $name,
                'tipoActa' => 'subcom',
                'tipoSesion' => $request->input('tipo_sesion'),
                'obsActa' => $request->input('obs_acta'),
                'estadoActa' => 1,
                'comisiones_idComisiones' => $request->input('id_sub_comision'),
                'users_id' => $request->input('id_funcionario'),
            ]);

            return back()->with('status', '¡Informe almacenado correctamente!');

        }

    } // OK

    public function filtros_muestras_com()
    {

        $comisiones = DB::table('comisiones')
            ->where([
                ['estadoComisiones', 1],
                ['tipoComisiones', 1]
            ])
            ->get();

        return view('back_end.informes.filtros', compact('comisiones'));

    }

    public function filtros_muestras_subcom()
    {

        $subcomisiones = DB::table('comisiones')
            ->where([
                ['estadoComisiones', 1],
                ['tipoComisiones', 2]
            ])
            ->get();

        return view('back_end.informes.filtrossubcom', compact('subcomisiones'));

    }

    public function filtrar_muestras(Request $request)
    {
        $tipo_guardar = $request->input('tipoCom');

        $annio = $request->input('annio_sesion');
        $comision = $request->input('id_comision');
        $subcom = $request->input('id_subcom');


        if ($tipo_guardar == 'comision') {
            $tipo = 'Comisiones';
            $nom_comision = DB::table('comisiones')
                ->where('idComisiones', $comision)
                ->first();

            if ($annio != 'Todos') {
                $actas = DB::table('actas')
                    ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                    ->where([
                        ['fechaComision', 'LIKE', $annio . '%'],
                        ['comisiones_idComisiones', $comision],
                        ['tipoActa', 'comision']
                    ])
                    ->get();

            } elseif ($annio == 'Todos') {
                $actas = DB::table('actas')
                    ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                    ->where([
                        ['comisiones_idComisiones', $comision],
                        ['tipoActa', 'comision']
                    ])
                    ->get();
            }

            $num = $actas->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.informes.filtrar', compact('actas', 'nom_comision', 'tipo', 'num', 'annio'));
            } else {
                $num = '';
                return view('back_end.informes.filtrar', compact('actas', 'nom_comision', 'tipo', 'num', 'annio'));

            }

        } elseif ($tipo_guardar == 'subcomision') {
            $tipo = 'SubComisiones';
            $nom_comision = DB::table('comisiones')
                ->where('idComisiones', $subcom)
                ->first();

            if ($annio != 'Todos') {
                $actas = DB::table('actas')
                    ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                    ->where([
                        ['fechaComision', 'LIKE', $annio . '%'],
                        ['comisiones_idComisiones', $subcom],
                        ['tipoActa', 'subcom']
                    ])
                    ->get();

            } elseif ($annio == 'Todos') {

                $actas = DB::table('actas')
                    ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                    ->where([
                        ['comisiones_idComisiones', $subcom],
                        ['tipoActa', 'subcom']
                    ])
                    ->get();
            }

            $num = $actas->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.informes.filtrar', compact('actas', 'nom_comision', 'tipo', 'num', 'annio'));
            } else {
                $num = '';
                return view('back_end.informes.filtrar', compact('actas', 'nom_comision', 'tipo', 'num', 'annio'));

            }
        }

    }

}
