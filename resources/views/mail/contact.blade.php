<x-mail::message>
# Nouveau message de contact

## Informations de contact
<x-mail::table>
| Champ | Valeur |
| ----- | ------ |
| Entreprise | {{ e($contactMail->company) }} |
| Prénom | {{ e($contactMail->firstName) }} |
| Nom | {{ e($contactMail->lastName) }} |
| Email | {{ e($contactMail->email) }} |
| Téléphone | {{ e($contactMail->phoneNumber) ?: 'Non fourni' }} |
| Site web | {{ e($contactMail->website) ?: 'Non fourni' }} |
</x-mail::table>

@if ($contactMail->message)
## Message
<x-mail::panel>
{{ e($contactMail->message) }}
</x-mail::panel>
@endif

@if (!empty($contactMail->services))
## Services demandés
<x-mail::table>
| Services |
| -------- |
@foreach(json_decode($contactMail->services, true) as $service)
| {{ e($service) }} |
@endforeach
</x-mail::table>
@endif

@if (!empty($contactMail->budget))
## Budget
<x-mail::table>
| Min | Max |
| --- | --- |
@php
    $budget = json_decode($contactMail->budget, true);
@endphp
| {{ number_format($budget[0], 0, ',', ' ') }} € | {{ number_format($budget[1], 0, ',', ' ') }} € |
</x-mail::table>
@endif

<x-mail::subcopy>
Ce message a été généré automatiquement. Veuillez ne pas y répondre directement.
</x-mail::subcopy>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
