<?php

namespace App;

///use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class planilla_produccion extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "planilla_produccion";
    protected $primaryKey ="ID";
    protected $fillable = ['ID_Equipo' , 'ID_Actividad', 'Descripcion', 'Cantidad' , 'Precio_U',
     'Salario_Parcial','TotalDias_laborados','TotalSalario_parcial'];

    public $timestamps=true;
}


