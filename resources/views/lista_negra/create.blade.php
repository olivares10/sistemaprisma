@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Agregar Empleado a lista negra</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open (array('url'=>'/lista_negra','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
            
            <div class="form-group">
                <label for="respon">Seleccione un empleado</label>
                <input type="hidden" name="IDEMPLEADO" id="IDEMPLEADO">
                <select name="pidgrupo" id="pidgrupo" class="form-control selectpicker" data-live-search="true" >
                @foreach ($empleados as $empleado)          
                <option value="{{$empleado->ID_EMPLEADO}}_{{$empleado->Cod_Empleado}}_{{$empleado->Nombre_Cargo}}_{{$empleado->CEDULA}}">{{$empleado->Empleado}}</option>
                @endforeach
                </select>
            </div>      
            <div>
            <label for="Cod_Empleado">Codigo Empleado</label>
            <input type="text" name="Cod_Empleado" id="Cod_Empleado"  class="form-control" placeholder="Cod Empleado" readonly>
            </div>  
            <div>
            <label for="cargo">Cargo</label>
            <input type="text" name="Nombre_Cargo" id="Nombre_Cargo"  class="form-control" placeholder="Cargo" readonly>
            </div>   
            <div>
            <label for="Cedula">Cedula</label>
            <input type="text" name="Cedula" id="CEDULA"  class="form-control" placeholder="Cedula" readonly>
            </div>     
            <div>
                <label for="NOMBRE_AUTORIZACION">AUTORIZACION</label>
                <input type="text" name="NOMBRE_AUTORIZACION" class="form-control" placeholder="Autorizado por.." value="{{old('NOMBRE_AUTORIZACION')}}">
            </div>
            <div>
                <label for="MOTIVO">Motivo</label>
                <input type="text" name="MOTIVO" class="form-control" placeholder="Descripcion..." value="{{old('MOTIVO')}}">
            </div>
            <div >
                <label for="Fecha">Fecha</label>
                <input type="date" name="FECHA" required class="form-control" value="{{old('FECHA')}}" >
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        </div>
         
   </div> 
   @push ('scripts')
<script>
    $("#pidgrupo").change(mostrarvalor);
    function mostrarvalor(){
    datosvalor=document.getElementById('pidgrupo').value.split('_');
    $("#CEDULA").val(datosvalor[3]);
    $("#Nombre_Cargo").val(datosvalor[2]);
    $("#Cod_Empleado").val(datosvalor[1]);
    $("#IDEMPLEADO").val(datosvalor[0]);
    }

</script>
@endpush


@endsection