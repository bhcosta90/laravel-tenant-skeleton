@extends('layouts.app')

@section('content')
<x-card title='Relatório de usuário' :data="$data" add="{{route('user.create')}}" label_add="Adicionar usuário">
    <table class='table table-striped table-responsive-md mb-0'>
        <tr>
            <th>{{ __('Nome') }}</th>
            <th>{{ __('E-mail') }}</th>
        </tr>

        @foreach($data as $rs)
        <tr>
            <td>{{ $rs->name->value }}</td>
            <td><a href="mailto:{{ $rs->login->value }}">{{ $rs->login->value }}</a></td>
        </tr>
        @endforeach
    </table>
</x-card>
@endsection
