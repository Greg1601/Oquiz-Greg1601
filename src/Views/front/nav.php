<nav>
    <div class="menu">

        <?php if($user): ?>
            <div class="p-3 menu-hover">
                Bonjour Mr <?=$user['lastname']?>
            </div>

        <?php else: ?>
            <div class="login p-3 menu-hover">
                <i class="fas fa-sign-in-alt"></i>
                <a href="<?= $router->generate('login')?>">
                Connexion
                </a>
            </div>

        <?php endif; ?>

        <div class="title display-4">
            <a href="<?= $router->generate('home')?>">
            O'Quiz
            </a>
        </div>

        <?php if($user): ?>
            <!-- je suis connecté -->
            <div class="p-3 menu-hover">
                <a href="<?=$router->generate('logout')?>">
                    Déconnexion
                </a>
            </div>

        <?php else: ?>
            <!-- je suis déconnecté -->
        <div class="inscription p-3 menu-hover">
            <a href="<?=$router->generate('signup')?>">
                <i class="fas fa-edit"></i>
                Inscription
            </a>

        </div>
    <?php endif; ?>

    </div>
    <div class="menu">
        <div class="menu-hover">
            <a href="<?= $router->generate('home')?>">accueil</a>
        </div>
        <div class="menu-hover">
            <a href="<?= $router->generate('myQuizzes')?>">Mon profil</a>
        </div>
    </div>
</nav>
