@component('mail::message')
# Tus credenciales para acceder a {{config('app.name')}}
Que tal Sr/Sra <strong>{{ $name }} {{ $last_name }}.</strong>
Recibe este email porque se creó una cuenta con su correo electrónico como <strong>curador</strong> en <strong>CREA SONIDOS PACIFICO.</strong><br>

Utiliza estas credenciales para acceder al sistema.

@component('mail::table')

| Usuario | Contraseña |
|:---------|:------------|
| {{ $user }} | {{ $password }} |


@endcomponent
@component('mail::button', ['url' => url('/dashboard')])
    Iniciar Sesión
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
