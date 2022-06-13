@extends('layouts.app')

@section('content')
<x-card title='Relatório de usuário' :data="$data" add="{{route('user.create')}}" label_add="Adicionar usuário">
    <table class='table table-striped table-responsive-md mb-0 table-report'>
        <tr>
            <th>{{ __('Nome') }}</th>
            <th>{{ __('E-mail') }}</th>
            <th style='width:1px'>{{ __('Criado em') }}</th>
            <th style='width:1px'>{{ __('Ações') }}</th>
        </tr>

        @foreach($data as $rs)
        <tr>
            <td>{{ $rs->name->value }}</td>
            <td><a href="mailto:{{ $rs->login->value }}">{{ $rs->login->value }}</a></td>
            <td>{{ $rs->createdAt('d/m/Y') }}</td>
            <td>
                {!! links([
                    "edit" => [
                        "link" => route('user.edit', $rs->id)
                    ],
                    "delete" => [
                        "link" => route('user.destroy', $rs->id)
                    ]
                ]) !!}
            </td>
        </tr>
        @endforeach
    </table>
</x-card>
@endsection
