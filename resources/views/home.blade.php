<?php 

echo "passou aqui";

exit; 
?>

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
                <a href=""><img src="images/devsbook_logo.png" /></a>
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
                        <div class="user-area-text"><?=$loggedUser->name;?></div>
                        <div class="user-area-icon">
                            <img src="media/avatars/<?=$loggedUser->avatar;?>" />
                        </div>
                    </a>
                    <a href="/sair" class="user-logout">
                        <img src="images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>






    <?=$render('header', ['loggedUser'=>$loggedUser]);?>

    <section class="container main">
        <?=$render('sidebar', ['activeMenu'=>'home']);?>

        <section class="feed mt-10">

            <div class="row">
                <div class="column pr-5">

                    <?=$render('feed-editor', ['user'=>$loggedUser]);?>

                    <?php foreach($feed['posts'] as $feedItem): ?>
                    <?=$render('feed-item', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]);?>
                    <?php endforeach; ?>

                    <div class="feed-pagination">
                        <?php for($q=0;$q<$feed['pageCount'];$q++): ?>
                        <a class="<?=($q==$feed['currentPage']?'active':'')?>" href="<?=$base;?>/?page=<?=$q;?>"><?=$q+1;?></a>
                        <?php endfor; ?>
                    </div>

                </div>
                <div class="column side pl-5">
                    <?=$render('right-side');?>
                </div>
            </div>

        </section>
    </section>
    <?=$render('footer');?>