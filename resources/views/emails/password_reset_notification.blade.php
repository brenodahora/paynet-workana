<!DOCTYPE html>
<html>
<head>
    <title>Senha Redefinida - PayNet Laravel</title>
</head>
<body>
    <h2>Olá, {{ $user->name }}!</h2>
    <p>Sua senha foi redefinida com sucesso.</p>
    <p>Se você não solicitou essa mudança, por favor, entre em contato com nosso suporte.</p>
    <p>Você pode <a href="{{ route('login') }}">entrar na sua conta aqui</a>.</p>

    <p>Não responda este e-mail.</p>
</body>
</html>
