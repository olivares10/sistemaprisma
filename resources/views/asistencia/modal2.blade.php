<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$proyec->ID_DETALLE}}" style="display:none;">


<form   action="{{ url('delete_fecha',$proyec->ID_DETALLE) }}"  method="post" id="f_eliminarFecha" class="formentrada" >
{{Form::token()}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>   
                <h4 class="Modal-title" > Eliminar Registre de fecha</h4>    
        </div>    
        <div class="modal-body">
            <p>Confirme si desea Eliminar este registro </p>
            <h4>{{$proyec->FECHA}}</h4>
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