<?php $this->layout('layout') ?>


<div class="col-12 col-md-8 m-auto area">
    <form class="mt-3" action="<?=$router->generate('add_question')?>" method="post">
        <div class="card" style="width: inherit;">
            <div class="card-body">
                <div class="form-group">
                    <label>Nouvelle question</label>
                        <textarea class="form-control" name="question" value="" placeholder="Entrez la nouvelle question">
                        </textarea>
                </div>

                <div class="form-group">
                    <label>Bonne réponse</label>
                        <input
                            type="text"
                            class="form-control"
                            name="goodAnswer"
                            value=""
                            placeholder="Entrez la bonne réponse"
                            required>
                </div>

                <div class="form-group">
                    <label>Mauvaise réponse 1</label>
                        <input
                            type="text"
                            class="form-control"
                            name="prop2"
                            value=""
                            placeholder="Entrez une fausse proposition"
                            required>
                </div>

                <div class="form-group">
                    <label>Mauvaise réponse 2</label>
                        <input
                            type="text"
                            class="form-control"
                            name="prop3"
                            value=""
                            placeholder="Entrez une fausse proposition"
                            required>
                </div>

                <div class="form-group">
                    <label>Mauvaise réponse 3</label>
                        <input
                            type="text"
                            class="form-control"
                            name="prop4"
                            value=""
                            placeholder="Entrez une fausse proposition"
                            required>
                </div>

                <div class="form-group">
                    <label>Anecdote</label>
                        <textarea class="form-control" name="anecdote" value="" placeholder="Entrez la petite anecdote">
                        </textarea>
                </div>

                <div class="form-group">
                    <label>Niveau de la question</label>
                    <select class="form-control" name="idLevel">
                    <option value="1">Débutant</option>
                    <option value="2">Confirmé</option>
                    <option value="3">Expert</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Adresse Wiki</label>
                        <input
                            type="text"
                            class="form-control"
                            name="wiki"
                            value=""
                            placeholder="Entrez l'adresse wiki"
                            required>
                </div>
            </div>

        </div>
        <div class="text-center">
            <button class="btn btn-primary">Ajouter la question</button>
        </div>
    </form>
</div>
