<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$proyec->ID}}" style="display:none;">
{{Form::Open(array('action'=>array('Planilla_cicloController@destroy',$proyec->ID),'method'=>'DELETE'))}}
{{Form::token()}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>   
                <h4 class="Modal-title" > Eliminar Planilla</h4>    
        </div>    
        <div class="modal-body">
            <p>Confirme si desea Eliminar la planilla </p>
            <h4>Numero {{$proyec->ID}}</h4>
            <h4>{{$proyec->Periodo}}:{{$proyec->Mes}} </h4>   
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