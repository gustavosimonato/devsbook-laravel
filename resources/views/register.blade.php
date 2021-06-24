<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Cadastro - Devsbook</title>
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

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="flash"> {{ $error }} </div>
                @endforeach
            @endif


            @csrf

            <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" />

            <input placeholder="Digite seu E-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua Senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua Data de Nascimento" class="input" type="text" name="birthdate" id="birthdate" />

            <input class="button" type="submit" value="Fazer cadastro" />

            <a href="{{ route('login') }}">Já tem conta? Faça o login</a>
        </form>
    </section>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
    document.getElementById('birthdate'),
    {
        mask:'00/00/0000'
    }
);
    </script>
</body>

</html>