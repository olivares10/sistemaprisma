@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

<style type="text/css" class="init">
.output {
    font: 1rem 'Fira Sans', sans-serif;
}

legend {
    background-color: #000;
    color: #fff;
    padding: 3px 6px;
}


label {
  
    text-align: right;
}
.hours {
    font-size: .7em;
    color: #999;
}

</style>
  
@section('main-content')

<!--<div class="box box-default collapsed-box"> -->  

		<div class='row'>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		
				<h3>Dias laborados por el Empleado: {{$data->Empleado}}</h3>
			</div>
			
		</div> 

		{!!Form::open (array('url'=>'/GuardarDiasL','method'=>'POST','autocomplete'=>'off')) !!}
            
            {{Form::token()}}
		<div class='row'>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<input name="_token" value="{{csrf_token()}}" type="hidden"></input>
					<button class="btn btn-primary" type="submit" >Guardar</button>
					<button class="btn btn-danger"><a href="{{ url('Pdetalle',$data->ID_PLANILLA) }}">Atras</button></a>
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
		<input type="hidden" name="ID_asistencia" id="ID_asistencia" value="{{$data->ID_ASISTENCIA}}">
		<input type="hidden" name="ID_planilla" id="ID_planilla" value="{{$data->ID_PLANILLA}}">
		<input type="hidden" name="HL" id="HL" value="{{$data->HORAS_LABORADAS}}">
		<input type="hidden" name="resta" id="resta" value="">

			<div class="panel-body">
			<div class="box box-primary box-gris"><!-- inicio box-->
			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
			</div>	
			<div class="box-body box-white ">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

				<div class="table-responsive" >

							<table class="table table-striped table-bordered table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th> </th>
									<th>Fecha</th>
									<th>Horas Laboradas</th>
									<th>Horas Extras</th>								
									<th>Hora de llegada</th>
									<th>Hora de Salida</th>
  
								</thead>
								@foreach ($data2 as $proyec)
								<tr>
								<td><button class="btn btn-danger"><a href="{{ url('delete_fecha',$proyec->ID_DETALLE) }}">X</button></a></td>									
									<td>{{$proyec->FECHA}} </td>
                                    <td>{{$proyec->HORAS_LABORADAS}} </td>
                                    <td>{{$proyec->HORAS_EXTRAS}} </td>									
                                    <td>{{$proyec->HORA_LLEGADA}} </td>
									<td>{{$proyec->HORA_SALIDA}} </td>          											
								<tr>
								
								@endforeach
		
							</table>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						</div>	
				</div>
			</div>
		</div>
 <!--inicio--> 
 			<div class="box box-primary box-gris"><!-- inicio box-->
			<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
			</div>	
			<div class="box-body box-white ">

				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div>
                    <label for="Codigo">Fecha:</label>
					<br/>
					<!--id="datepicker"-->
                    <input type="date" name="Fecha" id="Fecha" >
                    </div>
                </div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div>
                    <label for="Detalle">Hora de llegada</label>
							<div class="control">
							<label for="appt-time">Time:</label>
							<input type="time" id="appt-time" name="appttime1"
							min="08:00" max="17:00" />
							<span class="hours">Office hours: 8AM to 6PM</span>
							</div>

       				 </div>
                </div>
             
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div>
                    <label for="Cantidad">Hora de Salida</label>


					<div class="control">
						<label for="appt-time">Time:</label>
						<input type="time" id="appt-time2" name="appttime2"
						min="08:00" max="17:00" />
						<span class="hours">Office hours: 8AM to 6PM</span>
					</div>


                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="form-group">
                        </br>                       
                        <button class="btn btn-primary" id="bt-Ingresar" type="button">Ingresar</button>
                    </div>
                </div>
                </br>                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </br>
                    <div class="form-group">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
                            <thead style="background-color:#A9D0F5">  
								<th>Acciones</th> 								  
								<th>Fecha</th>   								                          
								<th>Hora de entrada</th>								
								<th>Hora de salida</th>
								<th>Horas laboradas</th>                                 					 
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
								<th></th> 
								<th></th> 
								<th></th>   
								<th></th>                           
								<th><h4 id="total">0</h4><input type="hidden" name="TOTALHORAS" id="TOTALHORAS" ></th>  						
                            </tfoot>
                        </table>
                    </div>
				</div>

 <!--fin--> 
			</div>
	
			</div>
		</div><!-- inicio box-->
		</div><!-- inicio box-->
				</div>
	</div>

	{!!Form::close()!!}


		@push ('scripts')
			<script>

			$(document).ready(function(){
				$('#bt-Ingresar').click(function(){
					restarHoras();
					Ingresar();
				});
			});
			function restarHoras() {

inicio = document.getElementById("appt-time").value;
fin = document.getElementById("appt-time2").value;

inicioMinutos = parseInt(inicio.substr(3,2));
inicioHoras = parseInt(inicio.substr(0,2));

finMinutos = parseInt(fin.substr(3,2));
finHoras = parseInt(fin.substr(0,2));

transcurridoMinutos = finMinutos - inicioMinutos;
transcurridoHoras = finHoras - inicioHoras;

if (transcurridoHoras > 4) {  
  transcurridoHoras = transcurridoHoras-1;
}

if (transcurridoHoras < 0) {  
  transcurridoHoras = 0;
}

if (transcurridoMinutos < 0) {
 
  transcurridoMinutos = 60 + transcurridoMinutos;
}
minutosT=transcurridoMinutos/60;

horas = transcurridoHoras;
minutos = minutosT;

if (horas.length < 2) {
  horas = "0"+horas;
}

if (horas.length < 2) {
  horas = "0"+horas;
}

document.getElementById("resta").value = horas+minutos;

}


			var cont=0;
			total=0;
			subtotal=[];
			function Ingresar()
			{

				time=$("#appt-time").val();
				time2=$("#appt-time2").val();
				datepicker=$("#Fecha").val();
				resta=$("#resta").val();				
				REST = parseInt(resta.substr(0,2));

				if (datepicker!="" && time!=""&& time2!=""){
										
					subtotal[cont]=(REST);
					total=total+subtotal[cont];

					var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="date" name="datepicker[]" value="'+datepicker+'"readonly></td><td><input type="text" name="time[]" value="'+time+'"readonly></td><td><input type="text" name="time2[]" value="'+time2+'"readonly></td><td><input type="text" name="resta[]" value="'+resta+'"readonly></td><td></td></tr>'
					cont++;
					limpiar1();	

					$('#detalles').append(fila);
					$('#total').html(total);
					$("#TOTALHORAS").val(total);
					
					
				}
				else{
					alert("Error al ingresar el Movimiento, Revise los datos seleccionados");
				}
			}

			function limpiar1(){
				$("#time").val("");
				$("#Fecha").val("");
				$("#time2").val("");
				
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
	$.datepicker.setDefaults($.datepicker.regional["es"]);
    $( "#datepicker" ).datepicker({
firstDay: 1
});
  } );
</script>
$( function() {
    $( "#datepicker" ).datepicker();
  } );

		@endpush
@endsection