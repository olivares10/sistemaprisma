
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Actividad: {{$actividad->Nombre_Cargo}}</h3>
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
           
            {!!Form::model($actividad,['method'=>'PATCH','route'=>['Actividades.update',$actividad->ID]]) !!}
            {{Form::token()}}

    <div class='row'>
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Codigo">Codigo</label>
                <input type="text" name="Codigo" required value="{{$actividad->Codigo}}" class="form-control" placeholder="Codigo">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">    
                <label>Area</label>
                <select name="ID_Tipo" class="form-control">
                @foreach ($actividades_tipo as $act)
                    @if ($act->ID==$actividad->ID)
                    <option value="{{$act->ID}}" selected>{{$act->Nombre}}</option>
                    @else
                    <option value="{{$act->ID}}">{{$act->Nombre}}</option>
                    @endif
                   
                @endforeach    
                </select>        
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div>
                <label for="Precio">Precio</label>
                <input type="text" name="Precio" required value="{{$actividad->Precio}}" class="form-control" placeholder="Precio en dolares..">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" class="form-control" value="{{$actividad->Descripcion}}" placeholder="Descripcion..." >
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