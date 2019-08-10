
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Informacion:{{$empleados->Empleado}}</h3>
        </div>
        
    </div> 
           

            <div class='row'>
           
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Codigo de empleado</label>
                     <input type="text" name="Cod_Empleado"  value="{{$empleados->Cod_Empleado}}" class="form-control" placeholder="codigo de empleado"readonly>
                 </div>
     
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">          
                 <div class="form-group">
                     <label for="Nombre">Cedula</label>
                     <input type="text" name="CEDULA"  value="{{$empleados->CEDULA}}" class="form-control" readonly>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Salario Base</label>
                     <input type="text" name="Salario_Base"  required value="{{$empleados->Salario_Base}}" class="form-control" readonly>  
     
                 </div>
             </div>

             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div class="form-group">    
                     <label>Cargo</label>
                     <input type="text" name="Nombre_Cargo"  required value="{{$empleados->Nombre_Cargo}}" class="form-control" readonly>  
     
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div class="form-group">    
                     <label>Telefono</label>
                     <input type="text" name="Telefono"  required value="{{$empleados->Telefono}}" class="form-control" readonly>       
                 </div>
  
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="NO_INSS">NO_INSS</label>
                     <input type="text" name="NO_INSS" class="form-control" value="{{$empleados->NO_INSS}}" readonly>
                 </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Email">Email</label>
                     <input type="mail" name="Email" class="form-control" value="{{$empleados->Email}}" readonly>
                 </div>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Celular">Celular</label>
                     <input type="text" name="Celular"  class="form-control" value="{{$empleados->Celular}}" readonly>
                 </div>
             </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div>
                     <label for="ANIOS_D_EXPERIENCIA">Años De Experiencia</label>
                     <input type="text" name="ANIOS_EXPERIENCIA"  value="{{$empleados->ANIOS_EXPERIENCIA}}" class="form-control" placeholder="Años de Experiencia.." onkeypress="return valida(event)"readonly>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Fecha">Fecha De Ingreso</label>
                     <input type="date" name="FECHA_INGRESO" required class="form-control" value="{{$empleados->FECHA_INGRESO}}" placeholder="dd/mm/aaaa"readonly >
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="vacaciones">Vacaciones Disponibles</label>
                     <input type="text" name="VACACIONES_DISPONIBLES" required class="form-control" value="{{$empleados->VACACIONES_DISPONIBLES}}" readonly >
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Direccion">Direccion</label>
                     <input type="text" name="DIRECCION" required class="form-control" value="{{$empleados->DIRECCION}}" placeholder="Direccion..." readonly>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="table-responsive" >
                        <label for="Bitacora">Bitacora</label>
							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>Fecha </th>
									<th>Detalle</th>
								</thead>
								@foreach ($bitacora as $proyec)
								<tr>
									<td>{{$proyec->Fecha}} </td>
									<td>{{$proyec->Detalle}} </td>
								<tr>								
								@endforeach
							</table>
						</div>
					</div>
				</div>
         </div> 
     

        @push ('scripts')
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

    <script src="{{ url('js/bootstrap-select.min.js') }}"></script>
    @endpush
@endsection