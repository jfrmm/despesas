<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar movimento #{{$movimento->id}} - {{$movimento->descricao}}</h4>
            </div>
            
            <div class="modal-body">
                Tem a certeza que deseja avançar com esta eliminação?
            </div>
            
            <div class="modal-footer">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary confirm" data-url="/movimentos/{{$movimento->id}}">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>