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

        $sesiones = DB::table('sesiones')
            ->where([
                ['estadoSesion', '=', 1],
                //  ['tipoSesion', '=', 'Comision']
            ])
            ->OrderBy('numeroSesion', 'ASC')
            ->OrderBy('fechaSesion', 'DESC')
            ->get();

        $comisiones = DB::table('comisiones')
            ->where('estadoComisiones', '=', 1)
            ->OrderBy('nombreComisiones', 'ASC')
            ->get();

        $consejeros = DB::table('consejeros')
            ->where('estadoConsejeros', '=', 1)
            ->OrderBy('nombreConsejeros', 'ASC')
            ->get();

        return view('back_end.solicitudes.nuevo', compact('sesiones', 'comisiones', 'consejeros'));

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
            'sesiones_idSesiones' => $request->input('id_sesion'),
            'comisiones_idComisiones' => $request->input('id_comision'),
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
                ->join('sesiones', 'solicitudes.sesiones_idSesiones', 'sesiones.idSesiones')
                ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
                ->join('comisiones', 'solicitudes.comisiones_idComisiones', 'comisiones.idComisiones')
                ->where('solicitudes.estadoSolicitud', '<>', 3)
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
                ->join('sesiones', 'solicitudes.sesiones_idSesiones', 'sesiones.idSesiones')
                ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
                ->join('comisiones', 'solicitudes.comisiones_idComisiones', 'comisiones.idComisiones')
                ->where('solicitudes.estadoSolicitud', '=', 3)
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
            ->join('sesiones', 'solicitudes.sesiones_idSesiones', 'sesiones.idSesiones')
            ->join('consejeros', 'solicitudes.Consejeros_idConsejeros', 'consejeros.idConsejeros')
            ->join('comisiones', 'solicitudes.comisiones_idComisiones', 'comisiones.idComisiones')
            ->join('users', 'solicitudes.users_id', 'users.id')
            ->where('solicitudes.idSolicitudes', '=', $idSolicitud)
            ->first();

        $documentos = DB::table('documentos')
            ->where('solicitudes_idSolicitudes', '=', $idSolicitud)
            ->get();

        $gestiones = DB::table('gestiones')
            ->join('users', 'gestiones.users_id', 'users.id')
            ->where('solicitudes_idSolicitudes', '=', $idSolicitud)
            ->get();

        return view('back_end.solicitudes.ficha_solicitud', compact('solicitudes', 'documentos', 'gestiones'));

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
}
