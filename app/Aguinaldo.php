<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Aguinaldo extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "aguinaldo";
    protected $primaryKey ="ID";
    protected $fillable = ['Descripcion','Fecha_corte'];

    public $timestamps=true;
}
