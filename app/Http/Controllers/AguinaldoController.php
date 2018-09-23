<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Aguinaldo;
use Carbon\Carbon;
use DB;



class AguinaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
     
        if (\Auth::user()->can('ver_aguinaldo')){
            $query=trim($request->get('searchText'));
            $planilla=DB::table('aguinaldo')     
            ->select('ID','Descripcion' ,'Fecha_corte')  
            //->where ('Activo','=','Valido')        
            //->where ('Mes','like','%'.$query.'%')   
            //->orwhere('Periodo','like','%'.$query.'%')           
           // ->orwhere ('ano','like','%'.$query.'%')   
                    
            ->orderby('ID','desc')
            ->paginate(100);
            return view('aguinaldo.index',["planilla"=>$planilla,"searchText"=>$query]);
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

    }

    public function New_aguinaldo(Request $request)
    {
        //
        $ano=date('Y');

       $fecha=Carbon::createFromDate(0000,11,30)->addyear(date('Y'));
      
      
   
        $planilla=new aguinaldo;
        $planilla->Descripcion='Nuevo: pendiente de Validar';
        $planilla->Fecha_corte=$fecha;
        $planilla->save();
        return redirect()->action('AguinaldoController@index');
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

        $Fecha_c=DB::table('aguinaldo')    
        ->select(DB::raw('Fecha_corte')) 
            ->where('ID','=',$id)->get()->first() ;
            $fecha= $Fecha_c->Fecha_corte; 

        $data=DB::table('aguinaldo as a') 
        ->join('aguinaldo_detalle as ad', 'a.ID','=','ad.ID_Aguinaldo')    
        ->select(DB::raw('count(a.Fecha_corte) as Fecha_corte')) 
            ->where('a.Fecha_corte','=',$fecha)->get()->first() ;

            $cont= $data->Fecha_corte;                             
           
        if ($cont == 0)
        {
            //dd($cont);
        $sql = "call SP_Aplicar_Aguinaldo(?,1)";

        DB::select($sql,array($id)); // retorna un array de objetos.

        $planilla=DB::table('newA_tbl') 
        ->join('empleado as e', 'newA_tbl.ID_EMPLEADO','=','e.ID_EMPLEADO') 
        ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
        ->join('aguinaldo as a', 'newA_tbl.ID_Aguinaldo','=','a.ID')  
        ->select('e.Cod_Empleado','Tipo','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Fecha_Inicio','a.Fecha_corte','Salario_Junio','Salario_Julio','Salario_Agosto','Salario_Septiembre',
        'Salario_Octubre','Salario_Noviembre','Dias_a_favor','Monto_pagar')  
        ->where('newA_tbl.ID_Aguinaldo','=',$id) 
        ->paginate(1000);
        
        $ValidPA = 0;
        
        }
        
        else
        
        {
            $planilla=DB::table('aguinaldo_detalle') 
            ->join('empleado as e', 'aguinaldo_detalle.ID_EMPLEADO','=','e.ID_EMPLEADO') 
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
            ->join('aguinaldo as a', 'aguinaldo_detalle.ID_Aguinaldo','=','a.ID')  
            ->select('e.Cod_Empleado','Tipo','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Fecha_Inicio','a.Fecha_corte','Salario_Junio','Salario_Julio','Salario_Agosto','Salario_Septiembre',
            'Salario_Octubre','Salario_Noviembre','Dias_a_favor','Monto_pagar')  
            ->where('aguinaldo_detalle.ID_Aguinaldo','=',$id) 
            ->paginate(1000);

            $ValidPA = 1;
        }  


        return view('aguinaldo.AguinaldoAplicado',["planilla"=>$planilla,"periodo"=>$id,"ValidPA"=>$ValidPA]);
    }
    public function SP_AplicarAguinaldoF($id)
    {
        $sql = "call SP_Aplicar_Aguinaldo(?,2)";      
        DB::select($sql,array($id));

        $aguinaldo=aguinaldo::findOrFail($id);
        $aguinaldo->Descripcion='Validado y Aprovado';
        $aguinaldo->update();

        return redirect()->action('AguinaldoController@edit', ['id' => $id]);
        
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
        DB::table('aguinaldo')->where('ID', '=', $id)->delete();
        return Redirect::to('/Aguinaldo');
    }
}
