@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')


<section  id="contenido_principal">

	

<div class="box box-primary box-gris">
           <div class="box-header">
        <h4 class="box-title">Empleados</h4>	        
        <form   action="{{ url('buscar_empleado') }}"  method="post"  >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
				<div class="input-group input-group-sm">
					<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
					<span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>

				</div>
     <div class="margin" id="botones_control">
              <a href="javascript:void(0);" class="btn btn-xs btn-primary" onclick="cargar_formularioEmpleado(1);">Agregar Empleado</a>
              <a href="{{ url("/listado_empleados") }}"  class="btn btn-xs btn-primary" >Listado Empleados</a>                                             
		</div>

<div class="box-body box-white">

    <div class="table-responsive" >

	    <table  class="table table-hover table-striped" cellspacing="0" width="100%">
				<thead>
						<tr>    <th>codigo</th>                                
								<th>Area</th>
								<th>Nombre</th>
								<th>Puesto</th>
                                <th>Estado</th>
							    <th>Direccion</th>  
                                 <th> </th>                               
						</tr>
				</thead>
            <tbody>

                    @foreach($empleados as $empleado)
                    <tr role="row" class="odd">
                    <td>{{ $empleado->ID_EMPLEADO }}</td>
                    <td><span class="label label-default">
                         {{ $empleado->Area }}                              
                    </span>
                    </td>
                    <td> {{ $empleado->Nombre  }}</td>
                    <td> 
                    {{ $empleado->Cargo  }}                  
                    </td>
                    <td>  
                    {{ $empleado->Estado  }}                   
                    </td>
                    <td>
                    {{ $empleado->Direccion  }} 
                    </td>
                    
                   <td> 
                    <button type="button" class="btn  btn-default btn-xs" onclick="verinfo_Empleado({{  $empleado->ID_EMPLEADO }})" ><i class="fa fa-fw fa-edit"></i></button>
                    </td>
                    
                </tr>
	            @endforeach



		    </tbody>
		</table>

	</div>


  
 </div>




{{ $empleados->links() }}

@if(count($empleados)==0)


<div class="box box-primary col-xs-12">

<div class='aprobado' style="margin-top:70px; text-align: center">
 
<label style='color:#177F6B'>
              ... no se encontraron resultados para su busqueda...
</label> 

</div>

 </div> 


@endif

</div></section>
@endsection