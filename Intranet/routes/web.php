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
/*** Rutas para el login y logout INICIO***/
Route::get('/', 'Auth\LoginController@showLoginForm');

Route::post('login', [ 
	'uses' => 'Auth\LoginController@login',
	'as' => 'Login.login'
]);

Route::get('logout', [ 
	'uses' => 'Auth\LoginController@logout',
	'as' => 'Login.logout'
]);
/*** Rutas para el login y logout FIN***/

Route::group( ['middleware' => 'auth' ], function()
{
	Route::view('/Indice', 'Indice');

	Route::prefix('Usuario')->group(function () {
	    Route::view('/Modulos', 'Modulos');
	    Route::prefix('Modulos')->group(function () {
	    	/** Rutas para la gestión de archivos (Inicio)**/
	    	Route::resource('Gestor_Archivo','Gestor_ArchivoController');
			Route::get('Gestor_Archivo/{id}/destroy', 'Gestor_ArchivoController@destroy')->name('Gestor_Archivo.destroy');
			Route::get('Gestor_Archivo/{id}/download', 'Gestor_ArchivoController@download')->name('Gestor_Archivo.download');

			Route::resource('Gestor_Archivo_Separador','Gestor_Archivo_SeparadorController');
			Route::get('Departament_list','Gestor_Archivo_SeparadorController@Departament_list')->name('Departament_list');
			Route::get('Separator_list/{id}','Gestor_Archivo_SeparadorController@Separator_list')->name('Separator_list');
			Route::get('Gestor_Archivo_Separador/{id}/destroy', 'Gestor_Archivo_SeparadorController@destroy')->name('Gestor_Archivo_Separador.destroy');

			Route::get('Gestor_Archivo_Separador/{id}/Separator_list', 'Gestor_Archivo_SeparadorController@Separator_list')->name('Gestor_Archivo_Separador.Separator_list');
			/** Rutas para la gestión de archivos (Fin)**/


			/** Rutas para la gestión de imagenes del banner (Inicio)**/
			Route::resource('Banner','BannerController');
			Route::get('Banner/{id}/destroy', 'BannerController@destroy')->name('Banner.destroy');
			/** Rutas para la gestión de imagenes del banner (Fin)**/

			/** Rutas para la gestión de imagenes del banner sistemasphp(Inicio)**/
			Route::resource('Banner_Ti','Banner_TiController');
			Route::get('Banner_Ti/{id}/destroy', 'Banner_TiController@destroy')->name('Banner_Ti.destroy');
			/** Rutas para la gestión de imagenes del banner sistemasphp(Fin)**/
			

			/** Rutas para la gestion de galerias (Inicio)**/
			Route::resource('Galeria_Album','Galeria_AlbumController');
			Route::get('Galeria_Album/{id}/destroy', 'Galeria_AlbumController@destroy')->name('Galeria_Album.destroy');

			Route::resource('Galeria','GaleriaController');
			Route::get('Galeria/{id}/destroy', 'GaleriaController@destroy')->name('Galeria.destroy');
			/** Rutas para la gestion de galerias (Fin)**/

			/** Rutas para la gestion de avisos (Inicio)**/
			Route::resource('Aviso','AvisoController');
			Route::get('Aviso/{id}/destroy', 'AvisoController@destroy')->name('Aviso.destroy');
			Route::get('Aviso/{id}/eliminar_archivo', 'AvisoController@eliminar_archivo')->name('Aviso.eliminar_archivo');
			Route::get('Aviso/{id}/eliminar_imagen', 'AvisoController@eliminar_imagen')->name('Aviso.eliminar_imagen');
			Route::get('Aviso/{id}/download', 'AvisoController@download')->name('Aviso.download');
			/** Rutas para la gestion de avisos (Fin)**/

			/** Rutas para la gestion de recordatoios / frases (Inicio)**/
			Route::resource('Recordatorio','RecordatorioController');
			Route::get('Recordatorio/{id}/destroy', 'RecordatorioController@destroy')->name('Recordatorio.destroy');
			/** Rutas para la gestion de recordatoios / frases (Fin)**/

			/** Rutas para la gestion de incidencias / frases (Inicio)**/
			Route::resource('Sin_Incidente','Sin_IncidenteController');
			Route::get('Sin_Incidente/{id}/destroy', 'Sin_IncidenteController@destroy')->name('Sin_Incidente.destroy');
			/** Rutas para la gestion de incidencias / frases (Fin)**/

			/** Rutas para la gestion de incidencias / frases (Inicio)**/
			Route::resource('Usuarios','UserController');
			Route::get('Usuarios/{id}/destroy', 'UserController@destroy')->name('User.destroy');
			Route::resource('Rol','RolController');
			Route::get('Rol/{id}/destroy', 'RolController@destroy')->name('Rol.destroy');
			Route::put('Usuario/{id}/roles', 'UserController@roles')->name('Usuario.roles');
			/** Rutas para la gestion de incidencias / frases (Fin)**/
			
			/** Rutas para la gestion de incidencias / frases (Inicio)**/
			Route::resource('Orden_Mantenimiento','Orden_mantenimientoController');
			Route::get('Orden_Mantenimiento/{id}/get_machines', 'Orden_mantenimientoController@get_machines')->name('Orden_Mantenimiento.get_machines');
			/** Rutas para la gestion de incidencias / frases (Fin)**/
	    });
	});


	Route::view('/Gilatam', 'Gilatam');
	Route::get('EquipoGI', 'DirectorioController@index')->name('EquipoGI.index');
	Route::view('/Material_Corporativo', 'Material_Corporativo');
	Route::view('/Galeria_GI', 'Galeria_GI');
	Route::view('/Fotos', 'Fotos');
	Route::resource('Perfil','PerfilController');



	Route::prefix('Avisos')->group(function () {
		Route::get('/Lista_Avisos', 'AvisoController@avisos')->name('Aviso.avisos');
		Route::get('{slug}', 'AvisoController@ver')->name('Aviso.ver');
	});
});

Route::post('Buzon', function(Illuminate\Http\Request $request){
	try{
		Mail::send('Emails.Buzon', ['request' => $request], function($msj){
	        $msj->subject('Buzón - Intranet');
	        $msj->to('Carmen.Reyes@grupointerconsult.com');
	    });
	    flash('Se ha enviado con exito tu sugerencia.', 'success');

	}catch(Exception $e){
		flash('Lo siento, ha ocurrido un error: '. $e->getMessage(), 'success');
	}
	
    return redirect('/');
})->name('Buzon');



Route::resource('Calendario','CalendarioController');
Route::get('Calendario/{id}/destroy', 'CalendarioController@destroy')->name('Calendario.destroy');



Route::resource('Permisos_Salida','Permisos_SalidaController');
Route::get('salida/{id}', function($id){
	$permiso = App\Permiso_Salida::where('id', $id)->first();
	$pdf = PDF::loadView('Pdf.Permiso_Salida', ['permiso' => $permiso])->setPaper('letter', 'landscape');
	return $pdf->download('Permiso_de_Salida.pdf');
})->name('salida');

Route::post('salida', function(Illuminate\Http\Request $request){
	$pdf = PDF::loadView('Pdf.Permiso_Salida', ['request' => $request])->setPaper('letter', 'portrait');
	return $pdf->download('permiso_salida.pdf');
})->name('salida');

Route::post('solicitud_vacaciones', function(Illuminate\Http\Request $request){
	$pdf = PDF::loadView('Pdf.Solicitud_Vacaciones', ['request' => $request])->setPaper('letter', 'portrait');
	return $pdf->download('solicitud_vacaciones.pdf');
})->name('solicitud_vacaciones');

Route::get('orden_pdf/{id}/{code}', function($id, $code){
	$orden = App\Orden_mantenimiento::find($id);
	$pdf = PDF::loadView('Pdf.Orden_de_Mantenimiento', ['orden' => $orden])->setPaper('letter', 'portrait');
	return $pdf->stream('Orden_'.$code.'.pdf');
})->name('orden_pdf');

Route::get('descargar_foto/{album}/{imagen}', function($album, $imagen){
			return response()->download(public_path("img/Galeria/".$album."/".$imagen)); 
		})->name('descargar_foto');







Route::get('directorio/{opcion}', function($opcion){
	$empleados = App\Empleado_rrhh::select('Names', 'Paternal', 'Maternal', 'departaments.Departament_ES', 'positions.Position_ES', 'Extension', 'Business_phone', 'Business_mail')
	->join('contacts', 'employees.id', '=', 'contacts.Employee_id')
	->join('employee_position', 'employees.id', '=', 'employee_position.Employee_id')
	->join('positions', 'employee_position.Position_id', '=', 'positions.id')
	->join('departaments', 'positions.Departament_id', '=', 'departaments.id')
	->where('employees.Active', 1)
	->orderBy('Departament_ES', 'ASC')
	->get();
	$pdf = PDF::loadView('Pdf.Directorio', ['empleados' => $empleados, 'opcion' => $opcion])->setPaper('letter', 'landscape');
	return $pdf->download('directorio.pdf');
})->name('directorio');





