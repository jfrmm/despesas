@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="btn-group accoes" role="group" aria-label="accoes">
                <a href="/contas/create" role="button" class="btn btn-default">Novo</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Acções</th>
                                <th>Conta</th>
                                <th>IBAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contas as $conta)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="/contas/{{$conta->id}}" role="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                        <a href="/contas/{{$conta->id}}/edit" role="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        <a href="/contas/{{$conta->id}}/delete" role="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                    </div>
                                </td>
                                <td>{{ $conta->nome }}</td>
                                <td>{{ $conta->iban }}</td>
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