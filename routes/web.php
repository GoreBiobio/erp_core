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

///////////////////
/// ///     PROYECTOS
/// ///
//////////////////
Route::get('/Proyecto/Nuevo', 'Proyectos@formulario_ingreso_nuevo');
Route::post('/Proyecto/Guardar', 'Proyectos@guardar_ingreso_nuevo');
Route::get('/Proyecto/Filtro', 'Proyectos@filtros_muestras');
Route::post('/Proyecto/Filtrar', 'Proyectos@filtrar_muestras');

///////////////////
/// ///     ACTAS
/// ///
//////////////////
Route::get('/Acta/Nuevo', 'Actas@formulario_ingreso_nuevo');
Route::post('/Acta/Guardar', 'Actas@guardar_ingreso_nuevo');
Route::get('/Acta/Filtro', 'Actas@filtros_muestras');
Route::post('/Acta/Filtrar', 'Actas@filtrar_muestras');

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


///////////////////
/// ///
/// ///
//////////////////
Route::get('/Mantenedor/Sesiones', 'Mantenedores@formulario_ingreso_nuevo_sesiones');
Route::post('/Mantenedor/Sesiones/Guardar', 'Mantenedores@guardar_ingreso_nuevo_sesiones');
Route::post('/Mantenedor/Sesiones/Suspender', 'Mantenedores@suspender_sesiones');
Route::post('/Mantenedor/Sesiones/Activar', 'Mantenedores@activar_sesiones');

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

Route::get('AcercaDe', 'Mantenedores@acercade');


Route::group(['middleware' => 'auth'], function () {

});
