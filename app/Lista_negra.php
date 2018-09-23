<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lista_negra extends Model
{
    //
    use Notifiable;
   // use ShinobiTrait;
    protected $table= "lista_negra";
    protected $primaryKey ="ID_EMPLEADO";
    protected $fillable = ['MOTIVO','FECHA','NOMBRE_AUTORIZACION','ESTADO'];

    public $timestamps=true;
}
