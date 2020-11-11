@component('mail::message')
# Tus credenciales para acceder a CREAR SONIDOS PACIFICO como Subsanador.

Utiliza estas credenciales para acceder al sistema.

@component('mail::table')
| Usuario | Contraseña |
|:---------|:------------|
| {{ $user }} | {{ $password }} |


@endcomponent
@component('mail::button', ['url' => url('/login')])
        Login
@endcomponent

Gracias,<br>
CREA SONIDOS PACIFICO
@endcomponent
