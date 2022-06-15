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
                    <input type="text" name="name" value="{{ old('name') ?? $model->name}}" class='form-control @error('name') is-invalid @enderror'>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class='form-group col-6 mb-3'>
                    <label class='control-label'>{{ __('E-mail') }}</label>
                    <input type="email" name="login" value="{{ old('login') ?? $model->login}}" class='form-control @error('login') is-invalid @enderror"'>
                    @error('login')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class='float-end btn btn-outline-primary btn-block'>{{ __('Editar') }}</button>
        </form>
    </div>
</x-card>
@endsection
