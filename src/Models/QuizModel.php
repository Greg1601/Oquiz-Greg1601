<?php

namespace Oquiz\Models;

class QuizModel extends CoreModel {

    protected static $tableName = 'quizzes';

    protected $id;
    protected $title;
    protected $description;
    protected $id_author;

    public static function checkData($data) {

        // Va contenir le liste des erreurs
        $errors=[];

        // Liste de champs obligatoires
        $mandatoryFields=[
            'title' => "Veuillez saisir un titre pour le nouveau quiz",
            'description' => "Veuillez décrire le nouveau quiz",
        ];

        foreach ($mandatoryFields as $fieldName => $msg) {

            // on vérifie les champs obligatoires
            if (empty($data[$fieldName])) {

                //erreur, le champ est vide!
                $errors[]=$msg;
            }

            return $errors;
        }

    }


    public function save() {

        // On crée la requête SQL
        $sql = "
            REPLACE INTO quizzes (
                id,
                title,
                description,
                id_author
            )
            VALUES (
                :id,
                :title,
                :description,
                :id_author
            )";

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':id', $this->id );
        $stmt->bindValue( ':title', $this->title);
        $stmt->bindValue( ':description', $this->description );
        $stmt->bindValue( ':id_author', $this->id_author);
        $stmt->execute();

        // On récupère l'ID qui vient d'être généré par MySQL
        $this->id = $conn->lastInsertId();
        return $this->id;

    }

    // On va chercher les quizzes d'un auteur par son ID
    public static function findByAuthorId($userId) {

        // On construit la requête SQL
        $sql = 'SELECT * FROM ' .static::$tableName. ' WHERE id_author = :id_author';

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On execute la requête SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_author', $userId, \PDO::PARAM_STR);
        $stmt->execute();

        // On retourne les résultats
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function getAuthorName($authorId){

        $sql = 'SELECT first_name, last_name FROM users INNER JOIN quizzes WHERE users.id = :id_author';

        $conn = \Oquiz\Database::getDb();

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_author', $authorId, \PDO::PARAM_INT);
        $stmt->execute();

        $authorName = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $authorName;
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
     * Get the value of Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Id Author
     *
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * Set the value of Id Author
     *
     * @param mixed id_author
     *
     * @return self
     */
    public function setIdAuthor($id_author)
    {
        $this->id_author = $id_author;

        return $this;
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


}
