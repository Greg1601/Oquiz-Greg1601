<?php $this->layout( 'layout' ) ?>

<div class="container d-flex flex-column mb-5">

    <h2 ><?=$quiz->getTitle()?>
        <span class="badge badge-secondary"><?=$qNumber?> questions</span>
    </h2>

    <p><?=$quiz->getDescription()?></p>

    <?php
        $authorId = $quiz->getIdAuthor();
        $name = $quiz->getAuthorName($authorId);
    ?>


    <p>
        Par l'honorable <?= $name['first_name']?> <?=$name['last_name'] ?> ...
    </p>

</div>

<div class="container d-flex flex-wrap align-items-center">
    <?php foreach ($questions as $question): ?>

        <?php $levelId = $question->getIdLevel();?>
        <?php $difficulty = $question->getLevel($levelId);?>

        <div class="card" style="width: 33rem;">

            <div class="card-body">
                <h3> <?=$question->getQuestion()?> <span class="badge badge-secondary" style="float: right;"><?=$difficulty['name']?></span></h3>
            </div>

            <ol class="list-group list-group-flush">
                <?php
                    $props = $question->getShuffledProps($question)
                ?>
                <li class="list-group-item"><?= $props[0] ?></li>
                <li class="list-group-item"><?= $props[1] ?></li>
                <li class="list-group-item"><?= $props[2] ?></li>
                <li class="list-group-item"><?= $props[3] ?></li>
            </ol>

        </div>
    <?php endforeach; ?>
</div>
