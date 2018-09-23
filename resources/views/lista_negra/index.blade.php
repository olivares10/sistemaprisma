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
					<h3>Listado Negra de Empleados <a href="lista_negra/create"><button class="btn btn-success">Agregar Empleado</button></a> </h3>
					
					
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
									<th>Motivo</th>
								
								</thead>
								@foreach ($empleados as $empl)
								<tr>
									<td>{{$empl->Cod_Empleado}} </td>
									<td>{{$empl->Cargo}} </td>
									<td>{{$empl->Area}} </td>
									<td>{{$empl->PRIMER_NOMBRE}} </td>
									<td>{{$empl->PRIMER_APELLIDO}}</td>
									<td>{{$empl->MOTIVO}} </td>	
									<td> </td>									
									<td>
										<a href="{{URL::action('lista_negraController@edit',$empl->ID_EMPLEADO)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""><button class="btn btn-info" >Detalle</button></a>
										<a href=""data-target="#modal-delete-{{$empl->ID_EMPLEADO}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('lista_negra.modal')
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