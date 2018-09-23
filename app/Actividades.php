<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Actividades extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "actividades";
    protected $primaryKey ="ID";
    protected $fillable = ['Codigo','Descripcion','Precio','ID_Tipo'];

    public $timestamps=true;
}
