@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="btn-group accoes" role="group" aria-label="accoes">
                <a href="{{ route('accounts.create') }}" role="button" class="btn btn-default">@lang('messages.crud.create')</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('messages.table.actions')</th>
                                <th>@lang('account::messages.accounts.fields.name')</th>
                                <th>@lang('account::messages.accounts.fields.iban')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('accounts.show', ['id' => $account->id]) }}" role="button" class="btn btn-xs btn-default"><i class="fa fa-circle" aria-hidden="true"></i></a>
                                        <a href="{{ route('accounts.edit', ['id' => $account->id]) }}" role="button" class="btn btn-xs btn-default"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="{{ route('accounts.destroy', ['id' => $account->id]) }}" role="button" class="btn btn-xs btn-default"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->iban }}</td>
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