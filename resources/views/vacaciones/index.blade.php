@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<!-- <div class="box box-default collapsed-box"> -->
<div class="box box-default">
	<!-- <div class="box-header with-border"> -->
			<div class="row" >

				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					<h3>Listado de Vacaciones <a href="vacaciones/create"><button class="btn btn-success">Registrar Vacaciones</button></a> </h3>
					
					
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

				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				@include('vacaciones.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>									
									<th>Empleado</th>
									<th>Fecha Inicio</th>
									<th>Fecha Fin</th>
									<th>Dias</th>
									<th>Acciones</th>
								</thead>
								@foreach ($vacaciones as $cat)
								<tr>
									<td>{{$cat->ID_DETALLE_VACACIONES}} </td>
									<td>{{$cat->Empleado}} </td>
									<td>{{$cat->FECHA_INICIO}}</td>
									<td>{{$cat->FECHA_FIN}} </td>
									<td>{{$cat->NUMERO_DIAS}} </td>
									<td>
										<a href="{{URL::action('VacacionesController@edit',$cat->ID_DETALLE_VACACIONES)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""data-target="#modal-delete-{{$cat->ID_DETALLE_VACACIONES}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('vacaciones.modal')
								@endforeach
							</table>
						</div>
						{{$vacaciones->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection