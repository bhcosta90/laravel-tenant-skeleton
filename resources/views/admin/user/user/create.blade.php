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
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('E-mail') }}</label>
                    <input type="email" name="login" value="{{ old('login')}}" class='form-control'>
                    @error('login')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Password') }}</label>
                    <input type="password" name="password" value="{{ old('password')}}" class='form-control'>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class='float-end btn btn-outline-primary btn-block'>{{ __('Cadastrar') }}</button>
        </form>
    </div>
</x-card>
@endsection
