<!DOCTYPE html>
<html>
<head>
    <title>Bem-vindo(a) - PayNet Laravel</title>
</head>
<body>
    <h2>Olá, {{ $user->name }}!</h2>
    <p>Sua conta foi criada com sucesso.</p>
    <p>Você pode <a href="{{ route('login') }}">entrar na sua conta aqui</a>.</p>

    <p>Não responda este e-mail.</p>
</body>
</html>
