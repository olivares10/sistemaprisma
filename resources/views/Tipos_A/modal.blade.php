<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cat->ID}}" style="display:none;">
{{Form::Open(array('action'=>array('Tipo_ActividadesController@destroy',$cat->ID),'method'=>'DELETE'))}}
{{Form::token()}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>   
                <h4 class="Modal-title" > Eliminar Tipo De Actividad</h4>    
        </div>    
        <div class="modal-body">
            <p>Confirme si desea Eliminar el Tipo De Actividad Seleccionada </p>
        </div>    
        <div class="modal-footer">
            <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" >Confirmar</button>
            <!--<button type="submit" class="btn btn-primary" data-dismiss="modal">Confirmar</button> -->  
        </div> 
    </div>
</div>
{{Form::close()}}
</div>