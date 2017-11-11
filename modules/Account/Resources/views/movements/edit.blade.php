<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar movimento #{{$movimento->id}} - {{$movimento->descricao}}</h4>
            </div>
            
            <div class="modal-body">

                <form method="POST" action="/movimentos/{{$movimento->id}}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="conta_id">Conta</label>
                        <select class="form-control" id="conta_id" name="conta_id">
                            @foreach($contas as $conta)
                            <option value="{{$conta->id}}" @if($movimento->conta_id == $conta->id) selected @endif>{{$conta->nome}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control required" id="data" name="data" placeholder="Data" value="{{ $movimento->data }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{ $movimento->valor }}">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ $movimento->descricao }}">
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary confirm" data-url="/movimentos/{{$movimento->id}}">Gravar</button>
                </div>
            </div>
            
        </div>
    </div>
</div>