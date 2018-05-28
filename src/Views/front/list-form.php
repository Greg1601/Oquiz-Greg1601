<?php $this->layout( 'layout' ) ?>

<div class="container d-flex flex-column mb-5">
    <h2 ><?=$quiz->getTitle()?> <span class="badge badge-secondary"><?=$qNumber?> questions</span></h2>
    <p><?=$quiz->getDescription()?></p>

    <?php $authorId = $quiz->getIdAuthor();?>
    <?php $name = $quiz->getAuthorName($authorId);?>
    <?php $quizId = $quiz->getId()?>

    <p>
        Par l'honorable <?= $name['first_name']?> <?=$name['last_name'] ?> ...
    </p>
</div>



<div class="container d-flex flex-column mb-5">
    <?php if($user['id'] === $authorId): ?>
        <div class="p-3">
            <form class="mt-3" action="<?=$router->generate('add_question', [ 'id' => $quizId ])?>" >

            <input type="text" name="quizId" value="<?= $quizId ?>" style="display: none;">

            <button class="btn btn-primary" >Ajouter une question</button>

            </form>
        </div>
    <?php endif; ?>
<h3><span class="badge badge-secondary">Votre score: <?=($score ?? '0')?> / <?=$qNumber?></span></h3>
</div>

<form class="container d-flex flex-wrap align-items-center" action="<?=$router->generate('quiz_results')?>" method="post">
    <?php foreach ($questions as $question): ?>
        <div class="card card-body" style="width: 33rem;">


            <?php
                // Pour chaque question, je récupère les infos dont j'ai besoin.
                $levelId = $question->getIdLevel();
                $difficulty = $question->getLevel($levelId);
                $props = $question->getShuffledProps($question);
            ?>

            <h3> <?=$question->getQuestion()?> <span class="badge badge-secondary" style="float: right;"><?=$difficulty['name']?></span></h3>

            <div class="container d-flex flex-column mb-5">
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop1" value="<?= $question->getId() ?>/<?= $props[0] ?? ''?>" name="Question<?= $question->getId() ?>">
                        <?= $props[0] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop2" value="<?= $question->getId() ?>/<?= $props[1] ?? ''?>" name="Question<?= $question->getId() ?>">
                        <?= $props[1] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop3" value="<?= $question->getId() ?>/<?= $props[2] ?? ''?>" name="Question<?= $question->getId() ?>">
                        <?= $props[2] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop4" value="<?= $question->getId() ?>/<?= $props[3] ?? ''?>" name="Question<?= $question->getId() ?>">
                        <?= $props[3] ?>
                    </label>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <button class="btn btn-primary" style="width: 100vw;">Valider Quiz</button>

</form>
