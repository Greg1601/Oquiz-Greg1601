<?php

namespace Oquiz;

class Database {

    public static $pdo;

    // retourne les informations de connexion
    public static function getConfig() {

        // On lit le fichier de configuration qui est format .ini
        return parse_ini_file(__DIR__.'/config.ini');

    }
    // Permet de récupérer la connexion à la BDD
    public static function getDb() {

        // On regarde si on a déjà créé une connexion
        if (empty(self::$pdo)) {

            try {

                // On récupère les informations de connexion
                $config = self::getConfig();
                // dump($config);exit;
                // On a pas encore créé de connexion
                // On crée la connexion à la BDD
                self::$pdo = new \PDO(
                    'mysql:host='.$config['DBHOST'].';dbname='.$config['DBNAME'].';charset=utf8', //chaine de connexion
                    $config['DBUSER'], //nom de l'utilisateur
                    $config['DBPASSWORD'] //mot de passe de l'utilisateur
                );
            }

            catch(\Exception $error) {

                // Si il y a une erreur de connexion, on affiche un msg d'erreur
                echo "erreur de connexion à la BDD";
            }
        }

        // On retourne la connexion
        return self::$pdo;
    }


}
