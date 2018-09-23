<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Planilla extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

     protected $table= "vw_Planillas";
     protected $primaryKey ="ID";
     protected $fillable = ['ID','Periodo','Mes','Ano'];
 
     public $timestamps=true;
 
}
