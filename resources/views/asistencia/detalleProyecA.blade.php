@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Listado De Empleados</h3>

        </div>
        
    </div> 



    <div class="row">
        <div class="panel panel-primary">

            <div class="panel-body">
                             
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
               <br/>
                    <div class="form-group">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
                            <thead style="background-color:#A9D0F5">                           
                                <th>Codigo</th>
                                <th>Colaborador</th>
                                <th>Puesto</th>
								<th></th>
                            </thead>
                            <tbody>
                            @foreach ($empleadodetalle as $empled)
								<tr>
                                    <td>{{$empled->Cod_Empleado}}</td>
									<td>{{$empled->Empleado}} </td>	
									<td>{{$empled->Nombre_Cargo}} </td>														
									<td>
									<a href="{{ url('PdetalleD',$empled->ID_ASISTENCIA) }}"><button class="btn btn-info" >Detalle</button></a>
		</td>
								<tr>
                            
                            </tbody>
                            @endforeach
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>

    </div>
       


        <!--</div>--> 
         
 

    @push ('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $( "#datepicker" ).datepicker({
      altField: "#alternate",
      altFormat: "DD, d MM, yy"
    });
  } );

  </script>
    @endpush

@endsection