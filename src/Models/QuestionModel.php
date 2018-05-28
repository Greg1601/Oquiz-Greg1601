<?php

namespace Oquiz\Models;

class QuestionModel extends CoreModel {

    protected static $tableName = 'questions';

	protected $id;
	protected $id_quiz;
	protected $question;
	protected $prop1;
	protected $prop2;
	protected $prop3;
	protected $prop4;
	protected $id_level;
	protected $anecdote;
	protected $wiki;

    public static function checkData($data) {

        // Va contenir le liste des erreurs
        $errors=[];

        // Liste de champs obligatoires
        $mandatoryFields=[
            'question' => "Veuillez saisir une question",
            'goodAnswer' => "Veuillez saisir la bonne réponse",
            'prop2' => "Veuillez saisir une mauvaise réponse",
            'prop3' => "Veuillez saisir une mauvaise réponse",
            'prop4' => "Veuillez saisir une mauvaise réponse",
            'anecdote' => "Veuillez saisir une anecdote",
            'idLevel' => "Veuillez sélectionner le niveau de la question",
            'wiki' => "Veuillez saisir une adresse de wiki"
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

    // retourner la liste des questions en fonction de l'id d'un quiz
    public static function findQuestions($quizId) {
        // On construit la requête SQL
        $sql = 'SELECT * FROM ' .static::$tableName. ' WHERE id_quiz = :id_quiz';

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On execute la requête SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_quiz', $quizId, \PDO::PARAM_INT);

        $stmt->execute();

        // On retourne les résultats
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function getLevel($levelId){

        $sql = 'SELECT name FROM levels INNER JOIN questions WHERE levels.id = :id_level';

        $conn = \Oquiz\Database::getDb();

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_level', $levelId, \PDO::PARAM_INT);
        $stmt->execute();

        $questionLevel = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $questionLevel;
    }

    public static function getShuffledProps($question) {

        $props = array($question->getProp1(), $question->getProp2(), $question->getProp3(), $question->getProp4());
        shuffle($props);
        return $props;
    }

    public function save() {

        // On crée la requête SQL
        $sql = "
            REPLACE INTO questions (
                id;
            	id_quiz;
            	question;
            	prop1;
            	prop2;
            	prop3;
            	prop4;
            	id_level;
            	anecdote;
            	wiki
            )
            VALUES (
                :id;
            	:id_quiz;
            	:question;
            	:prop1;
            	:prop2;
            	:prop3;
            	:prop4;
            	:id_level;
            	:anecdote;
            	:wiki
            )";

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On exécute la requête
        $stmt = $conn->prepare( $sql );
        $stmt->bindValue( ':id', $this->id );
        $stmt->bindValue( ':id_quiz', $this->id_quiz);
        $stmt->bindValue( ':question', $this->question );
        $stmt->bindValue( ':prop1', $this->prop1);
        $stmt->bindValue( ':prop2', $this->prop2);
        $stmt->bindValue( ':prop3', $this->prop3);
        $stmt->bindValue( ':prop4', $this->prop4);
        $stmt->bindValue( ':id_level', $this->id_level);
        $stmt->bindValue( ':anecdote', $this->anecdote);
        $stmt->bindValue( ':wiki', $this->wiki);
        $stmt->execute();

        // On récupère l'ID qui vient d'être généré par MySQL
        $this->id = $conn->lastInsertId();

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
     * Get the value of Id Quiz
     *
     * @return mixed
     */
    public function getIdQuiz()
    {
        return $this->id_quiz;
    }

    /**
     * Set the value of Id Quiz
     *
     * @param mixed id_quiz
     *
     * @return self
     */
    public function setIdQuiz($id_quiz)
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param mixed question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop1
     *
     * @return self
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop2
     *
     * @return self
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop3
     *
     * @return self
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp4()
    {
        return $this->prop4;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop4
     *
     * @return self
     */
    public function setProp4($prop4)
    {
        $this->prop4 = $prop4;

        return $this;
    }

    /**
     * Get the value of Id Level
     *
     * @return mixed
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }

    /**
     * Set the value of Id Level
     *
     * @param mixed id_level
     *
     * @return self
     */
    public function setIdLevel($id_level)
    {
        $this->id_level = $id_level;

        return $this;
    }

    /**
     * Get the value of Anecdote
     *
     * @return mixed
     */
    public function getAnecdote()
    {
        return $this->anecdote;
    }

    /**
     * Set the value of Anecdote
     *
     * @param mixed anecdote
     *
     * @return self
     */
    public function setAnecdote($anecdote)
    {
        $this->anecdote = $anecdote;

        return $this;
    }

    /**
     * Get the value of Wiki
     *
     * @return mixed
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of Wiki
     *
     * @param mixed wiki
     *
     * @return self
     */
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

}
