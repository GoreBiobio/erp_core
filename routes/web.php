<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('vendor.adminlte.auth.login');
});

Route::group(['middleware' => 'auth'], function () {
///////////////////
/// ///     ACTAS
/// ///
//////////////////
    Route::get('/Acta/Nuevo', 'Actas@formulario_ingreso_nuevo');
    Route::post('/Acta/Guardar', 'Actas@guardar_ingreso_nuevo');
    Route::get('/Acta/Filtro', 'Actas@filtros_muestras');
    Route::post('/Acta/Filtrar', 'Actas@filtrar_muestras');

///////////////////
/// ///     INFORMES
/// ///
//////////////////
    Route::get('/InformesCom/Nuevo', 'Informes@formulario_ingreso_nuevo_com');
    Route::get('/InformeSComision/Nuevo', 'Informes@formulario_ingreso_nuevo_subcom');
    Route::post('/Informes/Guardar', 'Informes@guardar_ingreso_nuevo');
    Route::get('/InformesCom/Filtro', 'Informes@filtros_muestras_com');
    Route::get('/InformeSComision/Filtro', 'Informes@filtros_muestras_subcom');
    Route::post('/Informes/Filtrar', 'Informes@filtrar_muestras');

///////////////////
/// ///     PROYECTOS
/// ///
//////////////////
    Route::get('/Proyecto/Nuevo', 'Proyectos@formulario_ingreso_nuevo');
    Route::post('/Proyecto/Guardar', 'Proyectos@guardar_ingreso_nuevo');
    Route::get('/Proyecto/Filtro', 'Proyectos@filtros_muestras');
    Route::post('/Proyecto/Filtrar', 'Proyectos@filtrar_muestras');
    Route::post('/Proyecto/Ficha', 'Proyectos@mostrar_ficha');
    Route::post('/Proyecto/NuevoDocumento', 'Proyectos@guardar_presentacion');

///////////////////
/// ///     SOLICITUDES
/// ///
//////////////////
    Route::get('/Solicitud/Nuevo', 'Solicitudes@formulario_ingreso_nuevo');
    Route::post('/Solicitud/Guardar', 'Solicitudes@guardar_ingreso_nuevo');
    Route::get('/Solicitud/Filtro', 'Solicitudes@filtros_muestras');
    Route::post('/Solicitud/Filtrar', 'Solicitudes@filtrar_muestras');
    Route::post('/Solicitud/Ficha', 'Solicitudes@ficha_solicitud');
    Route::post('/Solicitud/NuevoDocumento', 'Solicitudes@nuevo_documento');
    Route::post('/Solicitud/NuevaGestion', 'Solicitudes@nueva_gestion');
    Route::post('/Solicitud/Cerrar', 'Solicitudes@cerrar_gestion');
    Route::post('/Solicitud/Archivar', 'Solicitudes@archivar_gestion');
    Route::post('/Solicitud/ArchivarSR', 'Solicitudes@archivar_gestion_sr');

///////////////////
/// ///     INVITACIONES
/// ///
//////////////////

    Route::get('/Agenda/Ver', 'Mantenedores@agenda_ver');
    Route::get('/Agenda/Nuevo', 'Mantenedores@agenda_nuevo');
    Route::post('/Agenda/Guardar', 'Mantenedores@agenda_guarda_nuevo');
    Route::post('/Agenda/Eliminar', 'Mantenedores@agenda_guarda_eliminar');

///////////////////
/// ///     CORES
/// ///
//////////////////

    Route::get('/Galeria/Ver', 'Mantenedores@ver_fotos_cores');

///////////////////
/// ///
/// ///
//////////////////
    Route::get('/Mantenedor/Areas', 'Mantenedores@formulario_ingreso_nuevo_areas');
    Route::post('/Mantenedor/Areas/Guardar', 'Mantenedores@guardar_ingreso_nuevo_areas');
    Route::post('/Mantenedor/Areas/Suspender', 'Mantenedores@suspender_areas');
    Route::post('/Mantenedor/Areas/Activar', 'Mantenedores@activar_areas');

    Route::get('/Mantenedor/Consejeros', 'Mantenedores@formulario_ingreso_nuevo_consejero');
    Route::post('/Mantenedor/Consejeros/Guardar', 'Mantenedores@guardar_ingreso_nuevo_consejero');
    Route::post('/Mantenedor/Consejeros/Suspender', 'Mantenedores@suspender_consejeros');
    Route::post('/Mantenedor/Consejeros/Activar', 'Mantenedores@activar_consejeros');

    Route::get('/Mantenedor/Comisiones', 'Mantenedores@formulario_ingreso_nuevo_comisiones');
    Route::post('/Mantenedor/Comisiones/Guardar', 'Mantenedores@guardar_ingreso_nuevo_comisiones');
    Route::post('/Mantenedor/Comisiones/Suspender', 'Mantenedores@suspender_comisiones');
    Route::post('/Mantenedor/Comisiones/Activar', 'Mantenedores@activar_comisiones');

    Route::get('/Mantenedor/Usuarios', 'Mantenedores@formulario_ingreso_nuevo_usuarios');
    Route::post('/Mantenedor/Usuarios/Guardar', 'Mantenedores@guardar_ingreso_nuevo_usuarios');
    Route::post('/Mantenedor/Usuarios/Suspender', 'Mantenedores@suspender_usuarios');
    Route::post('/Mantenedor/Usuarios/Activar', 'Mantenedores@activar_usuarios');

    Route::post('/Mantenedor/Promocion', 'Mantenedores@promocion');

    Route::get('AcercaDe', 'Mantenedores@acercade');

});
