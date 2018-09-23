<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Planilla_Periodo extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

     protected $table= "planilla_periodo";
     protected $primaryKey ="ID";
     protected $fillable = ['ID','Mes','Ano','Periodo','ACTIVO'];
 
     public $timestamps=true;
}


