<?php

namespace Oquiz\Controllers;

class QuestionController extends CoreController {

// TODO ATTENTION !!!!! NON TERMINE, NE FONCTIONNE PAS!!!!
// TODO Je n'arrive pas à passer l'id du quiz dans lequel je veux ajouter une question....

    public function add() {
        dump($_GET);
        $errors = [];

        if ($_GET['quizId']) {

        // J'ai récupéré l'id du quiz en GET, j'en fais une variable quizId qui sera envoyée à la méthode seIdQuiz
        $idQuiz = $_GET['quizId'];

        }

        if (!empty($_POST)) {

            $errors = \Oquiz\Models\QuestionModel::checkData( $_POST );

            $quizId = \Oquiz\Models\QuizModel::getId($idQuiz);

            if ( empty($errors) ) {
                $question = new \Oquiz\Models\QuestionModel();

                $question->setQuestion($_POST['question']);
                $question->setProp1($_POST['goodAnswer']);
                $question->setProp2($_POST['prop2']);
                $question->setProp3($_POST['prop3']);
                $question->setProp4($_POST['prop4']);
                $question->setAnecdote($_POST['anecdote']);
                $question->setIdLevel($_POST['idLevel']);
                $question->setIdQuiz($quizId);
                $question->setWiki($_POST['wiki']);

                $question->save();

                $this->redirect('front/list-form');
            }
        }
        else {
            // Aucune information dans "$_POST", du coup on affiche le template
            echo $this->templates->render('front/add_question', [
                'errors' => $errors,
                'fields' => $_POST
            ]);
        }
    }
}
