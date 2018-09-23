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
					<h3>Listado de Proyectos asignados</h3>                                    
				</div>

			</div>

	</div>

		<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
	<div class="table-responsive" >

<table class="table table-striped table-condensed table-hover">
<!--<table class="table table-hover table-striped" cellspacing="0" width="80%">-->
	<thead>
		<th>Nombre del Proyecto</th>
		<th>Descripcion</th>
		<th></th>
	</thead>
	@foreach ($proyecto as $proyec)
	<tr>
		<td>{{$proyec->NOMBRE_PROYECTO}} </td>
		<td>{{$proyec->DESCRIPCION}} </td>															
		<td>
			<a href="{{ url('Pdetalle',$proyec->ID) }}"><button class="btn btn-info" >Detalle</button></a>
		</td>
	<tr>
	
	@endforeach
</table>
</div>
	</div>
</div>

@endsection