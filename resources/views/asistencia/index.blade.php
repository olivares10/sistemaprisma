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
					<h3>Planilla Administrativa : Quincenal </h3>
					
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
				@include('asistencia.search')
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>Periodo</th>
									<th>Mes</th>
									<th>Activo</th>
									<th>Año</th>
									<th></th>
								</thead>
								@foreach ($planilla as $proyec)
								<tr>
									<td>{{$proyec->Periodo}} </td>
									<td>{{$proyec->Mes}} </td>
									<td>{{$proyec->Activo}} </td>
									<td>{{$proyec->Ano}}</td>															
									<td>

										<a href="{{ url('ProyecA',$proyec->ID) }}"><button class="btn btn-info" >Detalle</button></a>

									</td>
								<tr>
								
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