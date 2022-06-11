@extends('layouts.app')

@section('content')
<x-card title='Cadastro de usuário'>
    <div class='card-body'>
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            <div class='row'>
                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Nome') }}</label>
                    <input type="text" name="name" value="{{ old('name')}}" class='form-control'>
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Login') }}</label>
                    <input type="text" name="login" value="{{ old('login')}}" class='form-control'>
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Password') }}</label>
                    <input type="password" name="password" class='form-control'>
                </div>
            </div>

            <button class='float-end btn btn-outline-primary btn-block'>{{ __('Cadastrar') }}</button>
        </form>
    </div>
</x-card>
@endsection
