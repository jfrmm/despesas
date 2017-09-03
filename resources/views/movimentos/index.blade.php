@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="btn-group accoes" role="group" aria-label="accoes">
                <a href="/movimentos/create" role="button" class="btn btn-default call-create-modal">Novo</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Acções</th>
                                    <th>Id</th>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movimentos as $movimento)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/movimentos/{{$movimento->id}}" role="button" class="btn btn-xs btn-default"><i class="fa fa-circle" aria-hidden="true"></i></a>
                                            <a href="/movimentos/{{$movimento->id}}/edit" role="button" class="btn btn-xs btn-default call-edit-modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="/movimentos/{{$movimento->id}}/delete" role="button" class="btn btn-xs btn-default call-delete-modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $movimento->id }}</td>
                                    <td>{{ $movimento->data }}</td>
                                    <td>{{ $movimento->descricao }}</td>
                                    <td>{{ $movimento->valor }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection