<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\empleados;
use App\users;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\EmpleadoFormReques;
use DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function _construct()
     {
         //
     }

    public function index(Request $request)
    {
        //
        if ($request)
        {
        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('cargo as c','e.ID_CARGO','=','c.ID_Cargo')
        ->join('area as a','c.ID_Area','=','a.ID_Area')
        ->join('estado_empleado as est','e.ID_ESTADO','=','est.ID_ESTADO')
        ->leftJoin('lista_negra', 'e.ID_EMPLEADO', '=', 'lista_negra.ID_EMPLEADO')
        ->select('e.ID_EMPLEADO','e.Cod_Empleado','c.Nombre_Cargo as Cargo' ,'a.Nombre as Area','est.ID_ESTADO','est.Nombre as Estado','c.Salario_Base','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO'
        ,'e.SEGUNDO_APELLIDO','e.NO_INSS','e.CEDULA','e.DIRECCION','e.ANIOS_EXPERIENCIA','e.ESTADO_CIVIL','e.FECHA_INGRESO', 'lista_negra.ESTADO as LN'
        ,'e.Sindicalizado',DB::raw("CASE WHEN e.Sindicalizado = 0 THEN 'no' ELSE 'si' END as Sind " ))
        ->where('e.PRIMER_NOMBRE','like','%'.$query.'%') 
        ->orwhere('e.Cod_Empleado','like','%'.$query.'%')
        ->orwhere('e.PRIMER_APELLIDO','like','%'.$query.'%')           
        ->orwhere ('c.Nombre_Cargo','like','%'.$query.'%')   
        ->orwhere ('e.CEDULA','like','%'.$query.'%')   
        ->orderby('e.ID_Cargo')
        ->paginate(20);
        return view('/empleados.index',["empleados"=>$empleado,"searchText"=>$query]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cargos=DB::table('cargo')->where('Activo','=','1')->get();
        $users=DB::table('users')->get();
        // $estado_empleados=DB::table('Estado_Empleado')->get();
        return view('empleados.create',["cargos"=>$cargos,"users"=>$users]);
        // "cargos"=>$cargos,
        
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoFormReques $request)
    {
        //
        $empleado=new empleados;
        $empleado->PRIMER_NOMBRE=$request->get('PRIMER_NOMBRE');
        $empleado->SEGUNDO_NOMBRE=$request->get('SEGUNDO_NOMBRE');
        $empleado->PRIMER_APELLIDO=$request->get('PRIMER_APELLIDO');
        $empleado->SEGUNDO_APELLIDO=$request->get('SEGUNDO_APELLIDO');
        $empleado->ID_CARGO=$request->get('ID_Cargo_ID');
        $empleado->NO_INSS=$request->get('NO_INSS');
        $empleado->CEDULA=$request->get('CEDULA');
        $empleado->DIRECCION=$request->get('DIRECCION');
        $empleado->ANIOS_EXPERIENCIA=$request->get('ANIOS_EXPERIENCIA');
        $empleado->ESTADO_CIVIL=$request->get('ESTADO_CIVIL');
        $empleado->Email=$request->get('Email');
        $empleado->Telefono=$request->get('Telefono');
        $empleado->Celular=$request->get('Celular');
        $empleado->FECHA_INGRESO=$request->get('FECHA_INGRESO');
        $empleado->Salario_Base=$request->get('Salario_Base'); 
        $empleado->Sindicalizado='0';
        $empleado->ID_User=$request->get('ID_User'); 
        $empleado->Cod_Empleado='000';
        $empleado->Salario_V='0';
        $empleado->ID_ESTADO='1';
        $empleado->save();
        return Redirect::to('/empleados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('/empleados.show',["empleado"=>empleados::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=empleados::findOrFail($id);
        $cargo=DB::table('cargo')->where('activo','=','1')->get();
        $estado_empleados=DB::table('Estado_Empleado')->get();
        $users=DB::table('users')->get();
        return view('/empleados.edit',["empleados"=>$empleado,"cargos"=>$cargo,"estado_empleados"=>$estado_empleados,"users"=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoFormReques $request, $id)
    {
        //
       
        $empleado=empleados::findOrFail($id);
        $empleado->PRIMER_NOMBRE=$request->get('PRIMER_NOMBRE');
        $empleado->SEGUNDO_NOMBRE=$request->get('SEGUNDO_NOMBRE');
        $empleado->PRIMER_APELLIDO=$request->get('PRIMER_APELLIDO');
        $empleado->SEGUNDO_APELLIDO=$request->get('SEGUNDO_APELLIDO');
        $empleado->ID_CARGO=$request->get('ID_Cargo');
        $empleado->NO_INSS=$request->get('NO_INSS');
        $empleado->CEDULA=$request->get('CEDULA');
        $empleado->DIRECCION=$request->get('DIRECCION');
        $empleado->ANIOS_EXPERIENCIA=$request->get('ANIOS_EXPERIENCIA');
        $empleado->ESTADO_CIVIL=$request->get('ESTADO_CIVIL');
        $empleado->Email=$request->get('Email');
        $empleado->Telefono=$request->get('Telefono');
        $empleado->Celular=$request->get('Celular');
        $empleado->FECHA_INGRESO=$request->get('FECHA_INGRESO');
        $empleado->Salario_Base=$request->get('Salario_Base'); 
        $empleado->ID_ESTADO=$request->get('ID_ESTADO');    
        $empleado->ID_User=$request->get('ID_User'); 
        $empleado->Cod_Empleado->get('Cod_Empleado');  
        //$empleado->Sindicalizado=$request->get('Sindicalizado'); 
        $Sindicalizado=$request->get('Sindicalizado');
        if ($Sindicalizado == 'on')
        {
            $empleado->Sindicalizado='1';
        }
        
        else
        
        {
            $empleado->Sindicalizado='0';
        }
        $SalarioVariable=$request->get('Salario_V');
        if ($SalarioVariable == 'on')
        {
            $empleado->Salario_V='1';
        }
        
        else
        
        {
            $empleado->Salario_V='0';
        }
        $empleado->update();

        
        return Redirect::to('/empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=empleados::findOrFail($id);
        
          $empleado->ID_ESTADO='0';
          $empleado->update();
          return Redirect::to('/empleados');
    }
}
