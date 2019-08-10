<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bitacora;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Redirect;
//use App\Http\Requests\areaFormRequest;
use DB;

class areaController extends Controller
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
                $area=DB::table('area')->where('nombre','like','%'.$query.'%')
                ->where ('activo','=','1')
                ->orderby('nombre','desc')
                ->paginate(10);
                return view('areas.index',["area"=>$area,"searchText"=>$query]);

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
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(areaFormRequest $request)
    {
        //
        $area=new area;
        $area->Nombre=$request->get('Nombre');
        $area->Dependencia=$request->get('Dependencia');
        $area->Descripcion=$request->get('Descripcion');
        $area->Activo='1';
        $area->save();
        return Redirect::to('/areas');
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
         return view('/areas.show',["area"=>area::findOrFail($id)]);
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
          return view('/areas.edit',["area"=>area::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(areaFormRequest $request, $id)
    {
        //
        $area=area::findOrFail($id);
        $area->Nombre=$request->get('Nombre');
        $area->Dependencia=$request->get('Dependencia');
        $area->Descripcion=$request->get('Descripcion');
        $area->update();
        return Redirect::to('/areas');
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
        $area=area::findOrFail($id);
        $area->Activo='0';
        $area->update();
        return Redirect::to('/areas');
    }
}
