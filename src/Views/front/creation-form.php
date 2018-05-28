<?php $this->layout('layout') ?>

<div class="container">
    <div class="row mb-5">
        <div class="col-12 col-md-8 m-auto area a">

            <h2 class="text-center">Créer nouveau quiz</h2>

            <?php foreach($errors as $error):?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endforeach; ?>

            <form  action="<?=$router->generate('create')?>" method="post">

                <div class="form-group">
                    <label>Titre</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="<?=($fields['title'] ?? '')?>"
                            placeholder="Titre du nouveau Quiz"
                            required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                        <textarea class="form-control" name="description" value="<?=($fields['description'] ?? '')?>" placeholder="Décrivez le nouveau quiz">
                        </textarea>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary">Créer le quiz</button>
                </div>

            </form>
        </div>
    </div>
</div>
