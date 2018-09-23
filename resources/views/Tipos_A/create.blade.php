@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Tipo Actividad</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open (array('url'=>'/Tipos_A','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
            <div>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" class="form-control" placeholder="Nombre">
            </div>
            <div>
                <label for="Especificacion">Especificacion</label>
                <input type="text" name="Especificacion" class="form-control" placeholder="Especificacion..">
            </div>
            <div>
                <label for="Perido">Perido</label>
                <input type="text" name="Perido" class="form-control" placeholder="Perido...">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 

@endsection