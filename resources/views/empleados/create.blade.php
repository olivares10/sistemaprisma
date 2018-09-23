@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Ingreso de Nuevo Empleado</h3>
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
            {!!Form::open (array('url'=>'/empleados','method'=>'POST','autocomplete'=>'off')) !!}
            {{Form::token()}}

    <div class='row'>
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Primer Nombre</label>
                <input type="text" name="PRIMER_NOMBRE" required value="{{old('PRIMER_NOMBRE')}}" class="form-control" placeholder="Primer Nombre">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Segundo Nombre</label>
                <input type="text" name="SEGUNDO_NOMBRE"  value="{{old('SEGUNDO_NOMBRE')}}" class="form-control" placeholder="Segundo Nombre">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Primer Apellido</label>
                <input type="text" name="PRIMER_APELLIDO" required value="{{old('PRIMER_APELLIDO')}}" class="form-control" placeholder="Primer Apellido">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="Nombre">Segundo Apellido</label>
                <input type="text" name="SEGUNDO_APELLIDO"  value="{{old('SEGUNDO_APELLIDO')}}" class="form-control" placeholder="Segundo Apellido">
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">    
                <label>Estado Civil</label>
                <select name="ESTADO_CIVIL"  class="form-control">               
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                </select>    

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">    
                <label>Cargo</label>
                <input type="hidden" name="ID_Cargo_ID" id="ID_Cargo_ID" required>
                <select name="ID_Cargo" id="ID_Cargo" class="form-control">
                @foreach ($cargos as $cargo)
                    <option value="{{$cargo->ID_Cargo}}_{{$cargo->Salario_Base}}">{{$cargo->Nombre_Cargo}}</option>
                @endforeach    
                </select>    

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Salario">Salario Base</label>
                <input type="text" name="Salario_Base" required id="Salario_Base" class="form-control" placeholder="Selecciona un Cargo..." readonly>
            </div>
         </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="NO_INSS">NO_INSS</label>
                <input type="text" name="NO_INSS" class="form-control" value="{{old('NO_INSS')}}" placeholder="NO_INSS..." >
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="CEDULA">CEDULA</label>
                <input type="text" name="CEDULA" required class="form-control" value="{{old('CEDULA')}}" placeholder="CEDULA..." >
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Email">Email</label>
                <input type="mail" name="Email" class="form-control" value="{{old('Email')}}" placeholder="Email..." >
            </div>
         </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Telefono">Telefono Casa</label>
                <input type="text" name="Telefono"  class="form-control" value="{{old('Telefono')}}" placeholder="Telefono..." onkeypress="return valida(event)"maxlength="8">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Celular">Celular</label>
                <input type="text" name="Celular"  class="form-control" value="{{old('Celular')}}" placeholder="Celular..." onkeypress="return valida(event)"maxlength="8">
            </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
             <div>
                <label for="ANIOS_D_EXPERIENCIA">Años De Experiencia</label>
                <input type="text" name="ANIOS_EXPERIENCIA"  value="{{old('ANIOS_EXPERIENCIA')}}" class="form-control" placeholder="Años de Experiencia.." onkeypress="return valida(event)">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Fecha">Fecha De Ingreso</label>
                <input type="date" name="FECHA_INGRESO" required class="form-control" value="{{old('FECHA_INGRESO')}}" placeholder="aaa-mm-dd" >
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div >
                <label for="Direccion">Direccion</label>
                <input type="text" name="DIRECCION" required class="form-control" value="{{old('DIRECCION')}}" placeholder="Direccion..." >
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Usuario del sistema</label>
                <select name="ID_User" class="form-control">
                     @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>                 
                      @endforeach  
                </select>   
                 </div>
             </div>
    </div> 

            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

            {!!Form::close()!!}
        <!--</div>--> 
         
   <!--</div>--> 

@push ('scripts')
<script>
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

$("#ID_Cargo").change(mostrarvalor);
function mostrarvalor(){
  datosvalor=document.getElementById('ID_Cargo').value.split('_');
  $("#Salario_Base").val(datosvalor[1]);
  $("#ID_Cargo_ID").val(datosvalor[0]);
}

</script>
@endpush

@endsection