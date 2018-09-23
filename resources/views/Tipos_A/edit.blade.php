@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tipo Actividad: {{$Tipos_A->Nombre}}</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::model($Tipos_A,['method'=>'PATCH','route'=>['Tipos_A.update',$Tipos_A->ID]]) !!}
            {{Form::token()}}
            <div>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" value="{{$Tipos_A->Nombre}}" placeholder="Nombre">
            </div>
            <div>
                <label for="Especificacion">Especificacion</label>
                <input type="text" name="Especificacion" class="form-control" value="{{$Tipos_A->Especificacion}}"  placeholder="Especificacion..">
            </div>
            <div>
                <label for="Periodo">Periodo</label>
                <input type="text" name="Periodo" class="form-control" value="{{$Tipos_A->Periodo}}"  placeholder="Periodo...">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 

@endsection