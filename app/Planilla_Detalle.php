<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Planilla_Detalle extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

     protected $table= "planilla_detalle";
     protected $primaryKey ="ID";
     protected $fillable = ['ID'];
 
     public $timestamps=true;
}
