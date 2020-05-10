@component('mail::message')
Dear {{ $user->name }},

Your password was changed.

-----------
<sub>The password for your {{ config('app.name') }} account {{ $user->email }} was changed. If you didn't change it, please contact the administrator at <a href="mailto:{{ env('ADMIN_EMAIL') }}?subject=Unauthorized Password Changed">{{ env('ADMIN_EMAIL') }}</a></sub>
@endcomponent
