<?php

namespace Oquiz\Models;

class UserModel extends CoreModel {

    protected static $tableName = 'users';

    protected $id;
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $password;

    // Vérifier les données dformulaire et lister les erreurs détectées
    public static function checkData($data) {

        // Va contenir le liste des erreurs
        $errors=[];

        // Liste de champs obligatoires
        $mandatoryFields=[
            'email' => "Veuillez saisir une adresse mail",
            'password' => "Veuillez renseigner un mot de passe",
            'password_confirm' => "Veuillez confirmer le mot de passe" ,
            'first_name' => "Veuillez saisir un prénom",
            'last_name' => "Veuillez saisir un nom",
        ];

        foreach ($mandatoryFields as $fieldName => $msg) {

            // on vérifie les champs obligatoires
            if (empty($data[$fieldName])) {

                //erreur, le champ est vide!
                $errors[]=$msg;
            }

            // On vérifie la fouble saisie de mot de passe
            if ($data['password'] !== $data['password_confirm']) {
                $errors[] = "confirmation du mot de passe incorrecte";
            }

            // on vérifie le format de l'Email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $errors[] = "Votre adresse mail n'est pas au bon format";
            }

            return $errors;
        }

    }

    // Retoune l'utilisateur associé à une adresse mail
    public static function findByEmail($email) {

        // On construit la requête SQL
        $sql = 'SELECT * FROM users WHERE email LIKE :email';

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On éxécute la requête
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        // On récupère le résultat
        return $stmt->fetchObject(self::class);
    }

    // Inscrit les infos de l'utilisateur en session
    public static function login($user) {

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
        ];
    }

    // Retourne les infos de l'utilisateur connecté
    public static function getUser() {
        if (!empty($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    // Crée un nouveau membre ou le met à jour si il existe déjà
    public function save() {

        // On crée la requête SQL
        $sql = "
            REPLACE INTO users (
                id,
                email,
                password,
                first_name,
                last_name
            )
            VALUES (
                :id,
                :email,
                :password,
                :first_name,
                :last_name
            )";

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':id', $this->id );
        $stmt->bindValue( ':email', $this->email );
        $stmt->bindValue( ':password', $this->password );
        $stmt->bindValue( ':first_name', $this->first_name );
        $stmt->bindValue( ':last_name', $this->last_name );
        $stmt->execute();

        // On récupère l'ID qui vient d'être généré par MySQL
        $this->id = $conn->lastInsertId();
    }

    public function signup($data) {

        // On crée un objet
        $user = new self();

        // On renseigne les informations en fonction des données récupérées dans le formulaire
        $user->setEmail( $data['email'] );
        $user->setPassword( $data['password'] );
        $user->setFirstname( $data['first_name'] );
        $user->setLastname( $data['last_name'] );

        // On enregistre le nouvel utilisateur grace à une méthode
        $user->save();

        return $user;
    }

    /**
     * Get the value of Table Name
     *
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set the value of Table Name
     *
     * @param mixed tableName
     *
     * @return self
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of First Name
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of First Name
     *
     * @param mixed first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of Last Name
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of Last Name
     *
     * @param mixed last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

}
