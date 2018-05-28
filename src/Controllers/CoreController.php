<?php

namespace Oquiz\Controllers;

class CoreController {

    protected $router;
    protected $templates;


    public function __construct($router) {

        // On enregistre le routeur dans le controlleur
        $this->router = $router;

        $this->currentUser = \Oquiz\Models\UserModel::getUser();

        // On instancie la librairie Plates pour gérer nos templates
        $this->templates = new \League\Plates\Engine( __DIR__ . '/../Views' );

        // On ajoute des données globales
        $this->templates->addData([
            'basePath' => $_SERVER['BASE_URI'],
            'router' => $router,
            'user' => $this->currentUser,
        ]);
    }

    public function redirect($routeName, $infos=[]) {
        header('Location: ' . $this->router->generate($routeName, $infos));
    }
}
