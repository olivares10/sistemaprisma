@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<!--<div class="box box-default collapsed-box"> -->  
<div class="box box-default">
	<div class="box-header with-border">
			<div class="row" >

				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h3>Modulo De Elaboración Aguinaldo <a href="{{ url('Listado_A') }}"><button class="btn btn-danger">Atras</button></a></h3>  
				@if ($ValidPA == 0)
				<h3> <a href="{{ url('SP_AplicarAguinaldoF',$periodo) }}"><button class="btn btn-success">Aplicar Aguinaldo</button></a>    </h3>  
				@else 
				<a href="{{ url('downloadExcelA',$periodo) }}"><button class="btn btn-success">Download Excel xlsx</button></a>  
					@endif
						
								      
				</div>

			</div>
	</div>

	<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
		<h4>Aguinaldo</h4> 
		<div class="box box-primary box-gris">
				<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
				</div>	
			<div class="box-body box-white ">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="table-responsive" >

							<table class="table table-striped table-bordered table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>Codigo</th>
									<th>Cargo</th>
									<th>Nombre</th>								
									<th>Tipo</th>
									<th>Fecha_Inicio O</th>
									<th>Fecha_corte</th>
									<th>Salario_Junio</th>
									<th>Salario_Julio</th>
									<th>Salario_Agosto</th>
									<th>Salario_Septiembre}</th>
									<th>Salario_Octubre</th>
									<th>Salario_Noviembre</th>
									<th>Dias_a_favor</th>
									<th>Monto_pagar</th>
								</thead>
								@foreach ($planilla as $proyec1)
								<tr>						
								<td>{{$proyec1->Cod_Empleado}} </td>
								<td>{{$proyec1->Nombre_Cargo}} </td>
								<td>{{$proyec1->Nombre_Empleado}} </td>									
								<td>{{$proyec1->Tipo}} </td>
								<td>{{$proyec1->Fecha_Inicio}} </td>
								<td>{{$proyec1->Fecha_corte}} </td>	
								<td>{{$proyec1->Salario_Junio}} </td>		
								<td>{{$proyec1->Salario_Julio}} </td>	    
								<td>{{$proyec1->Salario_Agosto}} </td>	 
								<td>{{$proyec1->Salario_Septiembre}} </td>	
								<td>{{$proyec1->Salario_Octubre}} </td>	
								<td>{{$proyec1->Salario_Noviembre}} </td>	    
								<td>{{$proyec1->Dias_a_favor}} </td>	
								<td>{{$proyec1->Monto_pagar}} </td>												
								<tr>
								
								@endforeach
							</table>
						</div>
						
					</div>

				</div>
			
			</div>		

	</div>
</div>

@endsection