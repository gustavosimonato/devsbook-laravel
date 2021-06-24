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
                    <a href="" class="user-area">
                        <div class="user-area-text">{{ $loggedUser->name }}</div>
                        <div class="user-area-icon">
                            <img src="media/avatars/{{ $loggedUser->avatar }}" />
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
                    <div class="menu-item active">
                        <div class="menu-item-icon">
                            <img src="images/home-run.png" width="16" height="16" />
                        </div>
                        <div class="menu-item-text">
                            Home
                        </div>
                    </div>
                </a>
                <a href="">
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
                    <div class="menu-item">
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

            <div class="row">
                <div class="column pr-5">

                    <div class="box feed-new">
                        <div class="box-body">
                            <div class="feed-new-editor m-10 row">
                                <div class="feed-new-avatar">
                                    <img src="media/avatars/{{ $loggedUser->avatar }}" />
                                </div>
                                <div class="feed-new-input-placeholder">O que você está pensando, {{ $loggedUser->name }}?</div>
                                <div class="feed-new-input" contenteditable="true"></div>
                                <div class="feed-new-photo">
                                    <img src="images/photo.png" />
                                    <input type="file" name="photo" class="feed-new-file" accept="image/png,image/jpg,image/jpeg" />
                                </div>
                                <div class="feed-new-send">
                                    <img src="images/send.png" />
                                </div>
                                <form class="feed-new-form" method="POST" action="post/new">
                                    @csrf
                                    <input type="hidden" name="body" />
                                </form>
                            </div>
                        </div>
                    </div>

                    @foreach($feed['posts'] as $feedItem)
                    <div class="box feed-item" data-id="{{ $feedItem->id }}">
                        <div class="box-body">
                            <div class="feed-item-head row mt-20 m-width-20">
                                <div class="feed-item-head-photo">
                                    <a href=""><img src="media/avatars/{{ $feedItem->user->avatar }}" /></a>
                                </div>
                                <div class="feed-item-head-info">
                                    <a href=""><span class="fidi-name">{{ $feedItem->user->name }}</span></a>
                                    <span class="fidi-action"><?php
                                    switch($feedItem->type) {
                                        case 'text':
                                            echo 'fez um post';
                                            break;
                                        case 'photo':
                                            echo 'postou uma foto';
                                            break;
                                    }
                                    ?></span>
                                    <br />
                                    <span class="fidi-date">{{ date('d/m/Y', strtotime($feedItem->created_at)) }}</span>
                                </div>
                                @if($feedItem->mine)
                                <div class="feed-item-head-btn">
                                    <img src="images/more.png" />
                                    <div class="feed-item-more-window">
                                        <a href="/post/{{ $feedItem->id }}/delete">Excluir Post</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="feed-item-body mt-10 m-width-20">
                                <?php
                                switch($feedItem->type) {
                                    case 'text':
                                        echo nl2br($feedItem->body);
                                    break;
                                    case 'photo':
                                        echo '<img src="media/uploads/'.$feedItem->body.'" />';
                                    break;
                                }
                                ?>
                            </div>
                            <div class="feed-item-buttons row mt-20 m-width-20">
                                <div class="like-btn {{ ($feedItem->liked > 0 ? 'on':'') }}">{{ $feedItem->likeCount }}</div>
                                <div class="msg-btn">{{ count($feedItem->comments) }}</div>
                            </div>
                            <div class="feed-item-comments">

                                <div class="feed-item-comments-area">
                                    @foreach($feedItem->comments as $item)
                                    <div class="fic-item row m-height-10 m-width-20">
                                        <div class="fic-item-photo">
                                            <a href=""><img src="media/avatars/{{ $item['user']['avatar'] }}" /></a>
                                        </div>
                                        <div class="fic-item-info">
                                            <a href="">{{ $item['user']['name'] }}</a>
                                            {{ $item['body'] }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="fic-answer row m-height-10 m-width-20">
                                    <div class="fic-item-photo">
                                        <a href=""><img src="media/avatars/{{ $loggedUser->avatar }}" /></a>
                                    </div>
                                    <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="column side pl-5">
                    <div class="box banners">
                        <div class="box-header">
                            <div class="box-header-text">Patrocinios</div>
                            <div class="box-header-buttons">

                            </div>
                        </div>
                        <div class="box-body">
                            <a href=""><img src="https://alunos.b7web.com.br/media/courses/php.jpg" /></a>
                            <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel.jpg" /></a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body m-10">
                            Criado com ❤️ Gustavo Simonato
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <div class="modal">
        <div class="modal-inner">
            <a rel="modal:close">&times;</a>
            <div class="modal-content"></div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/vanillaModal.js"></script>
<script type="text/javascript">
    var token = '{{ csrf_token() }}';

    let feedInput = document.querySelector('.feed-new-input');
        let feedSubmit = document.querySelector('.feed-new-send');
        let feedForm = document.querySelector('.feed-new-form');
        let feedPhoto = document.querySelector('.feed-new-photo');
        let feedFile = document.querySelector('.feed-new-file');
        
        feedPhoto.addEventListener('click', function(){
            feedFile.click();
        });
        feedFile.addEventListener('change', async function(){
            let photo = feedFile.files[0];
        
            let formData = new FormData();
            formData.append('photo', photo);
            formData.append('_token', token);
        
            let req = await fetch('/ajax/upload', {
                method: 'POST',
                body: formData
            });
            let json = await req.json();
        
            location.reload(true)
        });
        
        feedSubmit.addEventListener('click', function(obj){
            let value = feedInput.innerText.trim();
            
            if(value != '') {
                feedForm.querySelector('input[name=body]').value = value;
                feedForm.submit();
            }
        });

        
if (document.querySelector('.fic-item-field')) {
    document.querySelectorAll('.fic-item-field').forEach(item => {
        item.addEventListener('keyup', async (e) => {
            if (e.keyCode == 13) {
                let id = item.closest('.feed-item').getAttribute('data-id');
                let txt = item.value;
                item.value = '';

                let data = new FormData();
                data.append('id', id);
                data.append('txt', txt);
                data.append('_token', token);

                let req = await fetch('/ajax/comment', {
                    method: 'POST',
                    body: data
                });
                let json = await req.json();

                window.location.reload();

            }
        });
    });
}
</script>