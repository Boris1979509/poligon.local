@component('mail::message')
    # Email Confirmation

    Please refer to the following link:
    @php
        /**
        * @var App\Models\User $user
        */
    @endphp
    @component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
        Verify Email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
