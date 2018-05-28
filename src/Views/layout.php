<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=($title??'O\'Quiz')?></title>
    <link rel="stylesheet" href="<?=$basePath?>/public/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/brands.css">
    <link rel="stylesheet" href="<?=$basePath?>/public/css/style.css">
    <?=$this->section('head')?>
  </head>
  <body data-path="<?=$basePath?>">

    <header>
        <?=$this->insert( 'front/nav' )?>
    </header>
    <main>
        <?=$this->section('content')?>
    </main>
    <footer>
        Copyright &copy; Greg <?=date('Y')?>
    </footer>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBq19vPBwrFFehfQKDVpwO2mtmvdtQVoeY"></script>
    <script src="<?=$basePath?>/node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="<?=$basePath?>/public/js/app.js" charset="utf-8"></script>
  </body>
</html>
