@component('mail::message')
# Tus credenciales para acceder a {{config('app.name')}}

Utiliza estas credenciales para acceder al sistema.

@component('mail::table')

     | Usuario | Contraseña |
     |:---------|:------------|
     | {{ $user }} | {{ $password }} |


@endcomponent
@component('mail::button', ['url' => url('/dashboard')])
        Login
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
