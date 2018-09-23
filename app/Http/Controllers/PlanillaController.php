<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\proyectos;
use App\detalle_proyecto;
use App\vw_Planilla;
use App\Planilla_Detalle;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use DB;


class PlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
     
        $query=trim($request->get('searchText'));
        $planilla=DB::table('vw_Planillas')     
        ->select('ID','Periodo' ,'Mes','Ano','Activo','Proyecto')  
        //->where ('Activo','=','Valido')          
        //->orwhere('Periodo','like','%'.$query.'%')           
        //->orwhere ('ano','like','%'.$query.'%')   
        //->orwhere ('Mes','like','%'.$query.'%')          
        ->orderby('ID','desc')
        ->paginate(20);
        return view('planillas.index',["planilla"=>$planilla,"searchText"=>$query]);
        /***
        $query=trim($request->get('searchText'));
        $sql= "select * from vw_Planillas where Periodo='?'  or ano='?' and Activo= 'Valido'  ";
        $planilla=DB::select($sql,array($query,$query));
        return view('planillas.index',["planilla"=>$planilla,"searchText"=>$query]);
        */
    }

      /**
       * */
    public function spplanilla(Request $request)
    {
        $detalle1=$request->get('ID_P');
        $detalle2=$request->get('ID_Periodo');
        $detalle3=$request->get('ID_Mes');
        $detalle4=$request->get('ID_Ano');
        //EmpleadoProyecto(19,1,8,2017)
        $sql = "call EmpleadoProyecto(?,?,?,?)";
        
        DB::select($sql,array($detalle1,$detalle2,$detalle3,$detalle4)); // retorna un array de objetos.
        return Redirect::to('/planillas');
    }

    public function editplanilla_procedure(Request $request)
    {
  
        //
        try{
            DB::beginTransaction();
            
            $id=$request->get('ID_DP');
            $ID_Planilla=$request->get('ID_Planilla');
            $ID_DP=$request->get('ID_DP_N');
            $movimiento=$request->get('movimiento');
            $ID_M=$request->get('ID_M');
            $Detalle=$request->get('Detalle');
            $Cantidad=$request->get('Cantidad1');
            $dinero=$request->get('dinero');
           

            $cont = 0 ;

            while($cont < count($ID_M)){

                $sql = "call detalleplanilla(?,?,?,?,?,?)";
                
                DB::select($sql,array($ID_DP[$cont],$movimiento[$cont],$ID_M[$cont],$Detalle[$cont],$Cantidad[$cont],$dinero[$cont]));
                $cont=$cont+1;
            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }    

        
        return redirect()->action('PlanillaController@edit', [$ID_Planilla]);



        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //      
        $proyectos=DB::table('proyectos')->where('Activo','=','1')->get();
        // $estado_empleados=DB::table('Estado_Empleado')->get();
        return view('planillas.create',["proyectos"=>$proyectos]);
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

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$id)       
         ->paginate(20);
         return view('/planillas.edit',["planillas"=>$planilla]); 
    }

    public function editpe($id)
    {
       

        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        $deducciones=DB::table('deducciones')->get() ;                 
        $otros_ingresos=DB::table('otros_ingresos')->get() ; 

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID','=',$id)       
         ->paginate(20);
         return view('/planillas.dplanilla',["planillas"=>$planilla,"data"=>$data,"deducciones"=>$deducciones,"ingresos"=>$otros_ingresos]); 
    }
    public function editpesum($id)
    {
       

        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        //$deducciones=DB::table('deducciones')->get() ;     
        $otros_ingresos=DB::table('vw_ingresos')     
        ->paginate(100000);
        
       //  $otros_ingresos=DB::table('actividades_tipo as act_t')
        // ->join('actividades as act', 'act_t.ID','=','act.ID_Tipo')
       //  ->select ('act.ID','act.Codigo','act_t.nombre as Tipo',DB::raw('CONCAT(act.Codigo," ",act_t.nombre," ",act.Descripcion) as Ingreso'),'act.Descripcion','act.Precio')
       //   ->where('act.Activo','=','1');

       // $otros_ingresos=DB::table('otros_ingresos')->get() ; 

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID','=',$id)       
         ->paginate(20);
         return view('/planillas.dplanillaing',["planillas"=>$planilla,"data"=>$data,"ingresos"=>$otros_ingresos]); 
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
        $planilla=planilla::findOrFail($id);
        $planilla->Activo='0';
        $planilla->update();
        return Redirect::to('/planillas');
    }
    public function planillaDelete(Request $request)
    {
  
        DB::select('SELECT mifuncion(?, ?, ?)', array($id) );
        return Redirect::to('/planillas');
    }

    public function detalle($id)
    {
        //
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        $deducciones=DB::table('planilla_detalle_empleado as pde')
        ->join('deducciones as d','pde.ID_Movimiento','=','d.ID_DEDUCCION')
        ->select('pde.ID_PD','pde.ID' ,'pde.cantidad','pde.Detalle','pde.Monto','d.NOMBRE as movimiento')
        ->where('pde.ID_PD','=',$id)
        ->orderby('e.ID_Cargo')
        ->paginate(20);

        $ingresos=DB::table('planilla_detalle_empleado as pde')
        ->join('vw_ingresos as i','pde.ID_Movimiento','=','i.ID')
        ->select('pde.ID_PD','pde.ID' ,'pde.cantidad','pde.Detalle','pde.Monto','i.Codigo','i.Tipo','i.Descripcion','i.Ingreso','i.Precio')
        ->orderby('e.ID_Cargo')
        ->paginate(20);

        return view('/planillas.detalle',["data"=>$data,"deducciones"=>$deducciones,"ingresos"=>$ingresos]);
     
    }
}
