<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Devsbook</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="images/devsbook_logo.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="/pesquisa">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="/perfil" class="user-area">
                        <div class="user-area-text">{{ $user->name }}</div>
                        <div class="user-area-icon">
                            <img src="media/avatars/{{ $user->avatar }}" />
                        </div>
                    </a>
                    <a href="{{ route('logout') }}" class="user-logout">
                        <img src="images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>



    <section class="container main">

        <aside class="mt-10">
            <nav>
                <a href="{{ route('index') }}">
                    <div class="menu-item">
                        <div class="menu-item-icon">
                            <img src="images/home-run.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Home
                        </div>
                    </div>
                </a>
                <a href="/perfil">
                    <div class="menu-item">
                        <div class="menu-item-icon">
                            <img src="images/user.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Meu Perfil
                        </div>
                    </div>
                </a>
                <div class="menu-splitter"></div>
                <a href="/config">
                    <div class="menu-item active">
                        <div class="menu-item-icon">
                            <img src="images/settings.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Configurações
                        </div>
                    </div>
                </a>
                <a href="{{ route('logout') }}">
                    <div class="menu-item">
                        <div class="menu-item-icon">
                            <img src="images/power.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Sair
                        </div>
                    </div>
                </a>
            </nav>
        </aside>


        <section class="feed mt-10">

            <h1>Configurações</h1>

            @if (session('warning'))
            <div class="flash">
                {{ session('warning')}}
            </div>
            @endif

            <form class="config-form" method="POST" enctype="multipart/form-data" action="/config">

                @csrf

                <label>
                    Novo Avatar:<br />
                    <input type="file" name="avatar" /><br />
                    <img class="image-edit" src="media/avatars/{{ $user->avatar }}" />
                </label>

                <label>
                    Nova Capa:<br />
                    <input type="file" name="cover" /><br />
                    <img class="image-edit" src="media/covers/{{ $user->cover }}" />
                </label>

                <hr />

                <label>
                    Nome Completo:<br />
                    <input type="text" name="name" value="{{ $user->name }}" />
                </label>

                <label>
                    Data de nascimento:<br />
                    <input type="text" name="birthdate" value="{{ date('d/m/Y', strtotime($user->birthdate)) }}" />
                </label>

                <label>
                    E-mail:<br />
                    <input type="email" name="email" value="{{ $user->email }}" />
                </label>

                <label>
                    Cidade:<br />
                    <input type="text" name="city" value="{{ $user->city }}" />
                </label>

                <label>
                    Trabalho:<br />
                    <input type="text" name="work" value="{{ $user->work }}" />
                </label>

                <hr />

                <label>
                    Nova Senha:<br />
                    <input type="password" name="password" />
                </label>

                <button class="button">Salvar</button>

            </form>

        </section>

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
    <div class="modal">
        <div class="modal-inner">
            <a rel="modal:close">&times;</a>
            <div class="modal-content"></div>
        </div>
    </div>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/vanillaModal.js"></script>
</body>

</html>