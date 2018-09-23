@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<!--<div class="box box-default collapsed-box"> -->  

		<div class='row'>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
			<input type="hidden" name="ID_DP" id="ID_DP" value="{{$data->ID}}">
			<input type="hidden" name="ID_Planilla" id="ID_DP" value="{{$data->ID_Planilla}}">
				<h3>Editar Empleado: {{$data->Nombre_Empleado}}</h3>
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

		{!!Form::open (array('url'=>'/speditplanillaAdmin','method'=>'POST','autocomplete'=>'off')) !!}
            
            {{Form::token()}}
		<div class='row'>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<input name="_token" value="{{csrf_token()}}" type="hidden"> </input>
					<button class="btn btn-primary" type="submit" >Guardar</button>
					<button class="btn btn-danger" type="reset" >cancelar</button>

				</div>
			</div>
		</div>	
		<div class='row'>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			</div>
		</div>	
	<!--<div class="box-body" style="display:none;">-->
	<div class="row">
		<div class="panel panel-primary">

			<div class="panel-body">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive" >

							<table class="table table-striped table-bordered table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>Codigo</th>
									<th>Cargo</th>
									<th>Nombre</th>								
									<th>Dias Trabajados</th>
									<th>Precio Del Dia</th>
                                    <th>Salario O</th>
                                    <th>Horas Ext</th>
                                    <th>Salario Ext</th>
                                    <th>Total Devengado</th>
                                    <th>Inss</th>
                                    <th>Total Neto</th>
                                    <th>IR</th>
                                    <th>Viaticos</th>
                                    <th>Anticipos</th>
                                    <th>Deducciones</th>
                                    <th>Ret Sindical</th>
                                    <th>Total</th>
								</thead>
								@foreach ($planillas as $proyec)
								<tr>									
									<td>{{$proyec->Cod_Empleado}} </td>
                                    <td>{{$proyec->Nombre_Cargo}} </td>
                                    <td>{{$proyec->Nombre_Empleado}} </td>									
                                    <td>{{$proyec->Dias_trabajados}} </td>
									<td>{{$proyec->Precio_Del_Dia}} </td>
                                    <td>{{$proyec->Salario_O}} </td>
                                    <td>{{$proyec->Horas_Extras}} </td>	
                                    <td>{{$proyec->Salario_Extraordinario}} </td>		
                                    <td>{{$proyec->Total_Devengado}} </td>	    
                                    <td>{{$proyec->Inss}} </td>	 
                                    <td>{{$proyec->Total_Neto}} </td>	
                                    <td>{{$proyec->IR}} </td>	
                                    <td>{{$proyec->Viaticos}} </td>	    
                                    <td>{{$proyec->Anticipos}} </td>	
                                    <td>{{$proyec->Deducciones}} </td>	
                                    <td>{{$proyec->Ret_Sindical}} </td>	 
                                    <td>{{$proyec->Total}} </td>	            											
									<td>
	
									</td>
								<tr>
					
								@endforeach
							</table>
						</div>
						
				</div>
 <!--inicio--> 

 				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label for="respon">Tipo de Deduccion</label>
                        <input type="hidden" name="ID_DEDUCCION" id="ID_DEDUCCION"value='1'>
						<input type="hidden" name="NOMBRE2" id="NOMBRE2"value='Horas No Laboradas'>
						<input type="hidden" name="precio_d" id="precio_d" value="{{$data->Precio_Del_Dia}}">						
                        <select name="pidgrupo1" id="pidgrupo1" class="form-control "  >
                        @foreach ($deducciones as $deduc)          
                        <option id="$deduc->ID_DEDUCCION" value="{{$deduc->ID_DEDUCCION}}_{{$deduc->NOMBRE}}">{{$deduc->NOMBRE}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div>
                    <label for="Detalle">Detalle Deduccion</label>
                    <input type="text" name="Detalle" id="Detalle"  class="form-control" placeholder="Detalle" >
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div>
                    <label for="Cantidad">Cantidad</label>
                    <input type="text" name="Cantidad1" id="Cantidad1"  class="form-control" placeholder="Cantidad" >
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        </br>                       
                        <button class="btn btn-primary" id="bt-del" type="button">Restar</button>
                    </div>
                </div>
                </br>
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </br>
                    <div class="form-group">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
                            <thead style="background-color:#A9D0F5">   
                               <th>Acciones</th>                             
                                <th>Tipo Deduccion</th>
								<th>Detalle</th>
                                <th>Cantidad</th>
                                <th>Dinero a deducir</th>
                                
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
				</div>



 <!--fin--> 
			</div>
			
			</div>
		</div>
	</div>

	{!!Form::close()!!}


		@push ('scripts')
			<script>
			$("#pidgrupo1").change(mostrarvalor1);
			function mostrarvalor1(){
			datosvalor=document.getElementById('pidgrupo1').value.split('_');
			$("#NOMBRE2").val(datosvalor[1]);
			$("#ID_DEDUCCION").val(datosvalor[0]);
			}

			$(document).ready(function(){
				$('#bt-del').click(function(){
					restar();
				});
			});

			var cont=0;
			function restar()
			{
				idgrupo=$("#pidgrupo1").val();
				deduc=$("#pidgrupo1 option:selected").text();
				Cantidad1=$("#Cantidad1").val();
				precio_d=$("#precio_d").val();
				Detalle=$("#Detalle").val();
				ID_M=$("#ID_DEDUCCION").val();
				NOMBRE=$("#NOMBRE2").val();
				ID_DP=$("#ID_DP").val();
				switch(ID_M) {
					case '1'://Horas no Laboradas 
					dinero=(precio_d/8)*Cantidad1;
						break;
					case '2'://Dias no Laborados
					dinero=precio_d*Cantidad1;
						break;
					default:
					dinero=1*Cantidad1;
					break;
				}

				if (idgrupo!="" && Cantidad1!="" && ID_M!="" && NOMBRE!=""&& dinero!=""){
					var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden"  name="ID_DP_N[]" value="'+ID_DP+'"><input type="hidden"  name="ID_M[]" value="'+ID_M+'"><input type="text" name="NOMBRE[]" value="'+NOMBRE+'"readonly></td><td><input type="text" name="Detalle[]" value="'+Detalle+'"readonly></td><td><input type="text" name="Cantidad1[]" value="'+Cantidad1+'"readonly></td><td><input type="text" name="dinero[]" value="'+dinero+'"readonly></td><td><input type="hidden" name="movimiento[]" value="2"></td></tr>'
					cont++;
					limpiar1();
				
					$('#detalles').append(fila);
					
					
				}
				else{
					alert("Error al ingresar el Movimiento, Revise los datos seleccionados");
				}
			}

			function limpiar1(){
				$("#Cantidad1").val("");
				$("#ID_DEDUCCION").val("");
				$("#NOMBRE2").val("");Detalle
				$("#Detalle").val("");
			}

			function eliminar(index){
				$("#fila"+ index).remove();

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
@endsection