@component('mail::message')
# Cadastro de Usuário

Olá {{$name}}, seja bem vindo ao sistema. Para acessar o sistema, utilize o seguinte login e senha: {{$password}}

@component('mail::button', ['url' => config('app.url')])
Acessar o sistema
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
