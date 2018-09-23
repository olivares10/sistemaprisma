<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Lista_negra;
use App\empleados;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Lista_negraFormReques;

use DB;



class Lista_negraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request)
        {
        $query=trim($request->get('searchText'));
        $empleado=DB::table('empleado as e')
        ->join('cargo as c','e.ID_CARGO','=','c.ID_Cargo')
        ->join('area as a','c.ID_Area','=','a.ID_Area')        
        ->Join('lista_negra', 'e.ID_EMPLEADO', '=', 'lista_negra.ID_EMPLEADO')
        ->select('e.ID_EMPLEADO','e.Cod_Empleado','c.Nombre_Cargo as Cargo' ,'a.Nombre as Area','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO'
        ,'e.SEGUNDO_APELLIDO','e.CEDULA', 'lista_negra.ESTADO as ELN','lista_negra.NOMBRE_AUTORIZACION','lista_negra.MOTIVO')
       
        ->where('e.PRIMER_NOMBRE','like','%'.$query.'%') 
        ->orwhere('e.Cod_Empleado','like','%'.$query.'%')
        ->orwhere('e.PRIMER_APELLIDO','like','%'.$query.'%')           
        ->orwhere ('c.Nombre_Cargo','like','%'.$query.'%')   
        ->orwhere ('e.CEDULA','like','%'.$query.'%')         
        ->orderby('lista_negra.FECHA')
        ->paginate(1000);
        return view('/lista_negra.index',["empleados"=>$empleado,"searchText"=>$query]);
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
        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')
        // ->select ('e.Cod_Empleado','e.ID_EMPLEADO','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO','e.SEGUNDO_APELLIDO','c.ID_Cargo','c.Nombre_Cargo')
        ->select ('e.Cod_Empleado','e.CEDULA','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->get();

        return view('lista_negra.create',["empleados"=>$empleado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Lista_negraFormReques $request)
    {
        //
        $detalle=new Lista_negra;
        $detalle->ID_EMPLEADO=$request->get('IDEMPLEADO');
        $detalle->MOTIVO=$request->get('MOTIVO');
        $detalle->FECHA=$request->get('FECHA');
        $detalle->NOMBRE_AUTORIZACION=$request->get('NOMBRE_AUTORIZACION');
        $detalle->ESTADO='1';
        $detalle->save();  

        $ID_EMPLEADO=$request->get('IDEMPLEADO');
        $empleado=empleados::findOrFail($ID_EMPLEADO);
        
        $empleado->ID_ESTADO='0';
        $empleado->update();

        return Redirect::to('/lista_negra');
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
        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')
        ->Join('lista_negra', 'e.ID_EMPLEADO', '=', 'lista_negra.ID_EMPLEADO')
        // ->select ('e.Cod_Empleado','e.ID_EMPLEADO','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO','e.SEGUNDO_APELLIDO','c.ID_Cargo','c.Nombre_Cargo')
        ->select ('e.Cod_Empleado','lista_negra.FECHA','lista_negra.NOMBRE_AUTORIZACION','lista_negra.MOTIVO','e.CEDULA','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_EMPLEADO','=',$id) ->get()->first() ;
        return view('lista_negra.edit',["empleados"=>$empleado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Lista_negraFormReques $request, $id)
    {
        //

        $detalle=Lista_negra::findOrFail($id);        
        $detalle->MOTIVO=$request->get('MOTIVO');
        $detalle->FECHA=$request->get('FECHA');
        $detalle->NOMBRE_AUTORIZACION=$request->get('NOMBRE_AUTORIZACION');
        $detalle->update();  
        return Redirect::to('/lista_negra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       // $proyecto=Lista_negra::findOrFail($id);
        //$proyecto->ESTADO='0';
       // $proyecto->delete();
        DB::table('lista_negra')->where('ID_EMPLEADO', '=', $id)->delete();
        return Redirect::to('/lista_negra');
    }
}
