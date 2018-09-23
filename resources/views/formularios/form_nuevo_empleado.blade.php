<section class="content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="cerrarmodal(1);" >
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ingreso de nuevo Empleado</h4>
              </div>
    <div class="col-md-12">

        <div class="box box-primary  box-gris">
 
            <div class="box-header with-border my-box-header">
             <h3 class="box-title"><strong>Nuevo Empleado</strong></h3>
            </div><!-- /.box-header -->
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <hr style="border-color:white;" />
 
             <div class="box-body">
<!--------------- /.box-body ------------------------>

        
  <form   action="{{ url('crear_usuario') }}"  method="post" id="f_crear_usuario" class="formentrada" >
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 

                <div class="col-md-6">
                <div class="form-group">
                <label class="col-sm-2" for="nombre">Primer Nombre*</label>
                <div class="col-sm-10" >
                <input type="text" class="form-control" id="Primer_nombre" name="Primer_nombre"  required   >
                </div>
                </div><!-- /.form-group -->

           

                </div><!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                <label class="col-sm-2" for="snombre">Segundo Nombre</label>
                <div class="col-sm-10" >
                <input type="text" class="form-control" id="Segundo_nombre" name="Segundo_nombre"  >
                </div>
                </div><!-- /.form-group -->

           

          </div><!-- /.col -->
                
        <div class="col-md-6">
                  <div class="form-group">
									  <label class="col-sm-2" for="apellido">Primer Apellido*</label>
                    <div class="col-sm-10" >
										<input type="text" class="form-control" id="Primer_apellidos" name="Primer_apellidos"  required >
                    </div>
									</div><!-- /.form-group -->

				</div><!-- /.col -->

        <div class="col-md-6">
                  <div class="form-group">
									  <label class="col-sm-2" for="sapellido">Segundo Apellido*</label>
                    <div class="col-sm-10" >
										<input type="text" class="form-control" id="Segundo_apellidos" name="Segundo_apellidos"   >
                    </div>
									</div><!-- /.form-group -->

				</div><!-- /.col -->

        <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-2" for="celular">Telefono*</label>
                       
                       <div class="col-sm-10" >
                        <input type="text" class="form-control" id="telefono" name="telefono" required >
                       </div>

                      </div><!-- /.form-group -->

        </div><!-- /.col -->        
        <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-2" for="Cedula">Cedula*</label>
                       
                       <div class="col-sm-10" >
                        <input type="text" class="form-control" id="telefono" name="telefono" required >
                       </div>

                      </div><!-- /.form-group -->

        </div><!-- /.col -->    

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-2" for="INSS">INSS*</label>
                       
                       <div class="col-sm-10" >
                        <input type="text" class="form-control" id="INSS" name="INSS" required >
                       </div>

                      </div><!-- /.form-group -->

        </div><!-- /.col -->   


                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-2" for="Direccion">Direccion*</label>
                       
                       <div class="col-sm-10" >
                        <input type="text" class="form-control" id="Direccion" name="Direccion" required >
                       </div>

                      </div><!-- /.form-group -->

        </div><!-- /.col -->     

                      <hr style="border-color:white;" />
        <h3 class="box-title"><strong>Puesto</strong></h3>
                <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-sm-2" for="Area">Area*</label>
                      <!-- /.<div class="col-sm-10" >
                      <input type="text" class="form-control" id="Area" name="Area"  required >
                      </div>-->
                      
                   </div><!-- /.form-group -->
                                                 
                                                    
                                                     
                                                
                  </div><!-- /.col -->
                  

                  <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-2" for="email">Cargo*</label>
                    <div class="col-sm-10" >
                    <input type="text" class="form-control" id="Cargo" name="Cargo"  required >
                    </div>
                        {!!Form::select('area',$area,null,['ID_Area'=>'area'])!!}
                    </div><!-- /.form-group -->

                  </div><!-- /.col -->


            



                    <div class="box-footer col-xs-12 box-gris ">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>


  </form>






















 <!--------------- /.box-body ------------------------>      
            </div>
                    
        </div>
                       
    </div>
</section>

