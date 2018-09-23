<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Liquidacion_causas extends Authenticatable
{
    //
    use Notifiable;
    use ShinobiTrait;
    protected $table= "area";
    protected $primaryKey ="ID";
    protected $fillable = ['Causa'];

    public $timestamps=true;
}
