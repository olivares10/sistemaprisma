<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class detalle_proyecto extends Authenticatable
{
    use Notifiable;
    use ShinobiTrait;

     protected $table= "detalle_proyecto";
     protected $primaryKey ="ID_DETALLE_PROYECTO";
     protected $fillable = ['ID_PROYECTO','ID_EMPLEADO','Oficial','ACTIVO'];
 
     public $timestamps=true;
}
