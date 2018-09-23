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
                <h3>Detalle Produccion</h3>  
				</div>

			</div>
	</div>

	<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
	
		<div class="box box-primary box-gris">
		<div class="box-body box-white ">							
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<h4>Equipos de trabajo</h4> 		
				<div class="table-responsive" >
							<table class="table table-striped table-condensed table-hover">
							
								<thead>
								<th>Codigo Empleado</th>
									<th>Empleado</th>									
									<th>Dias Laborados</th>
									<th>Salario O</th>
								</thead>
								@foreach ($planillas as $equipo)
								<tr>
									<td>{{$equipo->Cod_Empleado}} </td>
									<td>{{$equipo->Nombre_Empleado}} </td>																									
									<td>{{$equipo->Dias_trabajados}} </td>
									<td>{{$equipo->Salario_O}} </td>				
								<tr>								
								@endforeach
							</table>
				</div>
			</div>
			
			<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
			<h4>Actividades</h4> 		
				<div class="table-responsive" >
							<table class="table table-striped table-condensed table-hover">
							
								<thead>
									<th>Actividad</th>									
									<th>Cantidad</th>
									<th>Precio Unitario</th>
									<th>Salario P. = (Cant*PU)</th>
								</thead>
								@foreach ($actividades as $actividad)
								<tr>
									<td>{{$actividad->Descripcion}} </td>																
									<td>{{$actividad->Cantidad}} </td>
									<td>{{$actividad->Precio_U}} </td>															
									<td>{{$actividad->Salario_Parcial}} </td>
								<tr>								
								@endforeach
							</table>


				</div>
			</div>
		</div>			


		</div>

		</div>
	</div>

</div>

@endsection

