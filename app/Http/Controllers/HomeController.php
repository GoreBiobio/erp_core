<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\Http\Requests;
use Illuminate\Http\Request;
use function Sodium\library_version_major;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        $num_tramite = DB::table('solicitudes')
            ->where('estadoSolicitud', 1)
            ->count();

        ///////

        $solicitudes = DB::table('solicitudes')
            ->join('actas', 'solicitudes.actas_idActas', 'actas.idActas')
            ->where('estadoSolicitud', 1)
            ->get();

        $sum = 0;

        foreach ($solicitudes as $sol) {
            $date = new datetime($sol->fechaComision);
            $date2 = new datetime('now');
            $dif = $date->diff($date2);

            if ($dif->format('%a') >= 30) {
                $sum = $sum + 1;
            } else {
                $sum = $sum + 0;
            }
        }

        ///////////

        $num_concluido = DB::table('solicitudes')
            ->where('estadoSolicitud', 2)
            ->count();

        $num_archivo_sr = DB::table('solicitudes')
            ->where('estadoSolicitud', 4)
            ->count();

        $num_archivo = DB::table('solicitudes')
            ->where('estadoSolicitud', 3)
            ->count();

        return view('adminlte::home', compact('num_tramite', 'sum', 'num_concluido', 'num_archivo_sr', 'num_archivo'));
    }
}
