@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

  <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vincular Empleado con usuario de sistema</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open (array('url'=>'/empleadoUser','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div>
                <label for="Cod_Empleado">Empleado</label>
                <input type="hidden" name="ID_EMPLEADO" id="ID"value='{{$empleados->ID_EMPLEADO}}'>
                <input type="text" name="Cod_Empleado" value="{{$empleados->Empleado}}"   class="form-control" placeholder="Cod Empleado" readonly>
                </div>     
                <div>
                <label for="Cod_Empleado">Codigo Empleado</label>
                <input type="text" name="Cod_Empleado" value="{{$empleados->Cod_Empleado}}"   class="form-control" placeholder="Cod Empleado" readonly>
                </div>  
                <div>
                <label for="cargo">Cargo</label>
                <input type="text" name="Nombre_Cargo" value="{{$empleados->Nombre_Cargo}}"   class="form-control" placeholder="Cargo" readonly>
                </div>   
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">    
                    <label>Usuario del sistema</label>
            <select name="ID_User" class="form-control">
                    @foreach ($users as $user)
                @if ($user->id==$empleados->ID_User)
                <option value="{{$user->id}}" selected>{{$user->name}}</option>
                @else
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endif                   
                    @endforeach  
            </select>   
                </div>
            </div>
            </br>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            </br>
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 
   @endsection