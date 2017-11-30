<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login | X3 Soluções</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="login">
    <h2><img src="/imagens/logo_x3_login.png" width="193" height="46" alt=""/></h2>
    <form method="POST" action="/login" autocomplete="off">
        {{ csrf_field() }}
        @if (count($errors))
            <span class="lvalida"><label>Ops! Nome de usuário ou senha inválidos.</label></span>
        @endif
        <br>
        <input class="lfield" type="text" name="username" id="username" placeholder="Nome de usuário"><br/>
        <input class="lfield" type="password" name="password" placeholder="senha"><br/>
        <input class="lbnt" type="submit" value="Entrar">
        <a class="lforgot" href="#">Esqueci minha senha</a><br/>
    </form>
</div>
<script type="text/javascript">
    document.getElementById('username').focus();
</script>
</body>
</html>
