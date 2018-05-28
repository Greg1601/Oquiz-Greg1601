<?php $this->layout('layout') ?>

<div class="container">
    <div class="row mb-5">
        <div class="col-12 col-md-8 m-auto area">

            <h2 class="text-center">Inscription</h2>

            <?php foreach($errors as $error):?>
                <div class="alert alert-danger"><?=$error?></div>
            <?php endforeach; ?>

            <form  action="<?=$router->generate('signup')?>" method="post">

                <div class="form-group">
                    <label>email</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        value="<?=($fields['email'] ?? '')?>"
                        placeholder="exemple: machin@truc.com"
                        required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        value=""
                        placeholder="Entrez votre mot de passe"
                        required>
                </div>

                <div class="form-group">
                    <label>Confirmez le mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password_confirm"
                        value=""
                        placeholder="Entrez votre mot de passe"
                        required>
                </div>

                <div class="form-group">
                    <label>Prénom</label>
                    <input
                        type="text"
                        class="form-control"
                        name="first_name"
                        value="<?=($fields['first_name'] ?? '')?>"
                        placeholder="Votre prénom ici."
                        required>
                </div>

                <div class="form-group">
                    <label>Nom</label>
                        <input
                            type="text"
                            class="form-control"
                            name="last_name"
                            value="<?=($fields['last_name'] ?? '')?>"
                            placeholder="Votre nom ici!!"
                            required>
                </div>

                <div class="text-center">
                <button class="btn btn-primary">Créer le compte</button>
                </div>

            </div>
    </div>
</div>

</form>
