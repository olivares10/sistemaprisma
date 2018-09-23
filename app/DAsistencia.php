<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DAsistencia extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    //protected $table= "vw_empleados";
     //protected $primarykey="ID_EMPLEADO";
     protected $table= "detalle_asistencia";
     protected $primaryKey ="ID_DETALLE";
     protected $fillable = ['ID_ASISTENCIA','FECHA','HORA_LLEGADA','HORA_SALIDA','HORAS_LABORADAS','ANULADO'];
 
    // public $timestamps=true;
}
