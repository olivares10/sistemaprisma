<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class bitacora extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

    protected $table= "bitacora_empleado";
    protected $primaryKey ="ID";
    protected $fillable = ['ID_EMPLEADO','Detalle','Fecha'];

    public $timestamps=true;
}
