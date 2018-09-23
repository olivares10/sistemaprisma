<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Traits\ShinobiTrait;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class area extends Authenticatable
{
    //
      use Notifiable;
    use ShinobiTrait;
    protected $table= "area";
    protected $primaryKey ="ID_Area";
    protected $fillable = ['Dependencia','Nombre','Descripcion'];

    public $timestamps=true;

  
}

