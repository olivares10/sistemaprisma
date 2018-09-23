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
					<h3>Listado de Areas <a href="areas/create"><button class="btn btn-success">Crear Area</button></a> </h3>
					
					
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
				@include('areas.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>
									<th>Nombre</th>
									<th>Dependencia</th>
									<th>Descripcion</th>
									<th>Opciones</th>
								</thead>
								@foreach ($area as $cat)
								<tr>
									<td>{{$cat->ID_Area}} </td>
									<td>{{$cat->Nombre}} </td>
									<td>{{$cat->Dependencia}}</td>
									<td>{{$cat->Descripcion}} </td>
									<td>
										<a href="{{URL::action('areaController@edit',$cat->ID_Area)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""data-target="#modal-delete-{{$cat->ID_Area}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('areas.modal')
								@endforeach
							</table>
						</div>
						{{$area->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection