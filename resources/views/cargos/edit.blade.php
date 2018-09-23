
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Puesto de Trabajo: {{$cargo->Nombre_Cargo}}</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
    </div> 
           
            {!!Form::model($cargo,['method'=>'PATCH','route'=>['cargos.update',$cargo->ID_Cargo]]) !!}
            {{Form::token()}}

    <div class='row'>
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre_Cargo" required value="{{$cargo->Nombre_Cargo}}" class="form-control" placeholder="Nombre">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">    
                <label>Area</label>
                <select name="ID_Area" class="form-control">
                @foreach ($areas as $area)
                    @if ($area->ID_Area==$cargo->ID_Area)
                    <option value="{{$area->ID_Area}}" selected>{{$area->Nombre}}</option>
                    @else
                    <option value="{{$area->ID_Area}}">{{$area->Nombre}}</option>
                    @endif
                   
                @endforeach    
                </select>        
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div>
                <label for="Dependencia">Salario</label>
                <input type="text" name="Salario_Base" required value="{{$cargo->Salario_Base}}" class="form-control" placeholder="Salario en dolares.." onkeypress="return valida(event)">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" class="form-control" value="{{$cargo->Descripcion}}" placeholder="Descripcion..." >
            </div>
        </div>
    </div> 

            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        <!--</div>--> 
         
   <!--</div>--> 
   <script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
@endsection