@extends('layouts.app')

@section('content')
<x-card title='Editar usuário'>
    <div class='card-body'>
        <form action="{{route('user.update', $model->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class='row'>
                <div class='form-group col-6 mb-3'>
                    <label class='control-label'>{{ __('Nome') }}</label>
                    <input type="text" name="name" value="{{ old('name') ?? $model->name}}" class='form-control'>
                </div>

                <div class='form-group col-6 mb-3'>
                    <label class='control-label'>{{ __('Login') }}</label>
                    <input type="text" name="login" value="{{ old('login') ?? $model->login}}" class='form-control'>
                </div>
            </div>

            <button class='float-end btn btn-outline-primary btn-block'>{{ __('Editar') }}</button>
        </form>
    </div>
</x-card>
@endsection
