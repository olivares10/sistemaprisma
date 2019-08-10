<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Vacaciones;
use App\empleados;
use Carbon\Carbon;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VacacionesFormReques;
use DB;



class VacacionesController extends Controller
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
            $vacaciones=DB::table('detalle_vacaciones as v')
            ->join('empleado as e','e.ID_EMPLEADO','=','v.ID_EMPLEADO')
            ->select ('v.ID_DETALLE_VACACIONES','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),
            'v.FECHA_SOLICITUD','v.FECHA_INICIO','v.FECHA_FIN','v.NUMERO_DIAS')
            ->where('e.PRIMER_NOMBRE','like','%'.$query.'%')  
            ->orwhere('e.PRIMER_APELLIDO','like','%'.$query.'%')           
            ->orderby('v.FECHA_SOLICITUD','desc')
            ->paginate(10);
                      // dd($vacaciones);
            return view('vacaciones.index',["vacaciones"=>$vacaciones,"searchText"=>$query]);

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
        ->select ('e.Cod_Empleado','e.ID_EMPLEADO',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Empleado'),'c.ID_Cargo','c.Nombre_Cargo','e.VACACIONES_DISPONIBLES')
        ->where('e.ID_ESTADO','=','1')->get();

        return view('vacaciones.create',["empleados"=>$empleado]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacacionesFormReques $request)
    {
        //
        $today = Carbon::today();
        
        $Dvacaciones=new Vacaciones;
        $Dvacaciones->ID_EMPLEADO=$request->get('ID_EMPLEADO');
        $Dvacaciones->FECHA_SOLICITUD=$today;
        
        $Dvacaciones->FECHA_INICIO=$request->get('FECHA_INICIO');
        $Dvacaciones->FECHA_FIN=$request->get('FECHA_FIN');
        $Dvacaciones->NUMERO_DIAS=$request->get('NUMERO_DIAS');
        $Dvacaciones->save();

        
        $DV=$request->get('VACACIONES_DISPONIBLES');
        $ND=$request->get('NUMERO_DIAS');
        //dd($Dvacaciones);
        $ID_EMPLEADO=$request->get('ID_EMPLEADO');
        $empleado=empleados::findOrFail($ID_EMPLEADO);
        $empleado->VACACIONES_DISPONIBLES=($DV-$ND);

        $empleado->update();

        return Redirect::to('/vacaciones');
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

        $vacaciones=DB::table('detalle_vacaciones as v')
        ->join('empleado as e','e.ID_EMPLEADO','=','v.ID_EMPLEADO')
        ->select ('e.ID_EMPLEADO','e.VACACIONES_DISPONIBLES','v.NUMERO_DIAS')
        ->where('v.ID_DETALLE_VACACIONES','=',$id)->first()  ;
        //dd($vacaciones);
        $ID_EMPLEADO= $vacaciones->ID_EMPLEADO;
        $ND= $vacaciones->NUMERO_DIAS;
        $DV=$vacaciones->VACACIONES_DISPONIBLES;


        $empleado=empleados::findOrFail($ID_EMPLEADO);
        $empleado->VACACIONES_DISPONIBLES=($DV+$ND);
        $empleado->update();

        DB::table('detalle_vacaciones')->where('ID_DETALLE_VACACIONES', '=', $id)->delete();
        return Redirect::to('/vacaciones');
    }
}
