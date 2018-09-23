@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Data</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::model($empleados,['method'=>'PATCH','route'=>['lista_negra.update',$empleados->ID_EMPLEADO]]) !!}
            {{Form::token()}}
            <div>
            <label for="Cod_Empleado">Empleado</label>
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
            <div>
            <label for="Cedula">Cedula</label>
            <input type="text" name="Cedula" value="{{$empleados->CEDULA}}"  class="form-control" placeholder="Cedula" readonly>
            </div>     
            <div>
                <label for="NOMBRE_AUTORIZACION">AUTORIZACION</label>
                <input type="text" name="NOMBRE_AUTORIZACION" class="form-control" placeholder="Autorizado por.." value="{{$empleados->NOMBRE_AUTORIZACION}}" >
            </div>
            <div>
                <label for="MOTIVO">Motivo</label>
                <input type="text" name="MOTIVO" class="form-control" placeholder="Descripcion..." value="{{$empleados->MOTIVO}}" >
            </div>
            <div >
                <label for="Fecha">Fecha</label>
                <input type="date" name="FECHA" required class="form-control" value="{{$empleados->FECHA}}"  >
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 


@endsection