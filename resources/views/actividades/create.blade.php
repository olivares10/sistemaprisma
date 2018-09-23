@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Actividad</h3>
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
            {!!Form::open (array('url'=>'/Actividades','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}

    <div class='row'>
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Codigo</label>
                <input type="text" name="Codigo" required value="{{old('Codigo')}}" class="form-control" placeholder="Codigo">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">    
                <label>Tipo</label>
                <select name="ID_Tipo" class="form-control">
                @foreach ($actividades as $tipo)
                    <option value="{{$tipo->ID}}">{{$tipo->Nombre}}</option>
                @endforeach    
                </select>        
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div>
                <label for="Precio">Precio</label>
                <input type="text" name="Precio" required value="{{old('Precio')}}" class="form-control" placeholder="Precio en dolares.." >
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" class="form-control" value="{{old('Descripcion')}}" placeholder="Descripcion..." >
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