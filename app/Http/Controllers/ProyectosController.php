<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\proyectos;
use App\detalle_proyecto;
use App\bitacora;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProyectosFormReques;
use Carbon\Carbon;
use DB;

use Response;
use Illuminate\Support\Collection;


class ProyectosController extends Controller
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
            $proyecto=DB::table('proyectos as p')
            ->join('empleado as e','p.RESPONSABLE','=','e.ID_EMPLEADO') 
            ->select('p.ID_PROYECTO','p.NOMBRE_PROYECTO' ,'p.DESCRIPCION','P.FECHA_INICIO','P.FECHA_FIN_ESTIMADO','p.FECHA_FIN','e.PRIMER_APELLIDO as Responsable')            
            ->where('p.NOMBRE_PROYECTO','like','%'.$query.'%') 
            ->orwhere('e.PRIMER_APELLIDO','like','%'.$query.'%')           
            ->orwhere ('p.DESCRIPCION','like','%'.$query.'%')   
            ->orwhere ('e.PRIMER_APELLIDO','like','%'.$query.'%')   
            ->orderby('NOMBRE_PROYECTO','desc')
            ->paginate(20);
            return view('proyectos.index',["proyectos"=>$proyecto,"searchText"=>$query]);
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
        ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_ESTADO','=','1')->get();       
       
        return view('proyectos.create',["empleados"=>$empleado]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    public function store(ProyectosFormReques $request)
    {
        //
        try{
            DB::beginTransaction();
            $proyecto=new proyectos;
            $proyecto->NOMBRE_PROYECTO=$request->get('NOMBRE_PROYECTO');
            $proyecto->DESCRIPCION=$request->get('DESCRIPCION');
            $proyecto->RESPONSABLE=$request->get('piresponsalbe');
            $proyecto->FECHA_INICIO=$request->get('FECHA_INICIO');
            $proyecto->FECHA_FIN_ESTIMADO=$request->get('FECHA_FIN_ESTIMADO');
            $proyecto->FECHA_FIN=$request->get('FECHA_FIN');
            $proyecto->Activo='1';
            $proyecto->save();
          
            $NOMBRE_PROYECTO=$request->get('NOMBRE_PROYECTO');
            $FECHA=Carbon::today();

            $detalle_U='Encargado del proyecto: '.$NOMBRE_PROYECTO;
            $Bitacora_U = new bitacora();                
            $Bitacora_U->ID_EMPLEADO=$request->get('piresponsalbe');
            $Bitacora_U->Detalle=$detalle_U;
            $Bitacora_U->Fecha=$FECHA;      
            $Bitacora_U->save();

            
            $ID_EMPLEADO=$request->get('ID_EMPLEADOS');
            $Oficial=$request->get('Oficial');    
                        
            $detalle_P='Agregado al proyecto: '.$NOMBRE_PROYECTO;
            $cont = 0 ;

            while($cont < count($ID_EMPLEADO)){
                $detalle = new detalle_proyecto();
                $detalle->ID_PROYECTO=$proyecto->ID_PROYECTO;
                $detalle->ID_EMPLEADO=$ID_EMPLEADO[$cont];
                $detalle->Oficial=$Oficial[$cont];
                $detalle->ACTIVO=1;
                $detalle->save();

                $Bitacora_E = new bitacora();                
                $Bitacora_E->ID_EMPLEADO=$ID_EMPLEADO[$cont];
                $Bitacora_E->Detalle=$detalle_P;
                $Bitacora_E->Fecha=$FECHA;
                //$Bitacora_E->ACTIVO=1;
                $Bitacora_E->save();


                $cont=$cont+1;
            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }

        return Redirect::to('/proyectos');
    }
    public function agregar_empleado(Request $request)
    {
        //crea un nuevo usuario en el sistema    
        $detalle=new detalle_proyecto;
        $detalle->ID_PROYECTO=$request->get('ID_PROYECTO');
        $detalle->ID_EMPLEADO=$request->get('ID_EMPLEADO2');
        $detalle->save();     
        // if($usuario->save())
        // {     
        //   return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente") ;
        // }
        // else
        // {
        //     return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
        // }
    
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
        $proyectos=DB::table('proyectos as p')
        ->join('empleado as e','p.RESPONSABLE','=','e.ID_EMPLEADO') 
        ->select('p.ID_PROYECTO','p.NOMBRE_PROYECTO' ,'p.DESCRIPCION','P.FECHA_INICIO','P.FECHA_FIN_ESTIMADO','p.FECHA_FIN',
        'e.PRIMER_APELLIDO as Responsable')
        ->where('p.ID_PROYECTO','=',$id)
        ->first() ;

            $detalles=DB::table('detalle_proyecto as dp')
            ->join('proyectos as p','p.ID_PROYECTO','=','dp.ID_PROYECTO') 
            ->where('p.ID_PROYECTO','=',$id)
            ->get();
        return view('/proyectos.show',["proyectos"=>$proyectos,"detalles"=>$detalles]);
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
        // $proyecto=proyectos::findOrFail($id);
        $proyectos=DB::table('proyectos as p')
        ->join('empleado as e','p.RESPONSABLE','=','e.ID_EMPLEADO') 
       
        ->select('p.ID_PROYECTO','p.NOMBRE_PROYECTO' ,'p.DESCRIPCION',DB::raw('DATE(P.FECHA_INICIO) as FECHA_INICIO'),DB::raw('DATE(P.FECHA_FIN_ESTIMADO) as FECHA_FIN_ESTIMADO'),'p.FECHA_FIN',
        'p.RESPONSABLE as RESPONSABLE')
        
        ->where('p.ID_PROYECTO','=',$id)
        ->first() ;

 
        $proyectodetalle=DB::table('detalle_proyecto as dp')
        ->join('proyectos as p', 'dp.ID_PROYECTO','=','p.ID_PROYECTO')
        ->join('empleado as e', 'dp.ID_EMPLEADO','=','e.ID_EMPLEADO')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')
        ->select ('e.Cod_Empleado','dp.ID_DETALLE_PROYECTO','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('p.ID_PROYECTO','=',$id)
        ->where('dp.ACTIVO','=','1')
        ->where('e.ID_ESTADO','=','1')->get();
    
        
        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')
        // ->select ('e.Cod_Empleado','e.ID_EMPLEADO','e.PRIMER_NOMBRE','e.SEGUNDO_NOMBRE','e.PRIMER_APELLIDO','e.SEGUNDO_APELLIDO','c.ID_Cargo','c.Nombre_Cargo')
        ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_ESTADO','=','1')->get();

   

        return view('/proyectos.edit',["proyectos"=>$proyectos,"empleados"=>$empleado,"empleadodetalle"=>$proyectodetalle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editempleProy($id)
    {   
      
        $detalles=DB::table('detalle_proyecto as dp')
        ->join('proyectos as p','p.ID_PROYECTO','=','dp.ID_PROYECTO') 
        ->select('p.ID_PROYECTO','p.NOMBRE_PROYECTO','dp.ID_EMPLEADO')
        ->where('dp.ID_DETALLE_PROYECTO','=',$id)
        ->first();

        $NOMBRE_PROYECTO=$detalles->NOMBRE_PROYECTO;
        $ID_EMPLEADO=$detalles->ID_EMPLEADO;
        $ID_PROYECTO=$detalles->ID_PROYECTO;
        $FECHA=Carbon::today();

        $proyecto=detalle_proyecto::findOrFail($id);       
        $proyecto->Activo=0;
        $proyecto->update();

        $detalle_U='Desvinculado del proyecto: '.$NOMBRE_PROYECTO;
        $Bitacora_E = new bitacora();                
        $Bitacora_E->ID_EMPLEADO=$ID_EMPLEADO;
        $Bitacora_E->Detalle=$detalle_U;
        $Bitacora_E->Fecha=$FECHA;
        //$Bitacora_E->ACTIVO=1;
        $Bitacora_E->save();

        return redirect()->action('ProyectosController@edit', ['id' => $ID_PROYECTO]);

    

    }
    public function update(ProyectosFormReques $request, $id)
    {
        //
        $proyecto=proyectos::findOrFail($id);
        $proyecto->NOMBRE_PROYECTO=$request->get('NOMBRE_PROYECTO');
        $proyecto->DESCRIPCION=$request->get('DESCRIPCION');
        $proyecto->FECHA_INICIO=$request->get('FECHA_INICIO');
        $proyecto->FECHA_FIN=$request->get('FECHA_FIN');
        $proyecto->FECHA_FIN_ESTIMADO=$request->get('FECHA_FIN_ESTIMADO');  
        $proyecto->Activo='1';
        $proyecto->save();
        return Redirect::to('/proyectos');
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
        $proyecto=proyectos::findOrFail($id);
        $proyecto->Activo='0';
        $proyecto->update();
        return Redirect::to('/proyectos');
    }
}
