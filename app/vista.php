<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Caffeinated\Shinobi\Traits\ShinobiTrait;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class vista extends Authenticatable
{
    //
      use Notifiable;
    use ShinobiTrait;

    protected $table= "vw_empleados";
    protected $primarykey="ID_EMPLEADO";

      protected $table= "empleado";
    protected $primarykey="ID_EMPLEADO";
}