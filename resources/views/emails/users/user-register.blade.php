@component('mail::message')
# Hi, {{$admin->name}}

A new user registered {{$user->created_at->diffForHumans()}}!

## {{$user->name}} <br> {{$user->email}}

@component('mail::button', ['url' => route('dashboard')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
