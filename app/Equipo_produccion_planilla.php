<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Equipo_produccion_planilla extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    //protected $table= "vw_empleados";
     //protected $primarykey="ID_EMPLEADO";
     protected $table= "equipo_produccion_planilla";
     protected $primaryKey ="ID";
     protected $fillable = ['Tipo_produccion','Equipo','ID_PLANILLA','ID_EMPLEADO'];
     //'NO_INSS','CEDULA','DIRECCION','ANIOS_EXPERIENCIA','ESTADO_CIVIL','FECHA_INGRESO','VACACIONES_DISPONIBLES','Telefono','Celular','Email','Imagen'];
 
     public $timestamps=true;
}
