<?php

namespace App;

//uuse Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class proyectos extends Authenticatable
{
    use Notifiable;
    use ShinobiTrait;

     protected $table= "proyectos";
     protected $primaryKey ="ID_PROYECTO";
     protected $fillable = ['NOMBRE_PROYECTO','DESCRIPCION','RESPONSABLE','FECHA_INICIO','FECHA_FIN_ESTIMADO','FECHA_FIN','ACTIVO'];
 
     public $timestamps=true;
}
