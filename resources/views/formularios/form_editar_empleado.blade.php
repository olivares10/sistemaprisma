
<section >
<div class="row" >

<div class="col-md-12">

  <div class="box box-primary box-gris">
     
    
  </div>
  
  <div class="box box-primary box-gris">
 
      <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Editar Informacion Usuario</strong></h3>
      </div><!-- /.box-header -->
      <hr style="border-color:white;" />
      <div id="notificacion_E2" ></div>
      <div class="box-body">
              
        

          <form   action="{{ url('editar_empleado') }}"  method="post" id="f_editar_empleado"  class="formempleado"  >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" name="ID" value="{{ $empleado->ID_EMPLEADO }}"> 

          <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-2" for="nombre">Primer Nombre*</label>
                    <div class="col-sm-10" >
                      <input type="text" class="form-control" id="P_Nombre" name="nombres"  value="{{ $empleado->PRIMER_NOMBRE }}"  required   >
                       </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->
                
              <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-2" for="nombre">Segundo Nombre</label>
                    <div class="col-sm-10" >
                      <input type="text" class="form-control" id="S_Nombre" name="snombres"  value="{{ $empleado->SEGUNDO_NOMBRE }}"  required   >
                       </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->

          <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-2" for="apellido">Apellido*</label>
                    <div class="col-sm-10" >
                    <input type="text" class="form-control" id="P_Apellido" name="apellidos" "  value="{{ $empleado->PRIMER_APELLIDO }}" required >
                    </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->

         <div class="col-md-6">
              <div class="form-group">
                    <label class="col-sm-2" for="apellido">Segundo Apellido*</label>
                    <div class="col-sm-10" >
                    <input type="text" class="form-control" id="S_Apellido" name="sapellidos" "  value="{{ $empleado->PRIMER_APELLIDO }}" required >
                    </div>
              </div><!-- /.form-group -->
          </div><!-- /.col -->
        

          <div class="box-footer col-xs-12 box-gris ">
                <button type="submit" class="btn btn-primary">Actualizar Datos</button>
          </div>

          </form>

        
                
                    
      </div>
                    
    </div>







  <div class="box box-primary   box-gris" style="margin-bottom: 200px;">
    <div class="box-header with-border my-box-header">
        <h3 class="box-title"><strong>Acceso al sistema</strong></h3>
    </div><!-- /.box-header -->
    <div id="notificacion_E3" ></div>
    <div class="box-body">


                  <div class="box-header with-border my-box-header col-md-12" style="margin-bottom:15px;margin-top: 15px;">
                    <h3 class="box-title">Datos de acceso</h3>
                  </div>
       

                <form   action="{{ url('editar_acceso') }}"  method="post" id="f_editar_acceso"  class="formentrada"  >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                <input type="hidden" name="id_usuario" value="{{ $usuario->id }}"> 

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="email">eMail*</label>
                    <div class="col-sm-10" >
                    <input type="email" class="form-control" id="email" name="email"  value="{{ $usuario->email  }}"  required >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="email">Nuevo Password*</label>
                    <div class="col-sm-10" >
                    <input type="password" class="form-control" id="password" name="password"  required >
                    </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->


                    <div class=" col-xs-12 box-gris ">
                                        <button type="submit" class="btn btn-primary">Actualizar Acceso</button>
                    </div>

                   </form>

         </div>

  </div>
  </div>                     
</div>
</section>