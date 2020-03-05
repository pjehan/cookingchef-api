<?php

function getAllIngredients() {
    global $connection;

    $query = "SELECT
                ingredient.id,
                ingredient.libelle
            FROM ingredient
            ORDER BY ingredient.libelle;";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getAllIngredientsByRecette($id) {
    global $connection;
    
    $query = "SELECT
                ingredient.id,
                ingredient.libelle,
                recette_has_ingredient.qte,
                unite.libelle AS 'unite'
            FROM ingredient
            INNER JOIN recette_has_ingredient ON recette_has_ingredient.ingredient_id = ingredient.id
            LEFT JOIN unite ON unite.id = recette_has_ingredient.unite_id
            WHERE recette_has_ingredient.recette_id = :id;";
    
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    return $stmt->fetchAll();
}
