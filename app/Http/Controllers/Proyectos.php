<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use DB;

class Proyectos extends Controller
{
    public function formulario_ingreso_nuevo()
    {

        $actas = DB::table('actas')
            ->where([
                ['tipoActa', 'normal'],
                ['estadoActa', 1]
            ])
            ->get();

        $areas = DB::table('areas')
            ->where('estadoArea', 1)
            ->get();

        $comunas = DB::table('comunas')
            ->join('provincias', 'comunas.provincias_idProvincias', '=', 'provincias.idProvincias')
            ->join('regiones', 'provincias.regiones_idRegiones', '=', 'regiones.idRegiones')
            ->where('regiones.estadoRegion', '=', 1)
            ->OrderBy('nombreComunas')
            ->get();

        return view('back_end.proyectos.nuevo', compact('actas', 'comunas', 'areas'));
    }

    public function guardar_ingreso_nuevo(Request $request)
    {

        $tipo = 'CertificadoProyecto';
        $annio = date("Y");
        $file = $request->file('certificado_proyecto');
        $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/StorageCore/', $name);

        DB::table('proyectos')->insert([
            'fechaCargaProyecto' => new Datetime(),
            'numCertificado' => $request->input('num_certificado'),
            'codProyecto' => $request->input('cod_proy'),
            'mandatoProyecto' => $request->input('mandato'),
            'nombreProyecto' => $request->input('nombre_proyecto'),
            'lineaProyecto' => $request->input('linea_presup'),
            'montoProyecto' => $request->input('inversion_fndr'),
            'urlCertificadoProy' => $name,
            'obsProy' => $request->input('obs_proyecto'),
            'estadoProy' => 1,
            'actas_idActas' => $request->input('id_sesion'),
            'users_id' => $request->input('id_funcionario'),
            'areas_idAreas' => $request->input('id_area'),
            'comunas_idComunas' => $request->input('id_comuna')
        ]);

        return back()->with('status', '¡Proyecto almacenado correctamente!');

    }

    public function filtros_muestras()
    {

        $comunas = DB::table('comunas')
            ->get();

        $provincias = DB::table('provincias')
            ->get();

        $prov = DB::table('provincias')
            ->get();

        $cir = DB::table('circunscripciones')
            ->get();

        $regiones = DB::table('regiones')
            ->get();

        return view('back_end.proyectos.filtros', compact('comunas', 'provincias', 'regiones', 'prov', 'cir'));
    }

    public function filtrar_muestras(Request $request)
    {

        if ($request->input('tipo_sol') == 1) {
            $annio = $request->input('annio_sesion');
            $comuna = $request->input('comuna');

            if ($request->input('annio_sesion') == 'Todos') {

                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->where('comunas.idComunas', '=', $comuna)
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }

            } else {
                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->where([
                        ['comunas.idComunas', '=', $comuna],
                        ['actas.fechaSesion', 'LIKE', $annio . '-%']
                    ])
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }
            }
        }

        if ($request->input('tipo_sol') == 2) {

            $annio = $request->input('annio_sesion');
            $provincia = $request->input('provincia');

            if ($request->input('annio_sesion') == 'Todos') {

                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('provincias', 'comunas.provincias_idProvincias', 'provincias.idProvincias')
                    ->where('provincias.idProvincias', '=', $provincia)
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }

            } else {
                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('provincias', 'comunas.provincias_idProvincias', 'provincias.idProvincias')
                    ->where([
                        ['provincias.idProvincias', '=', $provincia],
                        ['actas.fechaSesion', 'LIKE', $annio . '-%']
                    ])
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }
            }
        }

        if ($request->input('tipo_sol') == 3) {

            $annio = $request->input('annio_sesion');
            $region = $request->input('region');

            if ($request->input('annio_sesion') == 'Todos') {

                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('provincias', 'comunas.provincias_idProvincias', 'provincias.idProvincias')
                    ->join('regiones', 'provincias.regiones_idRegiones', 'regiones.idRegiones')
                    ->where('regiones.idRegiones', '=', $region)
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }

            } else {
                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('provincias', 'comunas.provincias_idProvincias', 'provincias.idProvincias')
                    ->join('regiones', 'provincias.regiones_idRegiones', 'regiones.idRegiones')
                    ->where([
                        ['regiones.idRegiones', '=', $region],
                        ['actas.fechaSesion', 'LIKE', $annio . '-%']
                    ])
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }
            }

        }

        if ($request->input('tipo_sol') == 4) {

            $cod_proyecto = $request->input('cod_proyecto');

            $proyectos = DB::table('proyectos')
                ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                ->where('proyectos.codProyecto', '=', $cod_proyecto)
                ->get();

            $num = $proyectos->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
            } else {
                $num = '';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));

            }
        }

        if ($request->input('tipo_sol') == 5) {
            $num_certificado = $request->input('num_certificado');

            $proyectos = DB::table('proyectos')
                ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                ->where('proyectos.numCertificado', '=', $num_certificado)
                ->get();

            $num = $proyectos->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
            } else {
                $num = '';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));

            }
        }

        if ($request->input('tipo_sol') == 6) {

            $monto = $request->input('monto');
            $opcion = $request->input('opciones');
            if ($opcion == 'mayor') {
                $signo_opcion = '>';
            } elseif ($opcion == 'menor') {
                $signo_opcion = '<';
            } else {
                $signo_opcion = '=';
            }

            $proyectos = DB::table('proyectos')
                ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                ->where('proyectos.montoProyecto', $signo_opcion, $monto)
                ->get();

            $num = $proyectos->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
            } else {
                $num = '';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));

            }
        }

        if ($request->input('tipo_sol') == 7) {

            $proyecto = $request->input('nombre_proyecto');
            $provincia = $request->input('prov');

            $proyectos = DB::table('proyectos')
                ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                ->join('provincias', 'comunas.provincias_idProvincias', 'provincias.idProvincias')
                ->where([
                    ['provincias.idProvincias', '=', $provincia],
                    ['proyectos.nombreProyecto', 'LIKE', '%' . $proyecto . '%']
                ])
                ->get();

            $num = $proyectos->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
            } else {
                $num = '';
                return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
            }

        }

        if ($request->input('tipo_sol') == 8) {

            $annio = $request->input('annio_sesion');
            $cir = $request->input('cir');

            if ($request->input('annio_sesion') == 'Todos') {

                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('circunscripciones', 'comunas.circunscripciones_idCirc', 'circunscripciones.idCirc')
                    ->where('circunscripciones.idCirc', '=', $cir)
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }

            } else {
                $proyectos = DB::table('proyectos')
                    ->join('actas', 'proyectos.actas_idActas', 'actas.idActas')
                    ->join('comunas', 'proyectos.comunas_idComunas', 'comunas.idComunas')
                    ->join('circunscripciones', 'comunas.circunscripciones_idCirc', 'circunscripciones.idCirc')
                    ->where([
                        ['circunscripciones.idCirc', '=', $cir],
                        ['actas.fechaSesion', 'LIKE', $annio . '-%']
                    ])
                    ->get();

                $num = $proyectos->count();

                if ($num == 0) {
                    $num = 'NO SE ENCONTRARON REGISTROS';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                } else {
                    $num = '';
                    return view('back_end.proyectos.filtrar', compact('proyectos', 'num'));
                }
            }

        }

    }

    public function mostrar_ficha(Request $request)
    {
        $id_proy = $request->input('id_proyecto');

        $proyectos = DB::table('proyectos')
            ->join('actas','proyectos.actas_idActas','actas.idActas')
            ->join('comunas', 'comunas.idComunas', 'proyectos.comunas_idComunas')
            ->join('circunscripciones', 'circunscripciones.idCirc', 'comunas.circunscripciones_idCirc')
            ->where('idProyecto', $id_proy)
            ->first();

        return view('back_end.proyectos.ficha', compact('proyectos'));

    }

    public function guardar_presentacion(Request $request)
    {

        $tipo = 'PresentacionProyecto';
        $annio = date("Y");
        $file = $request->file('doc_digital');
        $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/StorageCore/', $name);

        DB::table('proyectos')
            ->where('idProyecto', $request->input('id_proyecto'))
            ->update(['urlPresProy' => $name]);

        return redirect('/Proyecto/Filtro');

    }

}
