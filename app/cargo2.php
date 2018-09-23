<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class cargo2 extends Authenticatable
{
    use Notifiable;
    use ShinobiTrait;
    protected $table= "cargo";
    protected $primaryKey = "ID_Cargo";
    protected $fillable = ['Nombre_Cargo','Descripcion','Salario_Base','ID_Area','Activo'];

    public $timestamps=true;



}




