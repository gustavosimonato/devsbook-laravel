<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login - Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <header>
        <div class="container">
            <a href=""><img src="images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST">
            @if (session('warning'))
            <div class="flash">
                {{ session('warning')}}
            </div>
            @endif

            @csrf
            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" required />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" required />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="{{ route('register') }}">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>
</body>

</html>