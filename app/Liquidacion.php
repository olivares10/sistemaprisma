<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Liquidacion extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "liquidacion";
    protected $primaryKey ="ID";
    protected $fillable = ['ID_Empleado','ID_Causa','Tipo_liquidacion','Dias_vacaciones','Frecuencia_P','Fecha_Inicio','Fecha_Salida'
    ,'Salario_1','Salario_2','Salario_3','Salario_4','Salario_5','Salario_6','Detalle','Neto_Recibir'];

    public $timestamps=true;
}
