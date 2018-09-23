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
                <h3>Modulo De Planilla por Equipos de trabajo <a href="{{ url('detalleciclo',$periodo) }}"><button class="btn btn-danger">Atras</button></a></h3>  
				@if ($ValidPA == 0)
				<h3> <a href="{{ url('SP_AplicarPlanillaF',$periodo) }}"><button class="btn btn-success">Aplicar Planilla</button></a>    </h3>  
				@else 
				<a href="{{ url('downloadExcel',$periodo) }}"><button class="btn btn-success">Download Excel xlsx</button></a>  
					@endif
						
								      
				</div>

			</div>
	</div>

	<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
		<h4>Planilla De Produccion Oficial</h4> 
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
									<th>Dias Trabajados</th>
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
								@foreach ($planilla as $proyec1)
								<tr>						
								<td>{{$proyec1->Cod_Empleado}} </td>
								<td>{{$proyec1->Nombre_Cargo}} </td>
								<td>{{$proyec1->Nombre_Empleado}} </td>									
								<td>{{$proyec1->Dias_trabajados}} </td>
								<td>{{$proyec1->Salario_O}} </td>
								<td>{{$proyec1->Horas_Extras}} </td>	
								<td>{{$proyec1->Salario_Extraordinario}} </td>		
								<td>{{$proyec1->Total_Devengado}} </td>	    
								<td>{{$proyec1->Inss}} </td>	 
								<td>{{$proyec1->Total_Neto}} </td>	
								<td>{{$proyec1->IR}} </td>	
								<td>{{$proyec1->Viaticos}} </td>	    
								<td>{{$proyec1->Anticipos}} </td>	
								<td>{{$proyec1->Deducciones}} </td>	
								<td>{{$proyec1->Ret_Sindical}} </td>	 
								<td>{{$proyec1->Total}} </td> 											
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