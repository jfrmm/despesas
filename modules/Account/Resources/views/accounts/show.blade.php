@extends('layouts.app')

@section('title', ' | Contas | Ver')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (!empty($message))
            <div class="alert alert-{{$message['type']}}">
                {{$message['text']}}
            </div>
            @endif

            <dl class="dl-horizontal">
                <dt>Nome</dt>
                <dd>{{$conta->nome}}</dd>
            </dl>
            <dl class="dl-horizontal">
                <dt>IBAN</dt>
                <dd>{{$conta->iban}}</dd>
            </dl>

        </div>
    </div>
@endsection