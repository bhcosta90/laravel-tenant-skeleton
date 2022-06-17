@extends('layouts.app')

@section('content')
<div class='mb-3'>
    <x-card title='Editar dados'>
        <div class='card-body'>
            <form action="{{route('profile.store')}}" method="POST">
                @csrf
                <div class='row'>
                    <div class='form-group col-4 mb-3'>
                        <label class='control-label'>{{ __('Nome') }}</label>
                        <input type="text" name="name" value="{{ old('name') ?? $model->name}}" class='form-control @error('name') is-invalid @enderror'>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class='form-group col-4 mb-3'>
                        <label class='control-label'>{{ __('E-mail') }}</label>
                        <input type="email" name="login" value="{{ old('login') ?? $model->login}}" class='form-control @error('login') is-invalid @enderror"'>
                        @error('login')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class='form-group col-4 mb-3'>
                        <label class='control-label'>{{ __('Senha') }}</label>
                        <input type="password" name="password" value="{{ old('password')}}" class='form-control @error('password') is-invalid @enderror'>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button class='float-end btn btn-outline-primary btn-block'>{{ __('Editar') }}</button>
            </form>
        </div>
    </x-card>
</div>

<x-card title='Alterar senha'>
    <div class='card-body'>
        <form action="{{route('password.store')}}" method="POST">
            @csrf
            <div class='row'>
                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Senha atual') }}</label>
                    <input type="password" name="password" value="{{ old('password')}}" class='form-control @error('password') is-invalid @enderror'>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Nova senha') }}</label>
                    <input type="password" name="new_password" value="{{ old('new_password')}}" class='form-control @error('new_password') is-invalid @enderror'>
                    @error('new_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class='form-group col-4 mb-3'>
                    <label class='control-label'>{{ __('Confirmar nova senha') }}</label>
                    <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation')}}" class='form-control @error('new_password_confirmation') is-invalid @enderror'>
                    @error('new_password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class='float-end btn btn-outline-primary btn-block'>{{ __('Editar') }}</button>
        </form>
    </div>
</x-card>
@endsection
