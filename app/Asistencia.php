<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Asistencia extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;

    protected $table= "asistencia";
    protected $primaryKey ="ID_ASISTENCIA";
    protected $fillable = ['ID_EMPLEADO','ID_PROYECTO','ID_PLANILLA','HORAS_LABORADAS','ANULADO'];

    public $timestamps=true;
}
