<x-mail::message>
# Nouveau message de contact

## Informations de contact
- Entreprise : {{ $contactMail->company }}
- Prénom : {{ $contactMail->firstName }}
- Nom : {{ $contactMail->lastName }}
- Email : {{ $contactMail->email }}
- Téléphone : {{ $contactMail->phoneNumber ?: 'Non fourni' }}
- Site web : {{ $contactMail->website ?: 'Non fourni' }}

@if (!empty($contactMail->services))
## Services demandés
@foreach(json_decode($contactMail->services, true) as $service)
- {{ $service }}
@endforeach
@endif

@if (!empty($contactMail->budget))
## Budget
@php
$budget = json_decode($contactMail->budget, true);
@endphp
Min : {{ number_format($budget[0], 0, ',', ' ') }} €
Max : {{ number_format($budget[1], 0, ',', ' ') }} €
@endif

@if ($contactMail->message)
## Message
{{ $contactMail->message }}
@endif

{{ config('app.name') }}
</x-mail::message>
