@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Area: {{$area->Nombre}}</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::model($area,['method'=>'PATCH','route'=>['areas.update',$area->ID_Area]]) !!}
            {{Form::token()}}
            <div>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" value="{{$area->Nombre}}" placeholder="Nombre">
            </div>
            <div>
                <label for="Dependencia">Dependencia</label>
                <input type="text" name="Dependencia" class="form-control" value="{{$area->Dependencia}}"  placeholder="Dependencia..">
            </div>
            <div>
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" class="form-control" value="{{$area->Descripcion}}"  placeholder="Descripcion...">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 

@endsection