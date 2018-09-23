@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Crear Liquidacion</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open (array('url'=>'/spliquidacionSF','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="respon">Seleccione un empleado</label>
                <input type="hidden" name="ID_Empleado" id="ID_Empleado" >
                <select name="pidgrupo" id="pidgrupo" class="form-control selectpicker" data-live-search="true" >
                @foreach ($empleados as $empleado)          
                <option value="{{$empleado->ID_EMPLEADO}}_{{$empleado->Salario_Base}}_{{$empleado->Nombre_Cargo}}_{{$empleado->CEDULA}}_{{$empleado->VACACIONES_DISPONIBLES}}_{{$empleado->FECHA_INGRESO}}">{{$empleado->Cod_Empleado}} {{$empleado->Empleado}}</option>
                @endforeach
                </select>
            </div>  
            <div class="form-group">
                <label for="respon">Causa de Terminación del Contrato Individual</label>
                <input type="hidden" name="ID_Causa" id="ID_Causa" required>
                <select name="pidgrupoCausa" id="pidgrupoCausa" class="form-control selectpicker" data-live-search="true" >
                @foreach ($causas as $causa)          
                <option value="{{$causa->ID}}_{{$causa->Causa}}">{{$causa->Causa}}</option>
                @endforeach
                </select>
            </div> 
            <div >
                <label for="Cargo">Cargo</label>
                <input type="text" id="Cargo" name="Cargo" class="form-control" readonly >
            </div>
            <div >
                <label for="CEDULA">Cedula</label>
                <input type="text" id="CEDULA" class="form-control" readonly >
            </div>
            <div class="form-group">    
                <label>Frecuencia de Pago</label>
                <select name="Frecuencia_P"  class="form-control">               
                    <option value="Quincenal">Quincenal</option>
                    <option value="Mensual">Mensual</option>
                </select>    

            </div>       
            <div >
                <label for="Fecha_Inicio">Fecha de Inicio</label>
                <input type="date" id="Fecha_Inicio" name="Fecha_Inicio" required class="form-control"  >
            </div>
            <div >
                <label for="Fecha_Salida">Fecha de Salida</label>
                <input type="date" name="Fecha_Salida" required class="form-control"  >
            </div>
            <div>
                <label for="Dias_vacaciones">Dias de Vacaciones</label>
                <input type="text" id="Dias_vacaciones" required name="Dias_vacaciones" class="form-control"readonly >
            </div>
            <div>
                <label for="Salario">Salario</label>
                <input type="text" id="Salario_1" required name="Salario_1" class="form-control">
            </div>
            <div>
                <label for="Detalle">Detalle</label>
                <input type="text" name="Detalle" class="form-control" placeholder="Descripcion...">
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
            $("#Fecha_Inicio").val(datosvalor[5]);
            $("#Dias_vacaciones").val(datosvalor[4]);
			$("#CEDULA").val(datosvalor[3]);
			$("#Cargo").val(datosvalor[2]);
			$("#Salario_1").val(datosvalor[1]);
			$("#ID_Empleado").val(datosvalor[0]);
			}

           $("#pidgrupoCausa").change(mostrarvalorcausa);
			function mostrarvalorcausa(){
			datosvalor=document.getElementById('pidgrupoCausa').value.split('_');
			$("#ID_Causa").val(datosvalor[0]);
			}

			</script>
		@endpush
@endsection