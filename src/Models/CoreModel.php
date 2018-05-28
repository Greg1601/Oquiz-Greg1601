<?php

namespace Oquiz\Models;

class CoreModel {

    // Retourner une liste complète d'éléments de la BDD
    public static function findAll() {

    	// On construit la requête SQL
    	$sql = 'SELECT * FROM '.static::$tableName;

    	// On récupère la connexion à la BDD
    	$conn = \Oquiz\Database::getDb();

    	// On execute la requête SQL
    	$stmt = $conn->query( $sql );

    	// On retourne les résultats
    	return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
	}

    // retourner un seul élément de liste en fonction de son ID
    public static function find($id) {
        // On construit la requête SQL
        $sql = 'SELECT * FROM ' .static::$tableName. ' WHERE id=:id';

        // On récupère la connexion à la BDD
        $conn = \Oquiz\Database::getDb();

        // On execute la requête SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        // On retourne les résultats
        return $stmt->fetchObject(static::class);
    }
}
