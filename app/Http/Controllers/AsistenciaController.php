<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\proyectos;
use App\Asistencia;
use App\DAsistencia;
use App\detalle_proyecto;
use App\vw_Planilla;
 /**use App\Planilla_Detalle;
use App\Planilla_Periodo;
use App\Planilla;
use App\planilla_produccion;
use App\Equipo_produccion_planilla;
*/
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
       // dd($name);
      if (\Auth::user()->can('Proyect_asistencia')){
        $query=trim($request->get('searchText'));
        $planilla=DB::table('vw_planilla_total')     
        ->select('ID','Periodo' ,'Mes','Ano','Activo')  
        //->where ('Activo','=','Valido')        
        //->where ('Mes','like','%'.$query.'%')   
        //->orwhere('Periodo','like','%'.$query.'%')           
       // ->orwhere ('ano','like','%'.$query.'%')   
                
        ->orderby('ID','desc')
        ->paginate(20);
        
        return view('asistencia.index',["planilla"=>$planilla,"searchText"=>$query]);
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","No tienes permiso para este modulo") ;
    }
    }


    public function index2($id)
    {
        //
       
        
      if (\Auth::user()->can('Proyect_asistencia')){

       
        $iduser= \Auth::user()->id;
        $proyecto=DB::table('proyectos as p')     
        ->select('pl.ID','p.ID_PROYECTO','p.NOMBRE_PROYECTO','p.DESCRIPCION')  
        ->join('planilla as pl', 'p.ID_PROYECTO','=','pl.ID_PROYECTO')        
        ->join('empleado as e','p.RESPONSABLE','=','e.ID_EMPLEADO')
        ->join('users as u', 'e.ID_User','=','u.id')
        ->where ('u.id','=',$iduser)        
        ->where ('pl.periodo','=',$id)   
        //->orwhere('Periodo','like','%'.$query.'%')           
        //->orwhere ('ano','like','%'.$query.'%')   
          
        ->orderby('p.ID_PROYECTO','desc')
        ->paginate(20);
          
        //dd($proyecto);
        return view('asistencia.index2',["proyecto"=>$proyecto]);
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","No tienes permiso para este modulo") ;
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Pdetalle($id)
    {
        //
       // dd($id);     
      if (\Auth::user()->can('Proyect_asistencia')){

        /*$proyectodetalle=DB::table('detalle_proyecto as dp')
        ->join('proyectos as p', 'dp.ID_PROYECTO','=','p.ID_PROYECTO')  
        ->join('planilla as pl', 'p.ID_PROYECTO','=','pl.ID_PROYECTO')
        ->join('asistencia as asp', 'pl.ID','=','asp.ID_PLANILLA')  
        ->join('empleado as e', 'd.ID_EMPLEADO','=','e.ID_EMPLEADO')
        ->join('cargo as c','e.ID_CARGO','=','c.ID_Cargo')*/
        $proyectodetalle=DB::table('asistencia as asp')
        ->join('empleado as e', 'asp.ID_EMPLEADO','=','e.ID_EMPLEADO')
        ->join('cargo as c','e.ID_CARGO','=','c.ID_Cargo')

        ->select ('asp.ID_ASISTENCIA','e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('asp.ID_PLANILLA','=',$id)
        ->where('asp.ANULADO','=','0')
        ->where('e.ID_ESTADO','=','1')->get();   
       
        return view('asistencia.detalleProyecA',["empleadodetalle"=>$proyectodetalle]);
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","No tienes permiso para este modulo") ;
    }
    }
    public function create()
    {
        //
    }
    public function dasistenciaingDias($id)
    {
      
       // dd($id);     
      if (\Auth::user()->can('Proyect_asistencia')){


        $data=DB::table('asistencia as asp')
        ->join('empleado as e', 'asp.ID_EMPLEADO','=','e.ID_EMPLEADO')
        ->join('cargo as c','e.ID_CARGO','=','c.ID_Cargo')
        ->select ('asp.ID_PLANILLA','asp.HORAS_LABORADAS','asp.ID_ASISTENCIA','e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('asp.ID_ASISTENCIA','=',$id)       
        ->where('e.ID_ESTADO','=','1')->get()->first();  

        $data2=DB::table('asistencia as asp')
        ->join('detalle_asistencia as da', 'asp.ID_ASISTENCIA','=','da.ID_ASISTENCIA')
        ->select ('da.ID_DETALLE','asp.ID_ASISTENCIA','da.FECHA','da.HORAS_LABORADAS','asp.HORAS_EXTRAS','da.HORA_LLEGADA','da.HORA_SALIDA')
        ->where('asp.ID_ASISTENCIA','=',$id)
        ->where('da.ANULADO','=','0')->get(); 
       //dd($data2);
        return view('asistencia.dasistenciaingDias',["data"=>$data,"data2"=>$data2]);
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","No tienes permiso para este modulo") ;
    }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function SPGuardarDiasL(Request $request)
    {
        //INGRESO DE DIAS TRABAJADOS
        try{
            
            /*$ID_asistencia=$request->get('ID_asistencia'); 
            $Asistencia=Asistencia::findOrFail($ID_asistencia);
            $Asistencia->HORAS_LABORADAS=($request->get('TOTALHORAS'))+($request->get('HL'));
            $Asistencia->update();*/

            DB::beginTransaction();

            $ID_asistencia=$request->get('ID_asistencia');
            $FECHA=$request->get('datepicker'); 
            $H_E=$request->get('time');  
            $H_S=$request->get('time2');
            $H_L=$request->get('resta');
            
//dd($FECHA);
            $cont = 0 ;

            while($cont < count($FECHA)){
                
                $sql = "call SPDetalle_Asist(?,?,?,?,?)";
                DB::select($sql,array($ID_asistencia,$FECHA[$cont],$H_E[$cont],$H_S[$cont],$H_L[$cont]));
                $cont=$cont+1;


            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }

        
        $ID_asistencia=$request->get('ID_asistencia');
        
        $sql = "call updateAsistenciaP(?)";       
        DB::select($sql,array($ID_asistencia));

        return redirect()->action('AsistenciaController@dasistenciaingDias', ['id' => $ID_asistencia]);
         
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

    public function delete_fecha($id)
    {
        //
        $planilla=DAsistencia::findOrFail($id);
        $planilla->ANULADO='1';
        $planilla->update();

        $Asistencia=DB::table('detalle_asistencia')   
        ->select('ID_ASISTENCIA','HORAS_LABORADAS') 
        ->where('ID_DETALLE','=',$id)->first()  ;
        $ID_A= $Asistencia->ID_ASISTENCIA; 
        $HORAS= $Asistencia->HORAS_LABORADAS;

        $selectA=DB::table('asistencia')   
        ->select('HORAS_LABORADAS') 
        ->where('ID_ASISTENCIA','=',$ID_A)->first()  ;
        $HORAS2= $selectA->HORAS_LABORADAS;        
        $HORAS_LABORADAS=($HORAS2-$HORAS);
        $Dias_trabajados=($HORAS_LABORADAS/8);

        $upasistencia=Asistencia::findOrFail($ID_A);
        $upasistencia->HORAS_LABORADAS=$HORAS_LABORADAS;
        $upasistencia->Dias_trabajados=$Dias_trabajados;
        $upasistencia->update();
        //dd($ID_A);
        $sql = "call updateAsistenciaP(?)";       
        DB::select($sql,array($ID_A));

        return redirect()->action('AsistenciaController@dasistenciaingDias', ['ID' => $ID_A]);


        //return Redirect::to('/planillas');
    }

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
