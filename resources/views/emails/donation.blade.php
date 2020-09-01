@component('mail::message')
# Bonjour
Vous avez publier un demande d'aide dans la platform  <strong>givingcom</strong>
@component('mail::button', ['url' => $url ])
Publication
@endcomponent


<strong>{{$user->first_name}} {{$user->last_name}}</strong>
je veux vous aider contacter moi ci-joint mes coordonnees

telephone : {{$user->phone}}

email :{{$user->email}}

consulter mon profile
@component('mail::button', ['url' => $url1])
Donateur
@endcomponent
Merci,<br>
{{ config('app.name') }}
@endcomponent