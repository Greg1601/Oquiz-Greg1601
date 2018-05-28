<?php $this->layout( 'layout' ) ?>

<!-- Partie intermédiaire -->
<div class="container">

    <h1>Bienvenue sur O'Quiz !!!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>

<?php if($user):?>
    <div class="container">
        <a href="<?=$router->generate('create')?>">
            <button class="btn btn-primary" style="width: 25vw;">Créer un Quiz</button>
        </a>
    </div>
<?php endif; ?>

<!-- Liste des quizzes -->
<div class="container d-flex flex-wrap align-items-center">

    <?php foreach ($quizzes as $quiz): ?>
        <?php $authorId = $quiz->getIdAuthor();?>
        <?php
        $name = $quiz->getAuthorName($authorId);?>

        <div class="card" style="width: 33rem;">
            <div class="card-body">
                <a href="<?=$router->generate('quiz_read', [ 'id' => $quiz->getId() ])?>">
                        <h2><?=$quiz->getTitle()?></h2>
                </a>

                <p>
                    <?=$quiz->getDescription()?>
                </p>

                <p>
                    Par <?= $name['first_name']?> <?=$name['last_name'] ?> ...
                </p>

            </div>
        </div>
    <?php endforeach; ?>

</div>
