
<x-mail::message>
# Reset Your Password

<x-mail::button :url="$link">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
