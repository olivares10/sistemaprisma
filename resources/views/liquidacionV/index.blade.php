@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<!-- <div class="box box-default collapsed-box"> -->
<div class="box box-default">
	<!-- <div class="box-header with-border"> -->
			<div class="row" >

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3>Liquidacion de empleados  <a href="LiquidacionV/create"><button class="btn btn-success">Nuevo</button></a></h3>

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
				@include('Liquidacion.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>Codigo</th>
									<th>Nombre</th>
									<th>Cargo</th>
									<th>Causa</th>
									<th>Opciones</th>
								</thead>
								@foreach ($liquidacion as $cat)
								<tr>
									<td>{{$cat->Cod_Empleado}} </td>
									<td>{{$cat->Nombre_Empleado}} </td>
									<td>{{$cat->Nombre_Cargo}}</td>
									<td>{{$cat->Causa}} </td>
									<td>
										<a href="{{URL::action('LiquidacionVController@edit',$cat->ID)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""data-target="#modal-delete-{{$cat->ID}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('Liquidacion.modal')
								@endforeach
							</table>
						</div>
						{{$liquidacion->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection