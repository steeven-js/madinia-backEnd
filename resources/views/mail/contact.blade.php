@component('mail::message')
    # Bonjour

    Ceci est un message test.

    {{-- @component('mail::button', ['url' => '']) // Ajoutez l'URL dynamique ici
Button Text
@endcomponent --}}

    ## Contact Information
    - **Company:** {{ $contactMail->company }}
    - **First Name:** {{ $contactMail->firstName }}
    - **Last Name:** {{ $contactMail->lastName }}
    - **Email:** {{ $contactMail->email }}
    - **Phone Number:** {{ $contactMail->phoneNumber }}

    @if ($contactMail->message)
        ## Message
        {{ $contactMail->message }}
    @endif

    Merci,<br>
    {{ config('app.name') }}
@endcomponent
