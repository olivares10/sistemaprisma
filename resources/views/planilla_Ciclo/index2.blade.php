@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<!--<div class="box box-default collapsed-box"> -->  
<div class="box box-default">
	<div class="box-header with-border">
			<div class="row" >

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<h3>Listado de Planillas <a href="{{ url('createplanilla',$data->ID) }}"><button class="btn btn-success">Agregar Planilla</button></a> </h3>                                    
				</div>
				@if ($ValidPA->Activo == 1)
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<h3> <a href="{{ url('SP_AplicarPlanilla',$data->ID) }}"><button class="btn btn-success">Mostrar Planilla</button></a>    </h3>                                
				</div>
				@endif	
			</div>

	</div>

		<!--<div class="box-body" style="display:none;">-->
		<div class="box-body" >
		<h4>Personal Administrativo </h4> 
			<div class="box box-primary box-gris">
				<div class="box-tools pull-right">
				<!--	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>   -->  
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
				</div>	


			
				<div class="box-body box-white ">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@if ($ValidPA->Activo> 1)
						Solo debe existir una planilla administrativa
					@endif
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>									
									<th>Periodo</th>
									<th>Mes</th>
									<th>Activo</th>								
									<th>Año</th>
									<th></th>
								</thead>
								@foreach ($planilla as $proyec)
								<tr>
									<td>{{$proyec->ID}} </td>																
									<td>{{$proyec->Periodo}} </td>
									<td>{{$proyec->Mes}} </td>									
									<td>{{$proyec->Activo}} </td>
									<td>{{$proyec->Ano}}</td>															
									<td>
									<!--	<a href="{{URL::action('PlanillaController@edit',$proyec->ID)}}"><button class="btn btn-info" >Editar</button></a>
										-->
										<a href="{{ url('createplanillaAdmin',$proyec->ID) }}"><button class="btn btn-info" >Detalle</button></a>
										@if ($proyec->Activo=='Valido')
										<a href=""data-target="#modal-delete-{{$proyec->ID}}" data-toggle="modal"><button class="btn btn-danger" >Anular</button></a>
										@endif
										
									</td>
								<tr>
								@include('planilla_Ciclo.modal')
								@endforeach
							</table>
						</div>
						{{$planilla->render()}}
					</div>

				</div>
			
			</div>

			<h4>Listado de Proyectos  </h4> 
			<div class="box box-primary box-gris">
				<div class="box-tools pull-right">
				<!--	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>   -->  
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
				</div>	


			
				<div class="box-body box-white ">
				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
						<div class="table-responsive" >

							<table class="table table-striped table-condensed table-hover">
							<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
								<thead>
									<th>ID</th>
									<th>Proyecto</th>
									<th>Periodo</th>
									<th>Mes</th>
									<th>Activo</th>									
									<th>Año</th>
									<th></th>
								</thead>
								@foreach ($planilla2 as $proyec2)
								<tr>
									<td>{{$proyec2->ID}} </td>	
									<td>{{$proyec2->Proyecto}} </td>								
									<td>{{$proyec2->Periodo}} </td>
									<td>{{$proyec2->Mes}} </td>									
									<td>{{$proyec2->Activo}} </td>
									<td>{{$proyec2->Ano}}</td>															
									<td>

									<a href="{{ url('createplanillaProyecto',$proyec2->ID) }}"><button class="btn btn-info" >Detalle</button></a>
									@if ($proyec2->Activo=='Valido')
									<a href=""data-target="#modal-delete-{{$proyec2->ID}}" data-toggle="modal"><button class="btn btn-danger" >Anular</button></a>
									@endif
									</td>
								<tr>
								@include('planilla_Ciclo.modal3')
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