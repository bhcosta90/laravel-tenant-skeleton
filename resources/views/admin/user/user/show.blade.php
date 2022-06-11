@extends('layouts.app')

@section('content')
<x-card title='Cadastro de usuário'>
    <div class='card-body'>
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            <div class='row'>
                <div class='form-group col-6 mb-3'>
                    <label class='control-label'>{{ __('Nome') }}</label>
                    <h4>{{$model->name}}</h4>
                </div>

                <div class='form-group col-6 mb-3'>
                    <label class='control-label'>{{ __('Login') }}</label>
                    <h4>{{$model->login}}</h4>
                </div>
            </div>
            <a href="{{ route('user.edit', $model->id) }}" class='float-end btn btn-outline-primary btn-block'>{{ __('Editar') }}</a>
        </form>
    </div>
</x-card>
@endsection
