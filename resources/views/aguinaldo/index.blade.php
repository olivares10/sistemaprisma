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
					<h3>Listado de Actividades <a href="{{ url('New_aguinaldo') }}"><button class="btn btn-success">Nuevo Periodo</button></a> </h3>
					
					
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

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				@include('aguinaldo.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>
									<th>Descripcion</th>
									<th>Fecha_corte</th>
									<th> </th>
								</thead>
								@foreach ($planilla as $cat)
								<tr>
									<td>{{$cat->ID}} </td>
									<td>{{$cat->Descripcion}} </td>
									<td>{{$cat->Fecha_corte}}</td>

									<td>
										<a href="{{URL::action('AguinaldoController@edit',$cat->ID)}}"><button class="btn btn-info" >Editar</button></a>
										<a href=""data-target="#modal-delete-{{$cat->ID}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>
								@include('aguinaldo.modal')
								@endforeach
							</table>
						</div>
						{{$planilla->render()}}
					</div>

				</div>
			
			</div>
		</div>
	</div>
</div>

@endsection