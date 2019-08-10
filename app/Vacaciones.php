<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Vacaciones extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

    protected $table= "detalle_vacaciones";
    protected $primaryKey ="ID_DETALLE_VACACIONES";
    protected $fillable = ['ID_DETALLE_VACACIONES','ID_EMPLEADO','FECHA_SOLICITUD',
    'FECHA_INICIO','FECHA_FIN','detalle','NUMERO_DIAS'];
 
     public $timestamps=true;
}
