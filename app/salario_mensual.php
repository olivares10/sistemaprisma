<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class salario_mensual extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

     protected $table= "proyectos";
     protected $primaryKey ="ID";
     protected $fillable = ['Mes','Ano','ID_EMPLEADO','Dias_trabajados','Salario_O','Septimo_D','Horas_Extras'
     ,'Salario_Extraordinario','Total_Devengado','Inss','Viaticos','Anticipos','Deducciones','Ret_Sindical','Total'];
 
     public $timestamps=true;
}
