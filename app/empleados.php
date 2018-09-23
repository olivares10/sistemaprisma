<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Traits\ShinobiTrait;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class empleados extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    //protected $table= "vw_empleados";
     //protected $primarykey="ID_EMPLEADO";
     protected $table= "empleado";
     protected $primaryKey ="ID_EMPLEADO";
     protected $fillable = ['ID_CARGO','ID_ESTADO','PRIMER_NOMBRE','SEGUNDO_NOMBRE','PRIMER_APELLIDO','SEGUNDO_APELLIDO',
     'NO_INSS','CEDULA','DIRECCION','ANIOS_EXPERIENCIA','ESTADO_CIVIL','FECHA_INGRESO','VACACIONES_DISPONIBLES','Telefono',
     'Celular','Email','Imagen','Salario_Base','Sindicalizado','Salario_V','ID_User'];
 
     public $timestamps=true;
 
}

