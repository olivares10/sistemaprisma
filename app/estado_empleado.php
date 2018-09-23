<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Traits\ShinobiTrait;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class estado_empleado extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    //protected $table= "vw_empleados";
     //protected $primarykey="ID_EMPLEADO";
     protected $table= "Estado_Empleado";
     protected $primaryKey ="ID_ESTADO";
     protected $fillable = ['ID_ESTADO','NOMBRE'];
     //'NO_INSS','CEDULA','DIRECCION','ANIOS_EXPERIENCIA','ESTADO_CIVIL','FECHA_INGRESO','VACACIONES_DISPONIBLES','Telefono','Celular','Email','Imagen'];
 
     public $timestamps=true;
 
}

