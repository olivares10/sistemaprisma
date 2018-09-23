<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Actividades;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ActividadesFormReques;
use DB;


class ActividadesController extends Controller
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
        $actividad=DB::table('Actividades as a')
        ->join('actividades_tipo as ac','a.ID_Tipo','=','ac.ID')
        ->select('a.ID','a.Codigo','ac.Nombre as Tipo','a.Descripcion','a.Precio','a.Activo')
        ->where('a.Codigo','like','%'.$query.'%')            
        ->where ('a.Activo','=','1')
        //->orwhere('a.Nombre','like','%'.$query.'%')
        ->orderby('a.ID')
        ->paginate(20);
        return view('/actividades.index',["actividades"=>$actividad,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $actividades_tipo=DB::table('actividades_tipo')->where('Activo','=','1')->get();
        return view('/actividades.create',["actividades"=>$actividades_tipo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActividadesFormReques $request)
    {
        //
        $actividad=new Actividades;
        $actividad->Codigo=$request->get('Codigo');
        $actividad->Descripcion=$request->get('Descripcion');
        $actividad->Precio=$request->get('Precio');
        $actividad->ID_Tipo=$request->get('ID_Tipo');
        $actividad->Activo=1;
        $actividad->save();
        return Redirect::to('/Actividades');
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
        return view('/actividades.show',["actividad"=>Actividades::findOrFail($id)]);
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
        $actividad=Actividades::findOrFail($id);
        $actividades_tipo=DB::table('actividades_tipo')->where('activo','=','1')->get();
        return view('/Actividades.edit',["actividad"=>$actividad,"actividades_tipo"=>$actividades_tipo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActividadesFormReques $request, $id)
    {
        //
        $actividad=Actividades::findOrFail($id);
        $actividad->Codigo=$request->get('Codigo');
        $actividad->Descripcion=$request->get('Descripcion');
        $actividad->Precio=$request->get('Precio');
        $actividad->ID_Tipo=$request->get('ID_Tipo');
        $actividad->update();

        
        return Redirect::to('/Actividades');
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
        $actividad=Actividades::findOrFail($id);
        
          $actividad->Activo=0;
          $actividad->update();
          return Redirect::to('/Actividades');
    }
}
