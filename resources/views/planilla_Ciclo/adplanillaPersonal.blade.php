@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
            <h3>Ingreso de Personal Adminstrativo Para Crear Planilla</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
    </div> 
    
            {!!Form::open (array('url'=>'/SPPlanilla_Personal','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}
    <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden"> </input>
                <button class="btn btn-primary" type="submit" >Guardar</button>
                <button class="btn btn-danger" type="reset" >cancelar</button>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <input type="hidden" name="ID_planilla" id="ID_planilla"value="{{$data->ID}}">	
                    <div class="form-group">
                        <label for="respon">Grupo De Trabajo</label>
                        <input type="hidden" name="IDEMPLEADO" id="IDEMPLEADO">
                        <select name="pidgrupo" id="pidgrupo" class="form-control selectpicker" data-live-search="true" >
                        @foreach ($empleados as $empleado)    
                              
                        <option value="{{$empleado->ID_EMPLEADO}}_{{$empleado->Cod_Empleado}}_{{$empleado->Nombre_Cargo}}">{{$empleado->Empleado}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div>
                    <label for="Cod_Empleado">Codigo Empleado</label>
                    <input type="text" name="Cod_Empleado" id="Cod_Empleado"  class="form-control" placeholder="Cod Empleado" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div>
                    <label for="cargo">Dias Trabajados</label>
                    <input type="text" name="Dias_T" id="Dias_T" value="15"  class="form-control" placeholder="Dias Trabajados" >
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div>
                    <label for="cargo">Cargo</label>
                    <input type="text" name="Nombre_Cargo" id="Nombre_Cargo"  class="form-control" placeholder="Cargo" readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        </br>                       
                        <button class="btn btn-primary" id="bt-add" type="button">Agregar</button>
                    </div>
                </div>
                </br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </br>
                    <div class="form-group">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
                            <thead style="background-color:#A9D0F5">
                                <th>Acciones</th>
                                <th>Codigo</th>
                                <th>Colaborador</th>
                                <th>Puesto</th>  
                                <th>Dias Trabajados</th>                                
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
       

            {!!Form::close()!!}
        <!--</div>--> 
         
 

   @push ('scripts')
<script>

    $("#pidgrupo").change(mostrarvalor);
    function mostrarvalor(){
    datosvalor=document.getElementById('pidgrupo').value.split('_');
    $("#Nombre_Cargo").val(datosvalor[2]);
    $("#Cod_Empleado").val(datosvalor[1]);
    $("#IDEMPLEADO").val(datosvalor[0]);
    }

$(document).ready(function(){
    $('#bt-add').click(function(){
        agregar();
    });
});

var cont=0;
 function agregar()
 {
    idgrupo=$("#pidgrupo").val();
    empleado=$("#pidgrupo option:selected").text();
    cargo=$("#Nombre_Cargo").val();
    Cod_Empleado=$("#Cod_Empleado").val();
    ID_EMPLEADOS=$("#IDEMPLEADO").val();
    Dias=$("#Dias_T").val();
    ID=$("#ID_planilla").val();
                
    if (idgrupo!="" && cargo!="" && Cod_Empleado!="" && ID_EMPLEADOS!=""&& Dias!="" ){
        var fila='<tr class="selected" id="fila'+cont+'"><td><input type="hidden"  name="ID[]" value="'+ID+'"><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input type="hidden"  name="ID_EMPLEADOS[]" value="'+ID_EMPLEADOS+'">'+Cod_Empleado+'</td><td><input type="text" name="empleado[]" value="'+empleado+'"readonly></td><td><input type="text" name="cargo[]" value="'+cargo+'"readonly></td><td><input type="text" name="Dias[]" value="'+Dias+'"readonly></td></tr>'
        cont++;
        limpiar();
        $('#detalles').append(fila);
        
        
    }
    else{
        alert("Error al ingresar al Empleado, Revise los datos seleccionados");
    }
 }

function limpiar(){
    $("#IDEMPLEADO").val("");
    $("#Cod_Empleado").val("");
    $("#Nombre_Cargo").val("");
    $("#Dias_T").val(15);
}

function eliminar(index){
    $("#fila"+ index).remove();

}

function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}



</script>
@endpush

@endsection