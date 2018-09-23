<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Liquidacion;
use App\Liquidacion_causa;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LiquidacionFormReques;
use DB;


class LiquidacionController extends Controller
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
            $liquidacion=DB::table('liquidacion')
            ->join('empleado as e', 'liquidacion.ID_EMPLEADO','=','e.ID_EMPLEADO') 
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')  
            ->join('liquidacion_causa as lc', 'liquidacion.ID_Causa','=','lc.ID')
            ->select('liquidacion.ID','e.Cod_Empleado','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'lc.Causa' )  
            ->where('liquidacion.Tipo_liquidacion','=','1')
            ->orderby('liquidacion.created_at','desc')
            ->paginate(1000);

            return view('Liquidacion.index',["liquidacion"=>$liquidacion,"searchText"=>$query]);

        }
    }

    public function lvariable()
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

        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo') 
        ->select ('e.Cod_Empleado','e.FECHA_INGRESO','e.Salario_Base','e.VACACIONES_DISPONIBLES','e.ID_EMPLEADO','e.CEDULA',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_ESTADO','=','1')
        ->where('e.Salario_V','=','0')->get();

        $causa=DB::table('Liquidacion_causa')->get();  
        
        return view('Liquidacion.create',["empleados"=>$empleado,"causas"=>$causa]);
        
    }


    public function spliquidacionSF(LiquidacionFormReques $request)
    {
     
        $ID_Empleado=$request->get('ID_Empleado');        
        $ID_Causa=$request->get('ID_Causa');
        $Frecuencia_P=$request->get('Frecuencia_P');
        $Fecha_Inicio=$request->get('Fecha_Inicio');
        $Fecha_Salida=$request->get('Fecha_Salida');
        $Salario_1=$request->get('Salario_1');
        $Detalle=$request->get('Detalle');
        //dd($Frecuencia_P);

        $sql = "call SP_liquidacionSF(?,?,?,?,?,?,?)";

        DB::select($sql,array($ID_Empleado,$ID_Causa,$Frecuencia_P,$Fecha_Inicio,$Fecha_Salida,$Salario_1,$Detalle));
 
        return redirect()->action('LiquidacionController@index');
        
    }



  
    public function store(Request $request)
    {
        //
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
        $planilla=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo') 
        ->join('liquidacion as l', 'e.ID_EMPLEADO','=','l.ID_EMPLEADO') 
        ->join('liquidacion_detalle as ld', 'l.ID','=','ld.ID_liquidacion') 
        ->select ('e.Cod_Empleado','e.FECHA_INGRESO','e.Salario_Base','e.VACACIONES_DISPONIBLES','e.ID_EMPLEADO','e.CEDULA',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),
        'c.Nombre_Cargo','l.Fecha_Inicio','l.Fecha_Salida','l.Salario_1','l.Neto_Recibir'
        ,'ld.Antiguedad','ld.Dias_Indemnizacion','ld.Indemnizacion','ld.Aguinaldo','ld.Vacaciones','ld.Salario_Proporcional','ld.Ingresos_Brutos','ld.INSS_Vacaciones'
        ,'ld.INSS_Salario','ld.INSS_Total','ld.IR_Salario_Proporcional','ld.IR_Vacaciones','ld.IR_Total')
        ->where('l.Tipo_liquidacion','=','1')
        ->where('l.ID','=',$id)
        ->get()->first();

        return view('/Liquidacion.edit',["liquidacion"=>$planilla]); 
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
