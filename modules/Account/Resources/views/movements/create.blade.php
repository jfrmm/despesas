<!-- Modal -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Criar movimento</h4>
            </div>
            
            <div class="modal-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="/movimentos">

                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('conta') ? 'has-error' : '' }}">
                        <label for="conta_id">Conta</label>
                        <select class="form-control" id="conta_id" name="conta_id">
                            @foreach($contas as $conta)
                            <option value="{{$conta->id}}">{{$conta->nome}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group {{ $errors->has('data') ? 'has-error' : '' }}">
                        <label for="data">Data</label>
                        <input type="date" class="form-control required" id="data" name="data" placeholder="Data" value="{{ old('data') }}">
                    </div>
                    
                    <div class="form-group {{ $errors->has('valor') ? 'has-error' : '' }}">
                        <label for="valor">Valor</label>
                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{ old('valor') }}">
                    </div>

                    <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{ old('descricao') }}">
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary confirm" data-url="/movimentos">Gravar</button>
                </div>
            </div>
            
        </div>
    </div>
</div>