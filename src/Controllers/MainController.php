<?php

namespace Oquiz\Controllers;

class MainController extends CoreController {

    public function home() {

        // On récupère la liste des quizzes
        $list = \Oquiz\Models\QuizModel::findAll();

        // afficher la page d'acceuil avec la liste des Quizzes
        echo $this->templates->render('main/home', [ 'quizzes' => $list]);
    }
}
