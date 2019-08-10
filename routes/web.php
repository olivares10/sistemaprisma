<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	
	Route::get('/home', 'HomeController@index');
    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');    
    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');
  

    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');
    
    
    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{ID}', 'UsuariosController@borrar_rol');


    Route::get('/listado_empleados', 'EmpleadosController@listado_empleados');
    Route::get('form_editar_empleado/{ID_EMPLEADO}', 'EmpleadosController@form_editar_empleado'); 
    Route::get('form_nuevo_empleado', 'EmpleadosController@form_nuevo_Empleado');
    Route::post('buscar_empleado', 'EmpleadosController@buscar_empleado');

    Route::get('importExport', 'MaatwebsiteDemoController@importExport');
    Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
    Route::get('downloadExcelA/{type}', 'MaatwebsiteDemoController@downloadExcelA');
    Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');


   // Route::get('/listado_areas', 'AreasController2@listado_areas');
    Route::resource('/areas', 'areaController');
    Route::resource('/cargos', 'CargoController');
    Route::resource('/Tipos_A', 'Tipo_ActividadesController');
    Route::resource('/Actividades', 'ActividadesController');
    Route::resource('/Periodo', 'PeriodoController');
    Route::resource('/empleados', 'EmpleadoController');
    Route::resource('/proyectos', 'ProyectosController');
    Route::resource('/dproyectos', 'DProyectoController');
    Route::resource('/planillas', 'PlanillaController');
    Route::resource('/lista_negra', 'lista_negraController');
    Route::resource('/Planilla_Empleado', 'PlanillaEController');
    Route::resource('/planilla_ciclo', 'Planilla_cicloController');
    Route::resource('/asistencia', 'AsistenciaController');
    Route::resource('/Liquidacion', 'LiquidacionController');
    Route::resource('/LiquidacionV', 'LiquidacionVController');
    Route::resource('/Aguinaldo', 'AguinaldoController');
    Route::resource('/vacaciones', 'VacacionesController');    

    Route::get('detalleEmpleado/{ID}', 'EmpleadoController@detalleEmpleado');
    Route::get('asignarUsuario/{ID}', 'EmpleadoController@asignarUsuario');

    Route::get('editsumproduccionO/{ID}', 'Planilla_cicloController@editsumproduccionO');
    Route::get('editsumproduccionA/{ID}', 'Planilla_cicloController@editsumproduccionA');
    Route::get('editrestproduccion/{ID}', 'Planilla_cicloController@editrestproduccion'); 
    Route::get('editempleProy/{ID}', 'ProyectosController@editempleProy');

    Route::get('detalleProduccion/{ID}', 'Planilla_cicloController@detalleProduccion');

    Route::get('crearequipoO/{ID}', 'Planilla_cicloController@crearequipoO');
    Route::get('crearequipoA/{ID}', 'Planilla_cicloController@crearequipoA');

    Route::get('createplanillaProyectoO/{ID}', 'Planilla_cicloController@createplanillaProyectoO')->name('CicloCC.ProyectoO');
    
    
    Route::get('createplanillaProyectoA/{ID}', 'Planilla_cicloController@createplanillaProyectoA');
    Route::get('createplanillaProyecto/{ID}', 'Planilla_cicloController@createplanillaProyecto');
    Route::get('editplanillaAdmin/{ID}', 'Planilla_cicloController@editpe');

    Route::get('editsumplanillaAdmin/{ID}', 'Planilla_cicloController@editpesum');
    Route::get('editsumplanilla/{ID}', 'PlanillaController@editpesum');
    Route::get('editsumplanillaO/{ID}', 'Planilla_cicloController@editpesumO');
    Route::get('editsumplanillaA/{ID}', 'Planilla_cicloController@editpesumA');

    Route::get('adplanillaPersonal/{ID}', 'Planilla_cicloController@adplanillaPersonal');
    Route::get('createplanillaAdmin/{ID}', 'Planilla_cicloController@createplanillaAdmin');
    Route::post('storeplanilla', 'Planilla_cicloController@store2');
    Route::get('New_aguinaldo', 'AguinaldoController@New_aguinaldo');
    Route::get('createplanilla/{ID}', 'Planilla_cicloController@create2');
    Route::get('detalleciclo/{ID}', 'Planilla_cicloController@index2');
    Route::get('Listado_A', 'AguinaldoController@index');
    Route::get('editplanilla/{ID}', 'PlanillaController@editpe');    

    
    Route::get('ProyecA/{ID}', 'AsistenciaController@index2');
    Route::get('Pdetalle/{ID}', 'AsistenciaController@Pdetalle');
    Route::get('PdetalleD/{ID}', 'AsistenciaController@dasistenciaingDias');
    Route::get('delete_fecha/{ID}', 'AsistenciaController@delete_fecha');

    Route::get('vtowns/{ID_Area}','EmpleadoController@getTowns');
    Route::get('index2PlanillaE/{ID}', 'PlanillaEController@index2');
    //Procedimientos almacenados "store procedure"
    Route::get('SP_AplicarPlanilla/{ID}', 'Planilla_cicloController@SP_AplicarPlanilla');
    Route::get('SP_AplicarPlanillaF/{ID}', 'Planilla_cicloController@SP_AplicarPlanillaF');
    Route::get('SP_AplicarAguinaldoF/{ID}', 'AguinaldoController@SP_AplicarAguinaldoF');
    Route::post('AplicarActividades', 'Planilla_cicloController@AplicarActividades');
    Route::post('SPPlanilla_EquipoO', 'Planilla_cicloController@SPPlanilla_EquipoO');
    Route::post('SPPlanilla_EquipoA', 'Planilla_cicloController@SPPlanilla_EquipoA');
    Route::post('SPPlanilla_Personal', 'Planilla_cicloController@SPPlanilla_Personal');
    Route::post('GuardarDiasL', 'AsistenciaController@SPGuardarDiasL');

    Route::post('agregar_empleado', 'ProyectosController@agregar_empleado');
    Route::post('spNuevaPlanilla', 'PlanillaController@spplanilla');
    Route::post('speditplanilla', 'PlanillaController@editplanilla_procedure');
    Route::post('speditplanillaAdmin', 'Planilla_cicloController@editplanilla_procedure');
    Route::post('eliminarplanilla', 'PlanillaController@planillaDelete');
    //Route::get('cargo/{ID_Area}', 'AreasController@getArea');
    //Route::get('/listado_areas', 'EmpleadosController@listado_areas');
    Route::post('spliquidacionSF', 'LiquidacionController@spliquidacionSF');
    Route::post('spliquidacionSV', 'LiquidacionVController@spliquidacionSV');
    Route::post('empleadoUser', 'EmpleadoController@empleadoUser');
});

