<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redefinição de Senha</title>
    <style>
        /* Adicione estilos conforme necessário */
    </style>
</head>
<body>
    <h1>Redefinição de Senha</h1>
    <p>Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.</p>
    <p>Para redefinir sua senha, clique no link abaixo:</p>
    <a href="{{ url('password/reset', request('_token')) . '?email=' . request('email') }}">Redefinir Senha</a>
    <p>Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.</p>
    <p>Obrigado!</p>
</body>
</html>
