<?php

namespace Oquiz\Controllers;

class UserController extends CoreController {

    // Connexion
    public function login() {

        $errors = [];
        // On regarde si on a validé le formulaire
        if ( !empty($_POST) ) {
            // On a bien des données, on essaie
            // d'identifier l'utilisateur
            // On récupère l'utilisateur qui possède
            // l'adresse mail envoyée dans le formulaire
            $email = $_POST['email'];
            $user = \Oquiz\Models\UserModel::findByEmail( $email );
            if ( $user === false ) {
                // Aucun membre ne possède cette adresse mail
                $errors[] = "Utilisateur ou mot de passe inconnu";
            }
            else {
                // L'adresse mail existe bien, on doit
                // dorénavant tester le mot de passe
                $hash = $user->getPassword();
                $isValid = password_verify( $_POST['password'], $hash );
                if ( $isValid === false ) {
                    // Ce n'est pas le bon mot de passe
                    $errors[] = "Utilisateur ou mot de passe inconnu";
                }
                else {
                    // C'est le bon mot de passe
                    // On identifie la personne
                    \Oquiz\Models\UserModel::login( $user );
                    // On redirige l'utilisateur
                    $this->redirect( 'home' );
                }
            }
        }

        // Si on a pas de données en $POST, on affiche le template
        echo $this->templates->render( 'front/login', [
            'errors' => $errors,
            'fields' => $_POST
        ]);
    }

    public function logout() {
        // On vide la session
        unset( $_SESSION['user'] );
        $_SESSION = [];
        // On détruit la session !
        session_destroy();
        // On redirige l'utilisateur
        $this->redirect( 'home' );
    }

    // Affiche la page de profil de l'utilisateur avec ses quizzes
    public function myQuizzes() {

        // On vérifie qu'on est bien connecté
        $user = \Oquiz\Models\UserModel::getUser();
        $userId = $user['id'];

        if ( !$user ) {
            // On est pas connecté, on redirige
            $this->redirect( 'home' );
        }

        // On récupère les informations de la BDD pour l'utilisateur via son ID
        $quiz = \Oquiz\Models\QuizModel::findByAuthorId( $userId  );

        // On affiche le template de la page
        echo $this->templates->render( 'main/home', ['quizzes' => $quiz] );
    }

    // Création de nouvel utilisateur
    public function signup() {
        $errors = [];
        // On regarde si on reçoit des informations
        if (!empty($_POST)) {
            // On a validé le formulaire, le visiteur
            // souhaite créer un compte
            // On vérifie les données du formulaire
            $errors = \Oquiz\Models\UserModel::checkData( $_POST );

            // On regarde si il y a des erreurs
            if ( empty($errors) ) {
                // Pas d'erreur, on peut continuer
                // la création de compte
                $user = \Oquiz\Models\UserModel::signup( $_POST );

                // On redirige l'utilisateur sur
                // le formulaire de connexion

                $this->redirect( 'login' );
            }
        }
        // On affiche le formulaire
        echo $this->templates->render( 'front/signup', [
            'errors' => $errors,
            'fields' => $_POST
        ]);
    }

}
