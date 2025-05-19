<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Material Corporativo
        Permission::create([
        	'name' 			=> 'Gestor de Archivos.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo.index',
        	'description' 	=> 'Módulo para la gestion de archivos.'
        ]);

        Permission::create([
        	'name' 			=> 'Creación de nuevos apartados.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo_Separador.create',
        	'description' 	=> 'Crear nuevos separadores.'
        ]);
        Permission::create([
        	'name' 			=> 'Edición de apartados.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo_Separador.edit',
        	'description' 	=> 'Editar separadores existentes.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar apartados.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo_Separador.destroy',
        	'description' 	=> 'Eliminar separadores existentes.'
        ]);

        Permission::create([
        	'name' 			=> 'Subir nuevos archivos.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo.create',
        	'description' 	=> 'Subir archivos a las secciones por departamento.'
        ]);

        Permission::create([
        	'name' 			=> 'Eliminar archivos.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo.destroy',
        	'description' 	=> 'Eliminar archivos.'
        ]);

        Permission::create([
        	'name' 			=> 'Descargar archivos.',
            'group'         => 'Gestor_Archivo',
        	'slug' 			=> 'Gestor_Archivo.download',
        	'description' 	=> 'Descargar archivos.'
        ]);

        //imagenes del banner
        Permission::create([
        	'name' 			=> 'Imagenes del Banner.',
            'group'         => 'Banner',
        	'slug' 			=> 'Banner.index',
        	'description' 	=> 'Módulo para la gestion de imagenes para el banner.'
        ]);

        Permission::create([
        	'name' 			=> 'Subir imagenes.',
            'group'         => 'Banner',
        	'slug' 			=> 'Banner.create',
        	'description' 	=> 'subir nuevas imagenes.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar imagenes.',
            'group'         => 'Banner',
        	'slug' 			=> 'Banner.destroy',
        	'description' 	=> 'Eliminar imagenes activas.'
        ]);


        //Galeria
        Permission::create([
        	'name' 			=> 'Gestor de Galeria.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria.index',
        	'description' 	=> 'Módulo para la gestion de la galeria.'
        ]);

        Permission::create([
        	'name' 			=> 'Creación de nuevos albums.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria_Album.create',
        	'description' 	=> 'Crear nuevos álbums.'
        ]);
        Permission::create([
        	'name' 			=> 'Edición de álbums.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria_Album.edit',
        	'description' 	=> 'Editar álbums existentes.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar álbums.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria_Album.destroy',
        	'description' 	=> 'Eliminar álbums existentes.'
        ]);

        Permission::create([
        	'name' 			=> 'Subir nuevas imagenes.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria.create',
        	'description' 	=> 'Subir imagenes a los álbums.'
        ]);

        Permission::create([
        	'name' 			=> 'Eliminar imagenes.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria.destroy',
        	'description' 	=> 'Eliminar imagenes.'
        ]);

        Permission::create([
        	'name' 			=> 'Descargar imagenes.',
            'group'         => 'Galeria',
        	'slug' 			=> 'Galeria.download',
        	'description' 	=> 'Descargar imagenes.'
        ]);

        //Avisos
        Permission::create([
        	'name' 			=> 'Avisos.',
            'group'         => 'Aviso',
        	'slug' 			=> 'Aviso.index',
        	'description' 	=> 'Módulo para la gestion de avisos y/o noticias.'
        ]);

        Permission::create([
        	'name' 			=> 'Crear avisos.',
            'group'         => 'Aviso',
        	'slug' 			=> 'Aviso.create',
        	'description' 	=> 'generar nuevos avisos.'
        ]);
        Permission::create([
        	'name' 			=> 'Editar avisos.',
            'group'         => 'Aviso',
        	'slug' 			=> 'Aviso.edit',
        	'description' 	=> 'Editar avisos existentes.'
        ]);
        Permission::create([
        	'name' 			=> 'Ver avisos.',
            'group'         => 'Aviso',
        	'slug' 			=> 'Aviso.show',
        	'description' 	=> 'Visualizar avisos existentes.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar avisos.',
            'group'         => 'Aviso',
        	'slug' 			=> 'Aviso.destroy',
        	'description' 	=> 'Eliminar avisos existentes.'
        ]);


        //Recordatorios y/o fases
        Permission::create([
        	'name' 			=> 'Recordatorios y/o Frases.',
            'group'         => 'Recordatorio',
        	'slug' 			=> 'Recordatorio.index',
        	'description' 	=> 'Módulo para el registro de recordatorio y/o frases.'
        ]);
        Permission::create([
        	'name' 			=> 'Crear recordatorio.',
            'group'         => 'Recordatorio',
        	'slug' 			=> 'Recordatorio.create',
        	'description' 	=> 'Crear recordatorio y/o frase.'
        ]);
        Permission::create([
        	'name' 			=> 'Editar recordatorio.',
            'group'         => 'Recordatorio',
        	'slug' 			=> 'Recordatorio.edit',
        	'description' 	=> 'Editar recordatorio y/o frase.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar recordatorio.',
            'group'         => 'Recordatorio',
        	'slug' 			=> 'Recordatorio.destroy',
        	'description' 	=> 'Eliminar recordatorio y/o frase.'
        ]);

         //Incidencias
        Permission::create([
        	'name' 			=> 'Incidencias.',
            'group'         => 'Sin_Incidente',
        	'slug' 			=> 'Sin_Incidente.index',
        	'description' 	=> 'Módulo para el registro de incidencias.'
        ]);
        Permission::create([
        	'name' 			=> 'Registrar incidencia.',
            'group'         => 'Sin_Incidente',
        	'slug' 			=> 'Sin_Incidente.create',
        	'description' 	=> 'Crear una nueva incidencia.'
        ]);
        Permission::create([
        	'name' 			=> 'Editar incidencia.',
            'group'         => 'Sin_Incidente',
        	'slug' 			=> 'Sin_Incidente.edit',
        	'description' 	=> 'Editar incidencia.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar incidencia.',
            'group'         => 'Sin_Incidente',
        	'slug' 			=> 'Sin_Incidente.destroy',
        	'description' 	=> 'Eliminar incidencia.'
        ]);

        //Usuarios
        Permission::create([
        	'name' 			=> 'Usuarios.',
            'group'         => 'User',
        	'slug' 			=> 'User.index',
        	'description' 	=> 'Módulo para la gestion de roles para usuarios.'
        ]);
        Permission::create([
        	'name' 			=> 'Asignar nuevo rol.',
            'group'         => 'User',
        	'slug' 			=> 'User.edit',
        	'description' 	=> 'Asigna un nuevo rol para el usuario.'
        ]);
        Permission::create([
        	'name' 			=> 'Crear un nuevo rol.',
            'group'         => 'User',
        	'slug' 			=> 'Rol.create',
        	'description' 	=> 'Crear una nuevo rol.'
        ]);
        Permission::create([
        	'name' 			=> 'Editar rol.',
            'group'         => 'User',
        	'slug' 			=> 'Rol.edit',
        	'description' 	=> 'Editar rol.'
        ]);
        Permission::create([
        	'name' 			=> 'Eliminar rol.',
            'group'         => 'User',
        	'slug' 			=> 'Rol.destroy',
        	'description' 	=> 'Eliminar rol.'
        ]);

        //Calendario
        Permission::create([
        	'name' 			=> 'Eliminar reservaciones.',
            'group'         => 'Calendario',
        	'slug' 			=> 'Reservacion.destroy',
        	'description' 	=> 'Sección para eliminar reservaciones.'
        ]);

    }
}
