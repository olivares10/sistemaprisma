<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_Actividades;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Tipo_ActividadesFormReques;
use DB;


class Tipo_ActividadesController extends Controller
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
            $Tipo_A=DB::table('actividades_tipo')->where('Nombre','like','%'.$query.'%')
            ->where ('Activo','=','1')
            ->orderby('Nombre','desc')
            ->paginate(10);
            return view('Tipos_A.index',["Tipos_A"=>$Tipo_A,"searchText"=>$query]);

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
        //
        return view('Tipos_A.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tipo_ActividadesFormReques $request)
    {
        //
        $Tipo_A=new Tipo_Actividades;
        $Tipo_A->Nombre=$request->get('Nombre');
        $Tipo_A->Especificacion=$request->get('Especificacion');
        // $Tipo_A->Descripcion=$request->get('Descripcion');
        $Tipo_A->Activo=1;
        $Tipo_A->save();
        return Redirect::to('/Tipos_A');
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
        return view('/Tipos_A.show',["Tipo_A"=>Tipo_Actividades::findOrFail($id)]);
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
        return view('/Tipos_A.edit',["Tipos_A"=>Tipo_Actividades::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tipo_ActividadesFormReques $request, $id)
    {
        //
        $Tipo_A=Tipo_Actividades::findOrFail($id);
        $Tipo_A->Nombre=$request->get('Nombre');
        $Tipo_A->Especificacion=$request->get('Especificacion');
        //$Tipo_A->Descripcion=$request->get('Descripcion');
        $Tipo_A->update();
        return Redirect::to('/Tipos_A');
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
        $Tipo_A=Tipo_Actividades::findOrFail($id);
        $Tipo_A->Activo=0;
        $Tipo_A->update();
        return Redirect::to('/Tipos_A');
    }
}
