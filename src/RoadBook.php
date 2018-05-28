<?php

namespace Oquiz;

class RoadBook {

  public $router;

  public function __construct() {

    // Création du routeur
    $this->router = new \AltoRouter();

    $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

    $this->router->setBasePath($basePath);

    $this->initRoads();

  }

  public function initRoads() {


    // On mappe toutes nos URL

    // Page d'accueil avec liste des quiz
    $this->router->map('GET', '/', ['MainController', 'home'], 'home');

    // Page d'un seul quiz
    $this->router->map('GET', '/quiz/[i:id]', ['QuizController', 'read'], 'quiz_read');

    // Création d'un nouvel utilisateur
    $this->router->map('GET|POST', '/signup', ['UserController', 'signup'], 'signup');

    // Formulaire de connexion
    $this->router->map('GET|POST', '/login', ['UserController', 'login'], 'login');

    // Déconnexion utilisateur
    $this->router->map('GET', '/logout', ['UserController', 'logout'], 'logout');

    // Page de profil - Liste des quizzes de l'utilisateur connecté
    $this->router->map('GET|POST', '/myQuizzes', ['UserController', 'myQuizzes'], 'myQuizzes');

    // Page de création d'un nouveau quiz
    $this->router->map('GET|POST', '/create', ['QuizController', 'create'], 'create');

    // TODO Traitement du résultat: Tache toujours en cours
    $this->router->map('GET|POST', '/results', ['QuizController', 'results'], 'quiz_results');

    // TODO Page de création d'une nouvelle question toujours en cours
    $this->router->map('GET|POST', '/add_question', ['QuestionController', 'add'], 'add_question');
  }

  public function run () {

      // Je récupère les données de Altorouter
      $match = $this->router->match();

      if (!$match) {

          echo 'WRONG WAY!!!!!';
      }
      else {


          $data = $match['target'];
          $controllerName = "\Oquiz\Controllers\\" . $match['target'][0];
          $methodName = $match['target'][1];
          $controller = new $controllerName( $this->router );
          $controller->$methodName( $match['params'] );
      }
  }

}
