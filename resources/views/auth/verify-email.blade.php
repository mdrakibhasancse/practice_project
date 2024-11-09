<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
    @endif

    <p>
        Before proceeding, please check your email for a verification link.
        If you did not receive the email, you can request a new one below.
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</body>
</html>