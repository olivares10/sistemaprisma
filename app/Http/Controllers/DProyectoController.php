<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\proyectos;
use App\detalle_proyecto;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;

use DB;

use Response;
use Illuminate\Support\Collection;

class DProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ID_PROYECTO2=$request->get('ID_PROYECTO2');

        $detalle=new detalle_proyecto;
        
        $detalle->ID_PROYECTO=$request->get('ID_PROYECTO2');
        $detalle->ID_EMPLEADO=$request->get('ID_EMPLEADO2');
        $detalle->save();  

        $proyectos=DB::table('proyectos as p')
        ->join('empleado as e','p.RESPONSABLE','=','e.ID_EMPLEADO') 
        ->select('p.ID_PROYECTO','p.NOMBRE_PROYECTO' ,'p.DESCRIPCION',DB::raw('DATE(P.FECHA_INICIO) as FECHA_INICIO'),DB::raw('DATE(P.FECHA_FIN_ESTIMADO) as FECHA_FIN_ESTIMADO'),'p.FECHA_FIN',
        'p.RESPONSABLE as RESPONSABLE')
        ->where('p.ID_PROYECTO','=',$ID_PROYECTO2)
        ->first() ;
        
        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')
        // ->select ('e.Cod_Empleado','e.ID_EMPLEADO','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO','e.SEGUNDO_APELLIDO','c.ID_Cargo','c.Nombre_Cargo')
        ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_ESTADO','=','1')->get();
        return view('/proyectos.edit',["proyectos"=>$proyectos,"empleados"=>$empleado]);

        
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
