@extends('layouts.app')

@section('title', ' | Contas | Eliminar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <p>Tem a certeza que deseja eliminar {{$conta->nome}}?

            <div class="btn-group" role="group">
                <a href="{{ url()->previous() }}" role="button" class="btn btn-default">Voltar</a>
                <a href="/contas/{{$conta->id}}/destroy" role="button" class="btn btn-default">Eliminar</a>
            </div>

        </div>
    </div>
@endsection