<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-NUEVO-{{$proyectos->ID_PROYECTO}}" style="display:none;">


<form   action="{{ url('agregar_empleado') }}"  method="post" id="f_agregar_empleado" class="formentrada" >
{{Form::token()}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>   
                <h4 class="Modal-title" > Eliminar Proyecto</h4>    
        </div>    
        <div class="modal-body">
            <p>Confirme si desea Eliminar el Proyecto </p>
            <h4>{{$proyectos->ID_PROYECTO}}</h4>

                        <label for="respon">Grupo De Trabajo</label>
                     
                        <select name="ID_EMPLEADO2" id="ID_EMPLEADO2"  >
                        @foreach ($empleados as $empleado)          
                        <option value="{{$empleado->ID_EMPLEADO}}">{{$empleado->Empleado}}</option>
                        @endforeach
                        </select>

        </div>    
        <div class="modal-footer">
            <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" >Confirmar</button>
            <!--<button type="submit" class="btn btn-primary" data-dismiss="modal">Confirmar</button> -->  
        </div> 
    </div>
</div>
</form>

</div>