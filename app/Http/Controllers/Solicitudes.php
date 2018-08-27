<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DB;

class Solicitudes extends Controller
{

    public function formulario_ingreso_nuevo()
    {

        $actas = DB::table('actas')
            ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
            ->where('actas.estadoActa', 1)
            ->get();

        $consejeros = DB::table('consejeros')
            ->where('estadoConsejeros', '=', 1)
            ->OrderBy('nombreConsejeros', 'ASC')
            ->get();

        return view('back_end.solicitudes.nuevo', compact('actas', 'consejeros'));

    }

    public function guardar_ingreso_nuevo(Request $request)
    {

        $tipo = 'SolicitudesSala';
        $annio = date("Y");
        $file = $request->file('doc_digital');
        $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/StorageCore/', $name);

        DB::table('solicitudes')->insert([
            'fechaCreaSolicitud' => new DateTime(),
            'solicitudDirigido' => $request->input('dirigido_a'),
            'fechaEnvioSolicitud' => $request->input('fecha_envio'),
            'urlCertificadoSolicitud' => $name,
            'obsSolicitud' => $request->input('obs_solicitud'),
            'estadoSolicitud' => 1,
            'actas_idActas' => $request->input('id_sesion'),
            'Consejeros_idConsejeros' => $request->input('id_consejero'),
            'users_id' => $request->input('id_func'),
        ]);

        return back()->with('status', '¡Solicitud almacenada correctamente!');
    }

    public function filtros_muestras()
    {
        return view('back_end.solicitudes.filtros');
    }

    public function filtrar_muestras(Request $request)
    {

        if ($request->input('tipo_sol') == 1) {

            $solicitudes = DB::table('solicitudes')
                ->join('actas', 'solicitudes.actas_idActas', '=', 'actas.idActas')
                ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
                ->where([
                    ['estadoSolicitud', '<>', 3],
                    ['estadoSolicitud', '<>', 4]
                ])
                ->orderby('fechaEnvioSolicitud')
                ->get();

            $num = $solicitudes->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.solicitudes.filtrar', compact('solicitudes', 'num'));
            } else {
                $num = '';
                return view('back_end.solicitudes.filtrar', compact('solicitudes', 'num'));
            }


        } elseif ($request->input('tipo_sol') == 2) {

            $solicitudes = DB::table('solicitudes')
                ->join('actas', 'solicitudes.actas_idActas', '=', 'actas.idActas')
                ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
                ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
                ->where([
                    ['estadoSolicitud', '<>', 1],
                    ['estadoSolicitud', '<>', 2]
                ])
                ->orderby('fechaEnvioSolicitud')
                ->get();


            $num = $solicitudes->count();

            if ($num == 0) {
                $num = 'NO SE ENCONTRARON REGISTROS';
                return view('back_end.solicitudes.archivo', compact('solicitudes', 'num'));
            } else {
                $num = '';
                return view('back_end.solicitudes.archivo', compact('solicitudes', 'num'));
            }
        }

    }

    public function ficha_solicitud(Request $request)
    {

        $idSolicitud = $request->input('idSolicitud');

        $solicitudes = DB::table('solicitudes')
            ->join('actas', 'solicitudes.actas_idActas', '=', 'actas.idActas')
            ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
            ->join('comisiones', 'actas.comisiones_idComisiones', 'comisiones.idComisiones')
            ->join('users', 'solicitudes.users_id', 'users.id')
            ->where('solicitudes.idSolicitudes', '=', $idSolicitud)
            ->first();

        $documentos = DB::table('documentos')
            ->where('solicitudes_idSolicitudes', '=', $idSolicitud)
            ->get();

        $num_docs = DB::table('documentos')
            ->where('solicitudes_idSolicitudes', '=', $idSolicitud)
            ->count();

        $date = new datetime($solicitudes->fechaComision);
        $date2 = new datetime('now');
        $dif = $date->diff($date2);

        if ($dif->format('%a') >= 30) {
            $btn_arc_sr = 1;
        } else {
            $btn_arc_sr = 0;
        }

        $gestiones = DB::table('gestiones')
            ->join('users', 'gestiones.users_id', 'users.id')
            ->where('solicitudes_idSolicitudes', '=', $idSolicitud)
            ->get();

        return view('back_end.solicitudes.ficha_solicitud', compact('solicitudes', 'documentos', 'gestiones', 'btn_arc_sr', 'num_docs'));

    }

    public function nuevo_documento(Request $request)
    {
        $tipo = 'DocumentoSolicitud';
        $annio = date("Y");
        $file = $request->file('doc_digital');
        $name = $annio . '-' . $tipo . '-' . time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/StorageCore/', $name);

        DB::table('documentos')->insert([
            'fecCargaDocumento' => new DateTime,
            'nombreDocumento' => $request->input('nombre_documento'),
            'urlDocumento' => $name,
            'solicitudes_idSolicitudes' => $request->input('idSolicitud')
        ]);

        return redirect('/Solicitud/Filtro');
    }

    public function nueva_gestion(Request $request)
    {

        DB::table('gestiones')->insert([
            'fechaGestion' => new DateTime,
            'gestion' => $request->input('gestion'),
            'solicitudes_idSolicitudes' => $request->input('idSolicitud'),
            'users_id' => Auth::id()
        ]);

        return redirect('/Solicitud/Filtro');
    }

    public function cerrar_gestion(Request $request)
    {
        $idSolicitud = $request->input('idSolicitud');

        DB::table('solicitudes')
            ->where('idSolicitudes', '=', $idSolicitud)
            ->update(['estadoSolicitud' => 2]);

        return redirect('/Solicitud/Filtro');
    }

    public function archivar_gestion(Request $request)
    {
        $idSolicitud = $request->input('idSolicitud');

        DB::table('solicitudes')
            ->where('idSolicitudes', '=', $idSolicitud)
            ->update(['estadoSolicitud' => 3]);

        return redirect('/Solicitud/Filtro');
    }

    public function archivar_gestion_sr(Request $request)
    {
        $idSolicitud = $request->input('idSolicitud');

        DB::table('solicitudes')
            ->where('idSolicitudes', '=', $idSolicitud)
            ->update(['estadoSolicitud' => 4]);

        return redirect('/Solicitud/Filtro');
    }
}
