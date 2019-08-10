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
					<h3>Listado de Empleados <a href="empleados/create"><button class="btn btn-success">Agregar Nuevo Empleado</button></a> </h3>
					
					
				</div>

			</div>
			<div class="box-tools pull-right">
			<!--	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>   -->  
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
			</div>	
	</div>

	<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
		<div class="box box-primary box-gris">
		


			
			<div class="box-body box-white ">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				@include('empleados.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>
									<th>Cargo</th>
									<th>Area</th>
									<th>Primer Nombre</th>
									<th>Primer Apellido</th>
									<th>Cedula</th>
									<th>Estado</th>									
								</thead>
								@foreach ($empleados as $empl)
								<tr>
									<td>{{$empl->Cod_Empleado}} </td>
									<td>{{$empl->Cargo}} </td>
									<td>{{$empl->Area}} </td>
									<td>{{$empl->PRIMER_NOMBRE}} </td>
									<td>{{$empl->PRIMER_APELLIDO}}</td>
									<td>{{$empl->CEDULA}} </td>	
									<td>{{$empl->Estado}} 
									@if ($empl->LN==1)
									<label class="btn btn-danger" >Lista Negra</label>
									@endif
									</td>	

									<td> </td>									
									<td>
										<a href="{{URL::action('EmpleadoController@edit',$empl->ID_EMPLEADO)}}"><button class="btn btn-info" >Editar</button></a>
										<a href="{{URL::action('EmpleadoController@detalleEmpleado',$empl->ID_EMPLEADO)}}"><button class="btn btn-info" >Detalle</button></a>
										@role('administrador') 
										<a href="{{URL::action('EmpleadoController@asignarUsuario',$empl->ID_EMPLEADO)}}"><button class="btn btn-info" >Asignar usuario</button></a>
										@else        

		  								 @endrole
										<!--<a href=""data-target="#modal-delete-{{$empl->ID_EMPLEADO}}" data-toggle="modal"><button class="btn btn-danger" >Imagen</button></a>-->
									</td>
								<tr>
								@include('empleados.modal')
								@endforeach
							</table>
						</div>
						{{$empleados->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection