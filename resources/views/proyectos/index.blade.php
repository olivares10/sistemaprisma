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
					<h3>Listado de Proyectos <a href="proyectos/create"><button class="btn btn-success">Agregar Nuevo Proyecto</button></a> </h3>

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
				@include('proyectos.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>
									<th>Proyecto</th>
									<th>Descripcion</th>
									<th>Fecha Inicio</th>
									<th>Fecha Fin Estimado</th>
									<th>Fecha Fin</th>
									<th>Responsable</th>
									<th></th>
								</thead>
								@foreach ($proyectos as $proyec)
								<tr>
									<td>{{$proyec->ID_PROYECTO}} </td>
									<td>{{$proyec->NOMBRE_PROYECTO}} </td>
									<td>{{$proyec->DESCRIPCION}} </td>
									<td>{{$proyec->FECHA_INICIO}} </td>
									<td>{{$proyec->FECHA_FIN_ESTIMADO}}</td>
									<td>{{$proyec->FECHA_FIN}} </td>	
									<td>{{$proyec->Responsable}} </td>																
									<td>
										<a href="{{URL::action('ProyectosController@edit',$proyec->ID_PROYECTO)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""><button class="btn btn-info" >Detalle</button></a>
										<a href=""data-target="#modal-delete-{{$proyec->ID_PROYECTO}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('proyectos.modal')
								@endforeach
							</table>
						</div>
						{{$proyectos->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection