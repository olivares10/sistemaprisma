<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\proyectos;
use App\detalle_proyecto;
use App\vw_Planilla;
use App\Planilla_Detalle;
use App\Planilla_Periodo;
use App\Planilla;
use App\planilla_produccion;
use App\Equipo_produccion_planilla;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use DB;


class Planilla_cicloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
      if (\Auth::user()->can('view_planilla')){
        $query=trim($request->get('searchText'));
        $planilla=DB::table('vw_planilla_total')     
        ->select('ID','Periodo' ,'Mes','Ano','Activo')  
        //->where ('Activo','=','Valido')        
        //->where ('Mes','like','%'.$query.'%')   
        //->orwhere('Periodo','like','%'.$query.'%')           
       // ->orwhere ('ano','like','%'.$query.'%')   
                
        ->orderby('ID','desc')
        ->paginate(20);
        return view('planilla_Ciclo.index',["planilla"=>$planilla,"searchText"=>$query]);
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","No tienes permiso para este modulo") ;
    }
    }

    public function index2($id)
    {
        //
        $data=DB::table('planilla_periodo')     
        ->where('ID','=',$id)->get()->first()  ;
        
        $planilla=DB::table('vw_planillas')     
        ->select('ID','Periodo','Proyecto' ,'Mes','Ano','Activo','ID_Periodo','Tipo')  
       ->where('ID_Periodo','=',$id) 
       ->where('ID_T','=',2)   
        ->orderby('ID','desc')
        ->paginate(20);

        $ValidPA=DB::table('vw_planillas') 
        ->select(DB::raw('count(Activo) as Activo')) 
        ->where('ID_Periodo','=',$id) 
        ->where('ID_T','=',2)->get()->first();     
        


        $planilla2=DB::table('vw_planillas')     
        ->select('ID','Periodo','Proyecto' ,'Mes','Ano','Activo','ID_Periodo','Tipo')  
       ->where('ID_Periodo','=',$id) 
       ->where('ID_T','=',1)   
        ->orderby('ID','desc')
        ->paginate(20);
        return view('planilla_Ciclo.index2',["planilla"=>$planilla,"planilla2"=>$planilla2,"data"=>$data,"ValidPA"=>$ValidPA]);

    }

      /**
       * */
    public function spplanilla(Request $request)
    {
        $detalle1=$request->get('ID_P');
        $detalle2=$request->get('ID_Periodo');
        $detalle3=$request->get('ID_Mes');
        $detalle4=$request->get('ID_Ano');
        
        $sql = "call EmpleadoProyecto(?,?,?,?)";
        
        DB::select($sql,array($detalle1,$detalle2,$detalle3,$detalle4)); // retorna un array de objetos.
        return Redirect::to('/planillas');
    }

    
    
    public function SP_AplicarPlanilla($id)
    {
       // $detalle1=$request->get('ID_P');
       
        $data=DB::table('planilla_final')    
        ->select(DB::raw('count(Periodo) as periodo')) 
            ->where('Periodo','=',$id)->get()->first() ;

            $cont= $data->periodo;                             
         
        if ($cont == 0)
        {
            //dd($cont);
        $sql = "call SP_AplicarPlanilla(?,1)";

        DB::select($sql,array($id)); // retorna un array de objetos.
        
        
        $sql2 = "call update_AplicarPlanillaTemp(?)";

        DB::select($sql2,array($id));
       // dd($planilla);

        $planilla=DB::table('new_tbl') 
        ->join('empleado as e', 'new_tbl.ID_EMPLEADO','=','e.ID_EMPLEADO') 
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
        ->select('e.Cod_Empleado','Dias_trabajados','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Precio_Del_Dia','Salario_O','Septimo_D','Horas_Extras','Valor_Horas_E',
        'Salario_Extraordinario','Total_Devengado','Inss','Total_Neto','IR','Viaticos','Anticipos','Deducciones','Ret_Sindical','Total')  
        ->where('Periodo','=',$id) 
        ->paginate(1000);

        $ValidPA = 0;
        
        }
        
        else
        
        {
            $planilla=DB::table('planilla_final') 
            ->join('empleado as e', 'planilla_final.ID_EMPLEADO','=','e.ID_EMPLEADO') 
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
            ->select('e.Cod_Empleado','Dias_trabajados','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Precio_Del_Dia','Salario_O','Septimo_D','Horas_Extras','Valor_Horas_E',
            'Salario_Extraordinario','Total_Devengado','Inss','Total_Neto','IR','Viaticos','Anticipos','Deducciones','Ret_Sindical','Total')  
            ->where('Periodo','=',$id) 
            ->paginate(1000);

            $ValidPA = 1;
        }  


        return view('planilla_Ciclo.planillaAplicada',["planilla"=>$planilla,"periodo"=>$id,"ValidPA"=>$ValidPA]);

    }


    public function SP_AplicarPlanillaF($id)
    {
        $sql = "call SP_AplicarPlanilla(?,2)";
      
        DB::select($sql,array($id));

        $sql = "call SP_SalarioM(?)";
        DB::select($sql,array($id));

        return redirect()->action('Planilla_cicloController@SP_AplicarPlanilla', ['id' => $id]);
        
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
        
        $T_planilla=$request->get('T_planilla');
        $ID_P=$request->get('ID_Planilla');
        switch($T_planilla) {
            case '1'://planilla Administrativa
            return redirect()->action('Planilla_cicloController@createplanillaAdmin', ['id' => $ID_P]);
           /* $data=DB::table('vw_planillas')     
            ->where('ID','=',$ID_P)->get()->first()  ;
    
             $planilla=DB::table('vw_detalleplanilla')     
             ->where('ID_Planilla','=',$ID_P)       
             ->paginate(20);
             return view('/planilla_Ciclo.editdpAdmin',["planillas"=>$planilla,"data"=>$data]); */
                break;
            case '2'://produccion Oficial
            
            $data=DB::table('vw_planillas')     
            ->where('ID','=',$ID_P)->get()->first() ;
    
            $equipos=DB::table('vw_equipo_produccion')   
            ->where('ID_Tipo_produccion','=',1)    
            ->where('ID_PLANILLA','=',$ID_P)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;
    
            $planilla=DB::table('vw_detalleplanilla')     
            ->where('ID_Planilla','=',$ID_P)     
            ->where('Tipo_produccion','=',1) 
            ->orderby('ID','desc') 
            ->paginate(100);
    
                return view('/planilla_Ciclo.editdpEquipoO',["data"=>$data,"equipos"=>$equipos,"planillaOficial"=>$planilla]);
                break;
                case '3'://produccion Auxiliar
                $ID_planilla=$request->get('ID_planilla');

                $data=DB::table('vw_planillas')     
                ->where('ID','=',$ID_P)->get()->first();
        
                $equipos=DB::table('vw_equipo_produccion') 
                ->where('ID_Tipo_produccion','=',2)       
                ->where('ID_PLANILLA','=',$ID_P)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;
        
               $planilla=DB::table('vw_detalleplanilla')     
                ->where('ID_Planilla','=',$ID_P)     
                ->where('Tipo_produccion','=',2)       
                 ->paginate(20);
                 return view('/planilla_Ciclo.editdpEquipoA',["planillaAuxiliar"=>$planilla,"equipos"=>$equipos,"data"=>$data]); 
        
            default:
            return Redirect::back();
            break;
        }

       /* $data=DB::table('vw_planillas')     
        ->where('ID','=',$ID_planilla)->get()->first()  ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$ID_planilla)       
         ->paginate(20);
         return view('/planilla_Ciclo.editdpAdmin',["planillas"=>$planilla,"data"=>$data]);*/ 

         return redirect()->action('Planilla_cicloController@createplanillaAdmin', ['id' => $ID_planilla]);

     }   
    
        

    public function SPPlanilla_Personal(Request $request)
    {  
        //
        try{
            DB::beginTransaction();
            
            
            $ID_P=$request->get('ID');
            $ID_EMPLEADOS=$request->get('ID_EMPLEADOS');           
            $Dias=$request->get('Dias'); 

            $cont = 0 ;

            while($cont < count($ID_EMPLEADOS)){

                $sql = "call Planilla_Personal(?,?,?)";
                
                DB::select($sql,array($ID_P[$cont],$ID_EMPLEADOS[$cont],$Dias[$cont]));
                $cont=$cont+1;
            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }   

        $ID_planilla=$request->get('ID_planilla');

        /*$data=DB::table('vw_planillas')     
        ->where('ID','=',$ID_planilla)->get()->first();

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$ID_planilla)       
         ->paginate(20);
         return view('/planilla_Ciclo.editdpAdmin',["planillas"=>$planilla,"data"=>$data]); */
         return redirect()->action('Planilla_cicloController@createplanillaAdmin', ['id' => $ID_planilla]);
         

    }
    
    public function SPPlanilla_Equipo2(Request $request)
    {  
        //
        try{
            DB::beginTransaction();
            
            
            $ID_P=$request->get('ID');
            $ID_EMPLEADOS=$request->get('ID_EMPLEADOS');           
            $Dias=$request->get('Dias'); 
            $ID_T=$request->get('ID_T');
            $ID_Equipo=$request->get('ID_Equipo');

            $cont = 0 ;

            while($cont < count($ID_EMPLEADOS)){

                $sql = "call Planilla_Equipo(?,?,?,?)";
                
                DB::select($sql,array($ID_T[$cont],$ID_Equipo[$cont],$ID_P[$cont],$ID_EMPLEADOS[$cont],$Dias[$cont]));
                $cont=$cont+1;
            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }   

        $ID_planilla=$request->get('ID_planilla');

        $data=DB::table('vw_planillas')     
       ->where('ID','=',$ID_planilla)->get()->first();

       $planilla=DB::table('vw_detalleplanilla')     
       ->where('ID_Planilla','=',$ID_planilla)       
         ->paginate(20);
        return view('/planilla_Ciclo.editdpEquipoO',["planillas"=>$planilla,"data"=>$data]); 
        

     

    }

    public function SPPlanilla_EquipoO(Request $request)
    {
        //equipo_produccion_planilla
        try{
            DB::beginTransaction();

            $Equipo=new equipo_produccion_planilla;
            $Equipo->Tipo_produccion=$request->get('ID_T');
            $Equipo->Equipo=$request->get('ID_Equipo');
            $Equipo->ID_PLANILLA=$request->get('ID_planilla');
            $Equipo->save();
          
            $ID_EMPLEADOS=$request->get('ID_EMPLEADOS'); 
            $Dias=$request->get('Dias');  
            $ID_P=$request->get('ID_planilla');

            $cont = 0 ;

            while($cont < count($ID_EMPLEADOS)){
                
                $sql = "call Planilla_Equipo(?,?,?,?)";
                DB::select($sql,array($Equipo->ID,$ID_P,$ID_EMPLEADOS[$cont],$Dias[$cont]));
                $cont=$cont+1;


            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }

        
        $ID_planilla=$request->get('ID_planilla');
        /*
        $data=DB::table('vw_planillas')     
        ->where('ID','=',$ID_planilla)->get()->first();

        $equipos=DB::table('vw_equipo_produccion')     
        ->where('ID_Tipo_produccion','=',1)   
        ->where('ID_PLANILLA','=',$ID_planilla)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;

        $planilla=DB::table('vw_detalleplanilla')     
        ->where('ID_Planilla','=',$ID_planilla)     
        ->where('Tipo_produccion','=',1)       
        ->paginate(20);
        return view('/planilla_Ciclo.editdpEquipoO',["planillaOficial"=>$planilla,"equipos"=>$equipos,"data"=>$data]); 
       return view('CicloCC.ProyectoO',['id' =>$ID_planilla]);
        */
        return redirect()->action('Planilla_cicloController@createplanillaProyectoO', ['id' => $ID_planilla]);
         
    }
    

    public function SPPlanilla_EquipoA(Request $request)
    {
        //equipo_produccion_planilla
        try{
            DB::beginTransaction();

            $Equipo=new equipo_produccion_planilla;
            $Equipo->Tipo_produccion=$request->get('ID_T');
            $Equipo->Equipo=$request->get('ID_Equipo');
            $Equipo->ID_PLANILLA=$request->get('ID_planilla');
            $Equipo->save();
          
            $ID_EMPLEADOS=$request->get('ID_EMPLEADOS'); 
            $Dias=$request->get('Dias');  
            $ID_P=$request->get('ID_planilla');

            $cont = 0 ;

            while($cont < count($ID_EMPLEADOS)){
                
                $sql = "call Planilla_Equipo(?,?,?,?)";
                DB::select($sql,array($Equipo->ID,$ID_P,$ID_EMPLEADOS[$cont],$Dias[$cont]));
                $cont=$cont+1;


            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }

        
        
        $ID_planilla=$request->get('ID_planilla');

        
       /* $data=DB::table('vw_planillas')     
        ->where('ID','=',$ID_planilla)->get()->first();

        $equipos=DB::table('vw_equipo_produccion') 
        ->where('ID_Tipo_produccion','=',2)       
        ->where('ID_PLANILLA','=',$ID_planilla)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;

        $planilla=DB::table('vw_detalleplanilla')     
        ->where('ID_Planilla','=',$ID_planilla)     
        ->where('Tipo_produccion','=',2)       
        ->paginate(20);

        return view('/planilla_Ciclo.editdpEquipoA',["planillaAuxiliar"=>$planilla,"equipos"=>$equipos,"data"=>$data]);*/ 
        return redirect()->action('Planilla_cicloController@createplanillaProyectoA', ['id' => $ID_planilla]);
       /** 
       *return redirect()->action( ' Planilla_cicloController@createplanillaProyectoA ', ['id' => $ID_planilla] ); 
       
         
        * return redirect()->route('/Planilla_cicloController@createplanillaProyectoA', ['id' => 42]);*/
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //    
        return view('planilla_Ciclo.create');
    }
    public function create2($id)
    {
        //    
        $data=DB::table('planilla_periodo')     
        ->where('ID','=',$id)->get()->first()  ;

        $proyectos=DB::table('proyectos')->where('Activo','=','1')->get();      
        return view('planilla_Ciclo.create2',["proyectos"=>$proyectos,"data"=>$data]);
        
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
        $planilla=new Planilla_Periodo;
        $planilla->Mes=$request->get('ID_Mes');
        $planilla->Periodo=$request->get('ID_Periodo');
        $planilla->Ano=$request->get('ID_Ano');
        $planilla->ACTIVO='1';
        $planilla->save();
        return Redirect::to('/planilla_ciclo');
    }

    public function store2(Request $request)
    {
        //

        $T_Tipo=$request->get('ID_Tipo');
        //dd($T_Tipo);
        switch($T_Tipo) {                
            case 1://Proyecto
            $id=$request->get('Periodo');

            $planilla=new planilla;
            $planilla->Periodo=$request->get('Periodo');
            $planilla->Tipo=$request->get('ID_Tipo');
            $planilla->ID_PROYECTO=$request->get('ID_P');
            $planilla->ACTIVO='1';
            $planilla->save();  

            $detalle1=$request->get('ID_P');
            $detalle2=$request->get('Periodo');           
            $sql = "call Periodo_asistencia_p(?,?)";
            
            DB::select($sql,array($detalle1,$detalle2)); // retorna un array de objetos.



            return redirect()->action('Planilla_cicloController@index2', ['id' => $id]);
        break;
        case 2://Personal Administrativo

            $id=$request->get('Periodo');

            $planilla=new planilla;
            $planilla->Periodo=$request->get('Periodo');
            $planilla->Tipo=$request->get('ID_Tipo');
            $planilla->ID_PROYECTO=$request->get('ID_P');
            $planilla->ACTIVO='1';
            $planilla->save();  
            return redirect()->action('Planilla_cicloController@index2', ['id' => $id]);

        break;
        default:
        return Redirect::back();
        break;

    }
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

    public function createplanillaAdmin($id)
    {
        $data=DB::table('vw_planillas')     
        ->where('ID','=',$id)->get()->first()  ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$id)       
         ->paginate(20);
         return view('/planilla_Ciclo.editdpAdmin',["planillas"=>$planilla,"data"=>$data]); 
    }  
    public function createplanillaProyecto($id)
    {
        $data=DB::table('vw_planillas')     
        ->where('ID','=',$id)->get()->first()  ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$id)     
         ->where('Tipo_produccion','=',1)  
         ->orderby('ID_EMPLEADO','desc')
         ->paginate(50);

         $planilla1=DB::table('vw_detalleplanilla')     
         ->where('ID_Planilla','=',$id)     
         ->where('Tipo_produccion','=',2)  
         ->orderby('ID_EMPLEADO','desc')
         ->paginate(50);

         return view('/planilla_Ciclo.editdpEquipo',["planillaOficial"=>$planilla,"planillaAuxiliar"=>$planilla1,"data"=>$data]); 
    }  

    public function createplanillaProyectoO($id)
    {
        $data=DB::table('vw_planillas')     
        ->where('ID','=',$id)->get()->first() ;

        $equipos=DB::table('vw_equipo_produccion')   
        ->where('ID_Tipo_produccion','=',1)    
        ->where('ID_PLANILLA','=',$id)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;

        $planilla=DB::table('vw_detalleplanilla')     
        ->where('ID_Planilla','=',$id)     
        ->where('Tipo_produccion','=',1) 
        ->orderby('ID','desc') 
        ->paginate(100);

            return view('/planilla_Ciclo.editdpEquipoO',["data"=>$data,"equipos"=>$equipos,"planillaOficial"=>$planilla]);
        }  
        

        public function createplanillaProyectoA($id)
        {
            $data=DB::table('vw_planillas')     
            ->where('ID','=',$id)->get()->first() ;
    
            $equipos=DB::table('vw_equipo_produccion')   
            ->where('ID_Tipo_produccion','=',2)  
            ->where('ID_PLANILLA','=',$id)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;
    
            $planilla=DB::table('vw_detalleplanilla')     
            ->where('ID_Planilla','=',$id)     
            ->where('Tipo_produccion','=',2) 
            ->orderby('ID','desc') 
            ->paginate(100);
    
                return view('/planilla_Ciclo.editdpEquipoA',["data"=>$data,"equipos"=>$equipos,"planillaAuxiliar"=>$planilla]);
            }  
        public function crearequipoO($id)
        {
            
            $data=DB::table('vw_planillas')     
            ->where('ID','=',$id)->get()->first()  ;

            $data2=DB::table('vw_equipo_produccion') 
            ->select(DB::raw('count(equipo) as Equipo')) 
            ->where('ID_Tipo_produccion','=',1)     
            ->where('ID_PLANILLA','=',$id)->get()->first()  ;
    
            $empleado=DB::table('empleado as e')
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo') 
            ->join('detalle_proyecto as dp', 'e.ID_EMPLEADO','=','dp.ID_EMPLEADO') 
            ->join('vw_planillas as vw', 'dp.ID_PROYECTO','=','vw.ID_PROYECTO') 
            ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('(CASE when (select Dias_trabajados from asistencia where ID_EMPLEADO=`e`.`ID_EMPLEADO` AND  ID_PLANILLA=`vw`.`ID`) IS NULL
            THEN 0
            ELSE  (select Dias_trabajados from asistencia where ID_EMPLEADO=`e`.`ID_EMPLEADO` AND  ID_PLANILLA=`vw`.`ID`)
        END) AS dias'),DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
            ->where('e.ID_ESTADO','=','1')
            ->where('dp.Oficial','=','1')
            ->where('vw.ID','=',$id)->get();
//dd($empleado);
           /* $empleado=DB::table('empleado as e')
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo') 
            ->join('detalle_proyecto as dp', 'e.ID_EMPLEADO','=','dp.ID_EMPLEADO') 
            ->leftJoin('asistencia as as', function($join) {
                $join->on('dp.ID_PROYECTO', '=', 'as.ID_PROYECTO') 
              })
            ->join('vw_planillas as vw', 'dp.ID_PROYECTO','=','vw.ID_PROYECTO') 
           select sum(Salario_parcial)from planilla_produccion where ID_Equipo=12;
            ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw(),DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
            ->where('e.ID_ESTADO','=','1')
            ->where('dp.Oficial','=','1')
            ->where('as.ID_PLANILLA','=',$id)->get();*/

            return view('/planilla_Ciclo.adplanillaEquipoO',["data"=>$data,"data2"=>$data2,"empleados"=>$empleado]);
        }
        
        public function crearequipoA($id)
        {
            $data=DB::table('vw_planillas')     
            ->where('ID','=',$id)->get()->first()  ;

            $data2=DB::table('vw_equipo_produccion') 
            ->select(DB::raw('count(equipo) as Equipo')) 
            ->where('ID_Tipo_produccion','=',2)     
            ->where('ID_PLANILLA','=',$id)->get()->first()  ;
    
            $empleado=DB::table('empleado as e')
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo') 
            ->join('detalle_proyecto as dp', 'e.ID_EMPLEADO','=','dp.ID_EMPLEADO') 
            ->join('vw_planillas as vw', 'dp.ID_PROYECTO','=','vw.ID_PROYECTO') 
            ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('(CASE when (select Dias_trabajados from asistencia where ID_EMPLEADO=`e`.`ID_EMPLEADO` AND  ID_PLANILLA=`vw`.`ID`) IS NULL
            THEN 0
            ELSE  (select Dias_trabajados from asistencia where ID_EMPLEADO=`e`.`ID_EMPLEADO` AND  ID_PLANILLA=`vw`.`ID`)
        END) AS dias'),DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
            ->where('e.ID_ESTADO','=','1')
            ->where('dp.Oficial','=','2')
            ->where('vw.ID','=',$id)->get();

            return view('/planilla_Ciclo.adplanillaEquipoA',["data"=>$data,"data2"=>$data2,"empleados"=>$empleado]);
        }
    public function adplanillaPersonal($id)
    {
        $data=DB::table('vw_planillas')     
        ->where('ID','=',$id)->get()->first()  ;

        $empleado=DB::table('empleado as e')
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')   
        ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo')
        ->where('e.ID_ESTADO','=','1')->get();

         return view('/planilla_Ciclo.adplanillaPersonal',["empleados"=>$empleado,"data"=>$data]); 
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
         return view('/planilla_Ciclo.dplanilla',["planillas"=>$planilla,"data"=>$data,"deducciones"=>$deducciones,"ingresos"=>$otros_ingresos]); 
    }
    public function editpesum($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        //$deducciones=DB::table('deducciones')->get() ;     
        $otros_ingresos=DB::table('vw_ingresos')         
        ->whereIn('ID', [52, 53, 54,55])   
        ->paginate(20);

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID','=',$id)       
         ->paginate(20);
         return view('/planilla_Ciclo.dplanillaing',["planillas"=>$planilla,"data"=>$data,"ingresos"=>$otros_ingresos]); 
    }
    public function editpesumO($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        //$deducciones=DB::table('deducciones')->get() ;     
        $otros_ingresos=DB::table('vw_ingresos')         
        ->whereIn('ID', [52, 53, 54,55])   
        ->paginate(20);

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID','=',$id)       
         ->paginate(20);
         return view('/planilla_Ciclo.dplanillaingO',["planillas"=>$planilla,"data"=>$data,"ingresos"=>$otros_ingresos]); 
    }
    public function editpesumA($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID','=',$id)->get()->first()  ;

        //$deducciones=DB::table('deducciones')->get() ;     
        $otros_ingresos=DB::table('vw_ingresos')         
        ->whereIn('ID', [52, 53, 54,55])   
        ->paginate(20);

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID','=',$id)       
         ->paginate(20);
         return view('/planilla_Ciclo.dplanillaingA',["planillas"=>$planilla,"data"=>$data,"ingresos"=>$otros_ingresos]); 
    }

    public function editsumproduccionO($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID_epp','=',$id)->get()->first()  ;

        $otros_ingresos=DB::table('vw_ingresos')     
        ->paginate(1000);

         
        $SDias_T=DB::table('vw_detalleplanilla')    
        ->select(DB::raw('SUM(Dias_trabajados) as Dias_trabajados')) 
        ->where('ID_epp','=',$id)     
        ->where('Tipo_produccion','=',1) ->get()->first() ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_epp','=',$id)   
         ->paginate(20);

         $ID_TipoEquipo=1;
         //dd($request);
         return view('/planilla_Ciclo.dplanillaingActividades',["planillas"=>$planilla,"SDias_T"=>$SDias_T,"data"=>$data,"ingresos"=>$otros_ingresos,"ID_TipoEquipo"=>$ID_TipoEquipo]); 
    }

    
    public function editsumproduccionA($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID_epp','=',$id)->get()->first()  ;

        $otros_ingresos=DB::table('vw_ingresos')     
        ->paginate(1000);

         
        $SDias_T=DB::table('vw_detalleplanilla')    
        ->select(DB::raw('SUM(Dias_trabajados) as Dias_trabajados')) 
        ->where('ID_epp','=',$id)     
        ->where('Tipo_produccion','=',2) ->get()->first() ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_epp','=',$id)   
         ->paginate(20);

         $ID_TipoEquipo=2;
         //dd($request);
         return view('/planilla_Ciclo.dplanillaingActividades',["planillas"=>$planilla,"SDias_T"=>$SDias_T,"data"=>$data,"ingresos"=>$otros_ingresos,"ID_TipoEquipo"=>$ID_TipoEquipo]); 
    }


    public function detalleProduccion($id)
    {   
        $data=DB::table('vw_detalleplanilla')     
        ->where('ID_epp','=',$id)->get()->first()  ;

        $otros_ingresos=DB::table('vw_ingresos')     
        ->paginate(1000);

         
        $actividades=DB::table('planilla_produccion')         
        ->where('ID_Equipo','=',$id)     
        ->paginate(200) ;

         $planilla=DB::table('vw_detalleplanilla')     
         ->where('ID_epp','=',$id)   
         ->paginate(20);

         $ID_TipoEquipo=2;
         //dd($request);
         return view('/planilla_Ciclo.detalleProduccion',["planillas"=>$planilla,"actividades"=>$actividades,"data"=>$data,"ingresos"=>$otros_ingresos,"ID_TipoEquipo"=>$ID_TipoEquipo]); 
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

        
        $periodo=DB::table('planilla')   
        ->select('Periodo') 
        ->where('ID','=',$id)->get()->first()  ;
        $cont= $periodo->Periodo; 
        return redirect()->action('Planilla_cicloController@index2', ['id' => $cont]);


        //return Redirect::to('/planillas');
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

    public function AplicarActividades(Request $request)
    {
        //
        try{
            DB::beginTransaction();            

            // $ID_PROYECTO=$request->get('ID_PROYECTO');           

            $ID_Actividad=$request->get('ID_M');
            $Descripcion=$request->get('Detalle');
            $Cantidad=$request->get('Cantidad1');
            $Precio_U=$request->get('precio_a');
            $Salario_Parcial=$request->get('S_P');

            $cont = 0 ;

            while($cont < count($ID_Actividad)){
                $actividades=new planilla_produccion();
                $actividades->ID_Equipo=$request->get('ID_equipo');
                $actividades->ID_Actividad=$ID_Actividad[$cont];
                $actividades->Descripcion=$Descripcion[$cont];
                $actividades->Cantidad=$Cantidad[$cont];
                $actividades->Precio_U=$Precio_U[$cont];
                $actividades->Salario_Parcial=$Salario_Parcial[$cont];
                $actividades->TotalDias_laborados=$request->get('Dias_T');
                $actividades->TotalSalario_parcial=$request->get('TotalSalario');
                $actividades->save();
                $cont=$cont+1;
            }
            
            DB::commit();
            

        } catch(\Exeception $e)
        {
            DB::rollback();
        }
        
        $ID_equipo=$request->get('ID_equipo');

        $sql = "call Agregar_produccion(?)";
        
        DB::select($sql,array($ID_equipo)); 
        

        $ID_planilla=$request->get('ID_Planilla');
        $ID_TipoEquipo=$request->get('ID_TipoEquipo');
        $T_planilla=$request->get('ID_TipoEquipo');
        /*$data=DB::table('vw_planillas')     
        ->where('ID','=',$ID_Planilla)->get()->first() ;

        $equipos=DB::table('vw_equipo_produccion')     
        ->where('ID_Tipo_produccion','=',1)   
        ->where('ID_PLANILLA','=',$ID_Planilla)->groupBy('Equipo')->orderby('Equipo','desc')->paginate(20)  ;

        $planilla=DB::table('vw_detalleplanilla')     
        ->where('ID_Planilla','=',$ID_Planilla)     
        ->where('Tipo_produccion','=',1) 
        ->orderby('ID','desc') 
        ->paginate(20);

            return view('/planilla_Ciclo.editdpEquipoO',["data"=>$data,"equipos"=>$equipos,"planillaOficial"=>$planilla]);*/
            //dd($T_planilla);
            switch($T_planilla) {                
                case 1://produccion Oficial
                
            return redirect()->action('Planilla_cicloController@createplanillaProyectoO', ['id' => $ID_planilla]);
            break;
            case 2://produccion Auxiliar
            return redirect()->action('Planilla_cicloController@createplanillaProyectoA', ['id' => $ID_planilla]);
            break;
            default:
            return Redirect::back();
            break;
        }
    }


}
