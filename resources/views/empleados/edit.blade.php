
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Data Basica: {{$empleados->PRIMER_NOMBRE}} {{$empleados->PRIMER_APELLIDO}}</h3>
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
           
            {!!Form::model($empleados,['method'=>'PATCH','route'=>['empleados.update',$empleados->ID_EMPLEADO]]) !!}
            {{Form::token()}}


            <div class='row'>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Primer Nombre</label>
                     <input type="text" name="PRIMER_NOMBRE" required value="{{$empleados->PRIMER_NOMBRE}}" class="form-control" placeholder="Primer Nombre">
                 </div>
     
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Segundo Nombre</label>
                     <input type="text" name="SEGUNDO_NOMBRE"  value="{{$empleados->SEGUNDO_NOMBRE}}" class="form-control" placeholder="Segundo Nombre">
                 </div>
     
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Primer Apellido</label>
                     <input type="text" name="PRIMER_APELLIDO" required value="{{$empleados->PRIMER_APELLIDO}}" class="form-control" placeholder="Primer Apellido">
                 </div>
     
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Segundo Apellido</label>
                     <input type="text" name="SEGUNDO_APELLIDO"  value="{{$empleados->SEGUNDO_APELLIDO}}" class="form-control" placeholder="Segundo Apellido">
                 </div>
     
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div>
                     <label for="Nombre">Codigo de empleado</label>
                     <input type="text" name="Cod_Empleado"  value="{{$empleados->Cod_Empleado}}" class="form-control" placeholder="codigo de empleado">
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
                     <select name="ID_Cargo" class="form-control" data-live-search="true" id="ID_Cargo">


                     @foreach ($cargos as $cargo)
                    @if ($cargo->ID_Cargo==$empleados->ID_CARGO)
                    <option value="{{$cargo->ID_Cargo}}" selected>{{$cargo->Nombre_Cargo}}</option>
                    @else
                    <option value="{{$cargo->ID_Cargo}}">{{$cargo->Nombre_Cargo}}</option>
                    @endif
                   
                    @endforeach    
                     </select>    
     
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Salario Base</label>
                     <input type="text" name="Salario_Base"  required value="{{$empleados->Salario_Base}}" class="form-control" placeholder="Salario Base">  
     
                 </div>
             </div>

             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Estado Empleado</label>
                <select name="ID_ESTADO" class="form-control">
                     @foreach ($estado_empleados as $estado_empleado)
                    @if ($estado_empleado->ID_ESTADO==$empleados->ID_ESTADO)
                    <option value="{{$estado_empleado->ID_ESTADO}}" selected>{{$estado_empleado->NOMBRE}}</option>
                    @else
                    <option value="{{$estado_empleado->ID_ESTADO}}">{{$estado_empleado->NOMBRE}}</option>
                    @endif                   
                      @endforeach  
                </select>   
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="NO_INSS">NO_INSS</label>
                     <input type="text" name="NO_INSS" class="form-control" value="{{$empleados->NO_INSS}}" placeholder="NO_INSS..." >
                 </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="CEDULA">CEDULA</label>
                     <input type="text" name="CEDULA" required class="form-control" value="{{$empleados->CEDULA}}" placeholder="CEDULA..." >
                 </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Email">Email</label>
                     <input type="mail" name="Email" class="form-control" value="{{$empleados->Email}}" placeholder="Email..." >
                 </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Telefono">Telefono Casa</label>
                     <input type="text" name="Telefono"  class="form-control" value="{{$empleados->Telefono}}" placeholder="Telefono..." onkeypress="return valida(event)"maxlength="8">
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Celular">Celular</label>
                     <input type="text" name="Celular"  class="form-control" value="{{$empleados->Celular}}" placeholder="Celular..." onkeypress="return valida(event)"maxlength="8">
                 </div>
             </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <div>
                     <label for="ANIOS_D_EXPERIENCIA">Años De Experiencia</label>
                     <input type="text" name="ANIOS_EXPERIENCIA"  value="{{$empleados->ANIOS_EXPERIENCIA}}" class="form-control" placeholder="Años de Experiencia.." onkeypress="return valida(event)">
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Fecha">Fecha De Ingreso</label>
                     <input type="date" name="FECHA_INGRESO" required class="form-control" value="{{$empleados->FECHA_INGRESO}}" placeholder="dd/mm/aaaa" >
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div >
                     <label for="Direccion">Direccion</label>
                     <input type="text" name="DIRECCION" required class="form-control" value="{{$empleados->DIRECCION}}" placeholder="Direccion..." >
                 </div>
             </div>
             </br>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Sindicalizado</label>
                     @if ($empleados->Sindicalizado==0)
                     <input  name="Sindicalizado" type="checkbox" >
                    @else
                    <input checked="checked" name="Sindicalizado" type="checkbox">
                    @endif  
                     
                 </div>
             </div>
             </br>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Salario Variable</label>
                     @if ($empleados->Salario_V==0)
                     <input  name="Salario_V" type="checkbox" >
                    @else
                    <input checked="checked" name="Salario_V" type="checkbox">
                    @endif                       
                 </div>
             </div>
         <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <div class="form-group">    
                     <label>Usuario del sistema</label>
                <select name="ID_User" class="form-control">
                     @foreach ($users as $user)
                    @if ($user->id==$empleados->ID_User)
                    <option value="{{$user->id}}" selected>{{$user->name}}</option>
                    @else
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endif                   
                      @endforeach  
                </select>   
                 </div>
             </div>-->
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
     </script>

    <script src="{{ url('js/bootstrap-select.min.js') }}"></script>
    @endpush
@endsection