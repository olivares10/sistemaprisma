<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Tipo_Actividades extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "actividades_tipo";
    protected $primaryKey ="ID";
    protected $fillable = ['Nombre','Especificacion'];

    public $timestamps=true;
}
