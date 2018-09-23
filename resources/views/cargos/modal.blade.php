<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cat->ID_Cargo}}" style="display:none;">
{{Form::Open(array('action'=>array('CargoController@destroy',$cat->ID_Cargo),'method'=>'DELETE'))}}
{{Form::token()}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>   
                <h4 class="Modal-title" > Eliminar Puesto</h4>    
        </div>    
        <div class="modal-body">
            <p>Confirme si desea Eliminar el Puesto Seleccionado </p>
            <h4>{{$cat->Nombre_Cargo}}</h4>
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