@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Registro de Vacaciones</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open (array('url'=>'/vacaciones','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
                <label for="respon">Empleado</label>
                <input type="hidden" name="ID_EMPLEADO" id="ID_EMPLEADO">
                <input type="hidden" name="VACACIONES_DISPONIBLES" id="VACACIONES_DISPONIBLES">
                <select name="piresponsalbe" id="piresponsalbe" class="form-control selectpicker" data-live-search="true" required>
                @foreach ($empleados as $empleado)               
                  
                   <option value="{{$empleado->ID_EMPLEADO}}_{{$empleado->VACACIONES_DISPONIBLES}}">{{$empleado->Empleado}}</option> 
                @endforeach
                </select>                

        </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label for="Fecha">Fecha Inicio</label>
                </br>
                <input type="date" name="FECHA_INICIO" id="fecha1" >
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label for="Fecha F">Fecha Fin</label>
                </br>
                <input type="date" name="FECHA_FIN" id="fecha2">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label for="dia">Numero de dias</label>
               
                <input type="text" name="NUMERO_DIAS" id="dias"  onkeypress="return valida(event)" >
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
@push ('scripts')
			<script>

$("#piresponsalbe").change(mostrarvalor);
    function mostrarvalor(){
    datosvalor=document.getElementById('piresponsalbe').value.split('_');    
    $("#VACACIONES_DISPONIBLES").val(datosvalor[1]); 
    $("#ID_EMPLEADO").val(datosvalor[0]); 
    }

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
	@endpush