@extends('layouts.app')

@section('title', ' | Contas | Criar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="/contas">

                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">@lang('account::messages.accounts.fields.name')</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="@lang('account::messages.accounts.fields.name')" value="{{ old('name') }}">
                </div>

                <div class="form-group {{ $errors->has('iban') ? 'has-error' : '' }}">
                    <label for="iban">@lang('account::messages.accounts.fields.iban')</label>
                    <input type="text" class="form-control" id="iban" name="iban" placeholder="@lang('account::messages.accounts.fields.iban')" value="{{ old('iban') }}">
                </div>

                <button type="submit" class="btn btn-default">Gravar</button>

            </form>
        </div>
    </div>
@endsection