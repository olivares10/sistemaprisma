<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\empleados;
use App\area;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;


class EmpleadosController extends Controller
{
 

public function listado_empleados(){
    //presenta un listado de usuarios paginados de 100 en 100
	$empleados=empleados::paginate(30);    
    $area=area::paginate(30);   
	return view("listados.listado_empleados")->with("empleados",$empleados)->with("area",$area);
}
public function buscar_empleado(Request $request)
{
	$dato=$request->input("dato_buscado");
	$empleados=empleados::where("Nombre","like","%".$dato."%")->orwhere("area","like","%".$dato."%")                                              ->paginate(100);
	return view('listados.listado_empleados')->with("empleados",$empleados);
 }

public function form_editar_empleado($ID_EMPLEADO){
     $empleados=empleados::find(ID_EMPLEADO);
    //$usuario=User::find($ID_EMPLEADO);
    //$roles=Role::all();
    return view("formularios.form_editar_empleado")->with("empleados",$empleados);
	                                                                             
}

public function form_nuevo_Empleado(){
    //carga el formulario para agregar un nuevo usuario
    $roles=Role::all();
    $area= area:: pluck('Nombre','ID_Area')->prepend('selecciona');
    return view("formularios.form_nuevo_empleado")->with("roles",$roles);
     return view("formularios.form_nuevo_empleado",['area'=>$area]);

}



public function crear_Empleado(Request $request){
    //crea un nuevo usuario en el sistema



	$usuario=new User;
	$usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
	$usuario->telefono=$request->input("telefono");
	$usuario->email=$request->input("email");
	$usuario->password= bcrypt( $request->input("password") ); 
 
            
    if($usuario->save())
    {

  
      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}

}
