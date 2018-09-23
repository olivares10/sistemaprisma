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
                <h3>Modulo De Planilla por Equipos de trabajo Oficial</h3>  
				<a href="{{ url('crearequipoO',$data->ID) }}"><button class="btn btn-info">Crear Equipo</button></a>
				</div>

			</div>
	</div>

	<!--<div class="box-body" style="display:none;">-->
	<div class="box-body" >
	<h4>Equipos de trabajo</h4> 
		<div class="box box-primary box-gris">
		<div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
		</div>
		<div class="box-body box-white ">				
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
				<div class="table-responsive" >
							<table class="table table-striped table-condensed table-hover">
							
								<thead>
									<th>Tipo Produccion</th>									
									<th>Equipo</th>
									<th>Agregar Actividades</th>
									<th></th>
								</thead>
								@foreach ($equipos as $equipo)
								<tr>
									<td>{{$equipo->Tipo_produccion}} </td>																
									<td>{{$equipo->Equipo}} </td>
									<td>                                    
									<a href="{{ url('editsumproduccionO',$equipo->ID) }}"><button class="btn btn-info" >+</button></a>
                                    </td>															
									<td>	
										<a href="{{ url('detalleProduccion',$equipo->ID) }}"><button class="btn btn-info" >Detalle</button></a>
										<a href=""data-target="#modal-delete-{{$equipo->ID}}" data-toggle="modal"><button class="btn btn-danger" >Eliminar</button></a>
									</td>
								<tr>								
								@endforeach
							</table>


				</div>
			</div>
		</div>
					<h4> Planilla De Produccion Oficial</h4> 
					<div class="box box-primary box-gris"><!-- inicio box-->
						<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>        
						</div>	
						<div class="box-body box-white ">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive" >

									<table class="table table-striped table-bordered table-condensed table-hover">
										<thead>
											<th>Codigo</th>
											<th>Cargo</th>
											<th>Nombre</th>								
											<th>Dias Trabajados</th>
											<th>Salario O</th>
											<th>Horas Ext</th>
											<th>Salario Ext</th>
											<th>Total Devengado</th>
											<th>Inss</th>
											<th>Total Neto</th>
											<th>IR</th>
											<th>Viaticos</th>
											<th>Anticipos</th>
											<th>Deducciones</th>
											<th>Ret Sindical</th>
											<th>Total</th>
										</thead>
										@foreach ($planillaOficial as $proyec)
										<tr>
											<td>{{$proyec->Cod_Empleado}} </td>
											<td>{{$proyec->Nombre_Cargo}} </td>
											<td>{{$proyec->Nombre_Empleado}} </td>									
											<td>{{$proyec->Dias_trabajados}} </td>
											<td>{{$proyec->Salario_O}} </td>
											<td>{{$proyec->Horas_Extras}} </td>	
											<td>{{$proyec->Salario_Extraordinario}} </td>		
											<td>{{$proyec->Total_Devengado}} </td>	    
											<td>{{$proyec->Inss}} </td>	 
											<td>{{$proyec->Total_Neto}} </td>	
											<td>{{$proyec->IR}} </td>	
											<td>{{$proyec->Viaticos}} </td>	    
											<td>{{$proyec->Anticipos}} </td>	
											<td>{{$proyec->Deducciones}} </td>	
											<td>{{$proyec->Ret_Sindical}} </td>	 
											<td>{{$proyec->Total}} </td>
											<td>
											<a href="{{ url('editsumplanillaO',$proyec->ID) }}"><button class="btn btn-info" >+</button></a>
											<a href="{{ url('editsumplanillaAdmin',$proyec->ID) }}"><button class="btn btn-danger" >-</button></a>
											</td>          											
										<tr>										
										@endforeach
									</table>
								</div>
								
							</div>

						</div>
					
					</div><!-- Fin box-->
				


		</div>

		</div>
	</div>

</div>

@endsection

