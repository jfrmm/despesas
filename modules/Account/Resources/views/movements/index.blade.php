@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="btn-group accoes" role="group" aria-label="accoes">
                <a href="/movimentos/create" role="button" class="btn btn-default call-create-modal">@lang('messages.crud.create')</a>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('messages.table.actions')</th>
                                    <th>@lang('account::messages.movements.fields.id')</th>
                                    <th>@lang('account::messages.movements.fields.date')</th>
                                    <th>@lang('account::messages.movements.fields.description')</th>
                                    <th>@lang('account::messages.movements.fields.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movements as $movement)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('movements.show', ['id' => $movement->id ]) }}" role="button" class="btn btn-xs btn-default"><i class="fa fa-circle" aria-hidden="true"></i></a>
                                            <a href="{{ route('movements.edit', ['id' => $movement->id ]) }}" role="button" class="btn btn-xs btn-default call-edit-modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="{{ route('movements.destroy', ['id' => $movement->id ]) }}" role="button" class="btn btn-xs btn-default call-delete-modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $movement->id }}</td>
                                    <td>{{ $movement->date }}</td>
                                    <td>{{ $movement->description }}</td>
                                    <td>{{ $movement->amount }}</td>
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