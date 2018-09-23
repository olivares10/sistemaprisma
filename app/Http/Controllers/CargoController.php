<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cargo2;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CargoFormRequest;
use DB;

class CargoController extends Controller
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
            $cargo=DB::table('cargo as c')
            ->join('area as a','c.ID_Area','=','a.ID_Area')
            ->select('c.ID_Cargo','c.Nombre_Cargo','a.Nombre as Area','c.Descripcion','c.Salario_Base','c.Activo')
            ->where('c.Nombre_Cargo','like','%'.$query.'%')            
            ->where ('c.Activo','=','1')
            //->orwhere('a.Nombre','like','%'.$query.'%')
            ->orderby('c.ID_Cargo')
            ->paginate(10);
            return view('/cargos.index',["cargos"=>$cargo,"searchText"=>$query]);

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
        $areas=DB::table('area')->where('Activo','=','1')->get();
        return view('cargos.create',["areas"=>$areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoFormRequest $request)
    {
        //
        $cargo=new cargo2;
        $cargo->Nombre_Cargo=$request->get('Nombre_Cargo');
        $cargo->Descripcion=$request->get('Descripcion');
        $cargo->Salario_Base=$request->get('Salario_Base');
        $cargo->ID_Area=$request->get('ID_Area');
        $cargo->Activo='1';
        $cargo->save();
        return Redirect::to('/cargos');
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
        return view('/cargos.show',["cargo"=>cargo2::findOrFail($id)]);
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
        $cargo=cargo2::findOrFail($id);
        $areas=DB::table('area')->where('activo','=','1')->get();
        return view('/cargos.edit',["cargo"=>$cargo,"areas"=>$areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoFormRequest $request, $id)
    {
        //
        $cargo=cargo2::findOrFail($id);
        $cargo->Nombre_Cargo=$request->get('Nombre_Cargo');
        $cargo->Descripcion=$request->get('Descripcion');
        $cargo->Salario_Base=$request->get('Salario_Base');
        $cargo->ID_Area=$request->get('ID_Area');
        $cargo->update();

        
        return Redirect::to('/cargos');
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
        $cargo=cargo2::findOrFail($id);
      
        $cargo->Activo='0';
        $cargo->update();
        return Redirect::to('/cargos');
    }
}
