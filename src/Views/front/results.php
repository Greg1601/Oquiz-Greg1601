<?php $this->layout( 'layout' ) ?>

<!-- TODO ATTTENTION : PAGE EN COURS DE TRAVAUX TODO -->

<div class="container d-flex flex-column mb-5">
    <h2 ><?=$quiz->getTitle()?> <span class="badge badge-secondary"><?=$qNumber?> questions</span></h2>
    <p><?=$quiz->getDescription()?></p>

    <?php $authorId = $quiz->getIdAuthor();?>
    <?php $name = $quiz->getAuthorName($authorId);?>

    <p>
        Par <?= $name['first_name']?> <?=$name['last_name'] ?> ...
    </p>
</div>

<div class="container d-flex flex-column mb-5">
<h3><span class="badge badge-secondary">Votre score: <?=($score ?? '0')?> / <?=$qNumber?></span></h3>
</div>

<form class="container d-flex flex-wrap align-items-center" action="<?=$router->generate('quiz_results')?>" method="post">
    <?php foreach ($questions as $question): ?>
        <div class="card card-body" style="width: 33rem;">


                <?php $levelId = $question->getIdLevel();?>
                <?php $difficulty = $question->getLevel($levelId);?>


                <h3> <?=$question->getQuestion()?> <span class="badge badge-secondary" style="float: right;"><?=$difficulty['name']?></span></h3>

            <div class="container d-flex flex-column mb-5">
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop1" value="<?= $question->getId() ?>/<?= $props[0] ?>" name="Question<?= $question->getId() ?>">
                        <?= $props[0] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop2" value="<?= $question->getId() ?>/<?= $props[1] ?>" name="Question<?= $question->getId() ?>">
                        <?= $props[1] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop3" value="<?= $question->getId() ?>/<?= $props[2] ?>" name="Question<?= $question->getId() ?>">
                        <?= $props[2] ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <input type="radio" id="prop4" value="<?= $question->getId() ?>/<?= $props[3] ?>" name="Question<?= $question->getId() ?>">
                        <?= $props[3] ?>
                    </label>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <button class="btn btn-primary" style="width: 100vw;">Valider Quiz</button>

</form>
