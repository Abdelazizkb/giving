@component('mail::message')
# Bonjour

Vous avez publié un aide dans la platform <strong>givingcom</strong>

@component('mail::button', ['url' => $url ])
Publication
@endcomponent


<strong>{{$user->first_name}} {{$user->last_name}}</strong>
Je suis interesse ci-jointes mes coordonnées
telephone : {{$user->phone}}

email :{{$user->email}}

consulter mon profile
@component('mail::button', ['url' => $url1])
Demandeur
@endcomponent
Merci,<br>
{{ config('app.name') }}
@endcomponent