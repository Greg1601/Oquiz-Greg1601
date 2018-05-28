<?php

namespace Oquiz\Controllers;

class QuizController extends CoreController {

    public function create() {

        $errors = [];

        if (!empty($_POST)) {

            $errors = \Oquiz\Models\QuizModel::checkData( $_POST );

            $user = \Oquiz\Models\UserModel::getUser();

            if ( empty($errors) ) {
                $quiz = new \Oquiz\Models\QuizModel();


                $quiz->setTitle($_POST['title']);
                $quiz->setDescription($_POST['description']);
                $quiz->setIdAuthor($user['id']);

                // Création d'une variable $quizId
                $quizId = $quiz->save();

                // Redirection
                $this->redirect('home');
            }
        }
        else {
            // Aucune information dans "$_POST", du coup on affiche le template
            echo $this->templates->render('front/creation-form', [
                'errors' => $errors,
                'fields' => $_POST
            ]);
        }
    }

    public function list() {

        // On récupère la liste des quizzes dans de la BDD
        $list = \Oquiz\Models\QuizModel::findAll();

        // On affiche le template en lui passant les données récupérées
        echo $this->templates->render('main/home', [ 'quizzes' => $list]);
    }

	public function read($params) {

        // Je récupère l'id de l'URL
        $quizId = $params['id'];

        // Je récupère les données de l'utilisateur connecté (si aucun, renverra null)
        $user = \Oquiz\Models\UserModel::getUser();

        // On récupère les données d'un quiz à partir de son ID dans la BDD
        $quiz = \Oquiz\Models\QuizModel::find($quizId);

        // On récupère les questions de chaque quiz dans la BDD en fonction de l'ID des quiz
        $questions = \Oquiz\Models\QuestionModel::findQuestions($quizId);

        // Je crée une variable contenant le nombre de questions pour préparer l'affichage du score
        $qNumber = 0;
        // Je l'incrémente de 1 pour chaque question du quiz
        foreach ($questions as $question) {
            ++$qNumber;
        }

        // dump($questions);exit;
        if (!$user) {
            // Si pas d'utilisateur identifié,on affiche le template en lui passant les données récupérées dans la BDD, sans possibilité de selectionner une réponse.
            echo $this->templates->render('front/quiz', ['quiz' => $quiz, 'questions' => $questions, 'qNumber' => $qNumber]);
        }
        else {
            // Sinon, on affiche le template list-form avec les mêmes données mais sous forme de formulaire
            echo $this->templates->render('front/list-form', ['quiz' => $quiz, 'questions' => $questions, 'qNumber' => $qNumber]);
        }
    }

    // TODO ATTENTION!!!!!!! NON FONCTIONNEL .....
    // TODO Beaucoup de tests mais impossible d'avoir une gestion du score efficace. Je n'ai pas eu le temps de faire la modifications des classes selon que la réponse soit juste ou pas.

    public function results() {
        dump($_POST);
        $responses = [];
        $responses = $_POST;

        foreach ($responses as $response) {
            // dump($response);

            // Je sépare l'ID de la question de la valeur de la réponse
            $values = explode("/", $response);
            // dump($values);

            // je stocke les données dans une variable $questionId pour l'id de la question et $answer pour la valeur de la réponse
            $questionId = $values[0];
            $testAnswer = $values[1];
            // dump($questionId);
            // dump($answer);

            // je vais comparer les valeurs aux valeurs stockées en BDD
            // Je récupère la question par son ID
            $question = \Oquiz\Models\QuestionModel::find($questionId);
            $quizId = $question->getIdQuiz();
            // On récupère les données d'un quiz à partir de son ID dans la BDD
            $quiz = \Oquiz\Models\QuizModel::find($quizId);

            $questions = \Oquiz\Models\QuestionModel::findQuestions($quizId);

            // Je récupère la bonne réponse (toujours prop1 dans la BDD)
            $goodAnswer = $question->getProp1();
            // dump($goodAnswer);

            // Je crée des variables pour l'affichage du score, une pour le nombre de réponses justes, l'autre pour le nombre de questions traitées
            $qNumber = 0;
            $score = 0;

            // Je l'incrémente de 1 pour chaque question du quiz
            foreach ($questions as $question) {
                ++$qNumber;
            }
            // Je compare la réponse passée en formulaire à la bonne réponse

            // Je compare les valeurs de chaque $answer à la $goodAnswer correspondant à la question.
            // dump($testAnswer);dump($goodAnswer);

        }

        foreach ($responses as $response) {

          if ($testAnswer === $goodAnswer) {
            // dump($testAnswer);dump($goodAnswer);
            // Si la bonne réponse est donnée j'incrémente les variables de score et du nombre de questions
            $score = ++$score;
            dump($score);
          }
          elseif ($testAnswer != $goodAnswer) {
            // dump($testAnswer);dump($goodAnswer);
            // Si la bonne réponse est donnée j'incrémente les variables de score et du nombre de questions
            $score = --$score;
            dump($score);
          }
          elseif (!$testAnswer) {
            $score = $score;
          }
        }



        // Je veux réafficher le formulaire en envoyant le score calculé.
        echo $this->templates->render('front/results', ['quiz' => $quiz, 'response'=> $response, 'questions' => $questions, 'score' => $score, 'qNumber' => $qNumber]);

        $responses = [];
        $score = 0;
    }
}
