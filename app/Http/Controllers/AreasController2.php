<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\area;
use App\cargo;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;


class AreasController extends Controller
{
 
public function listado_areas(){
    //presenta un listado de usuarios paginados de 100 en 100
	//$empleados=empleados::paginate(30);    
    // $area=area::paginate(30);   
	// return view("listados.listado_areas")->with("area",$area);


  $area1= area:: pluck('Nombre','ID_Area')->prepend('selecciona');

     return view('listados.listado_areas',['areaselect'=>$area1]);

}

public function getArea (Request $request, $ID_Area){
    if ($request->ajax()){
        $cargo=cargo::cargo($ID_Area);
        return response()->json($cargo);
    }
}

}
