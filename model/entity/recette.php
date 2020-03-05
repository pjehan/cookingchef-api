<?php

function findRecettes($fields) {
    global $connection;

    $query = "SELECT
            recette.id,
            recette.titre,
            recette.image,
            recette.date_creation,
            DATE_FORMAT(recette.date_creation, '%e %M %Y') AS date_creation_format,
            recette.description_courte,
            categorie.id AS 'categorie_id',
            categorie.libelle AS 'categorie_libelle',
            utilisateur.nom AS 'utilisateur_nom',
            utilisateur.prenom AS 'utilisateur_prenom',
            CONCAT(utilisateur.prenom, ' ', LEFT(utilisateur.nom, 1), '.') AS pseudo,
            COUNT(jaime.utilisateur_id) AS 'nb_likes'
        FROM recette
        INNER JOIN categorie ON categorie.id = recette.categorie_id
        INNER JOIN utilisateur ON utilisateur.id = recette.utilisateur_id
        LEFT JOIN jaime ON jaime.recette_id = recette.id
        WHERE 1 = 1";

    if (isset($fields["titre"])) {
        $query .= " AND (recette.titre LIKE CONCAT('%', :titre, '%') OR recette.description LIKE CONCAT('%', :description, '%'))";
    }
    if (isset($fields["categorie"])) {
        $query .= " AND categorie.id = :categorie_id";
    }

    $query .= " GROUP BY recette.id ORDER BY recette.date_creation DESC";

    if(isset($fields["limit"])) {
        $query .= " LIMIT :limit";
    }

    $stmt = $connection->prepare($query);
    if (isset($fields["titre"])) {
        $stmt->bindParam(':titre', $fields["titre"]);
        $stmt->bindParam(':description', $fields["titre"]);
    }
    if (isset($fields["categorie"])) {
        $stmt->bindParam(':categorie_id', $fields["categorie"]);
    }
    if (isset($fields["limit"])) {
        $stmt->bindParam(':limit', $fields["limit"]);
    }
    $stmt->execute();

    return $stmt->fetchAll();
}

function getAllRecettes() {
    global $connection;

    $query = "SELECT
                recette.id,
                recette.titre,
                recette.image,
                recette.date_creation,
                DATE_FORMAT(recette.date_creation, '%e %M %Y') AS date_creation_format,
                recette.description_courte,
                categorie.id AS 'categorie_id',
                categorie.libelle AS 'categorie_libelle',
                utilisateur.nom AS 'utilisateur_nom',
                utilisateur.prenom AS 'utilisateur_prenom',
                CONCAT(utilisateur.prenom, ' ', LEFT(utilisateur.nom, 1), '.') AS pseudo,
                COUNT(jaime.utilisateur_id) AS 'nb_likes'
            FROM recette
            INNER JOIN categorie ON categorie.id = recette.categorie_id
            INNER JOIN utilisateur ON utilisateur.id = recette.utilisateur_id
            LEFT JOIN jaime ON jaime.recette_id = recette.id
            GROUP BY recette.id
            ORDER BY recette.date_creation DESC
            ;";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function getRecette($id) {
    global $connection;

    $query = "SELECT
            recette.id,
            recette.titre,
            recette.image,
            recette.date_creation,
            DATE_FORMAT(recette.date_creation, '%e %M %Y') AS date_creation_format,
            recette.description,
            recette.description_courte,
            recette.categorie_id,
            categorie.libelle AS 'categorie_libelle',
            utilisateur.nom AS 'utilisateur_nom',
            utilisateur.prenom AS 'utilisateur_prenom',
            CONCAT(utilisateur.prenom, ' ', LEFT(utilisateur.nom, 1), '.') AS pseudo,
            COUNT(jaime.utilisateur_id) AS 'nb_likes'
        FROM recette
        INNER JOIN categorie ON categorie.id = recette.categorie_id
        INNER JOIN utilisateur ON utilisateur.id = recette.utilisateur_id
        LEFT JOIN jaime ON jaime.recette_id = recette.id
        WHERE recette.id = :recette_id
        GROUP BY recette.id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':recette_id', $id);
    $stmt->execute();

    return $stmt->fetch();
}

function insertRecette($values) {
    global $connection;

    $query = "INSERT INTO recette (titre, image, description_courte, description, utilisateur_id, categorie_id, date_creation)
                VALUES (:titre, :image, :description_courte, :description, :utilisateur_id, :categorie_id, NOW())
        ";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':titre', $values["titre"]);
    $stmt->bindParam(':image', $values["image"]);
    $stmt->bindParam(':description_courte', $values["description_courte"]);
    $stmt->bindParam(':description', $values["description"]);
    $stmt->bindParam(':utilisateur_id', $values["utilisateur_id"]);
    $stmt->bindParam(':categorie_id', $values["categorie_id"]);
    $stmt->execute();
}

function updateRecette($values) {
    /* @var $connection PDO */
    global $connection;

    $query = "UPDATE recette
                SET titre = :titre,
                    image = :image,
                    description_courte = :description_courte,
                    description = :description,
                    categorie_id = :categorie_id
                WHERE id = :id
            ;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $values["id"]);
    $stmt->bindParam(':titre', $values["titre"]);
    $stmt->bindParam(':image', $values["image"]);
    $stmt->bindParam(':description_courte', $values["description_courte"]);
    $stmt->bindParam(':description', $values["description"]);
    $stmt->bindParam(':categorie_id', $values["categorie_id"]);
    $stmt->execute();
}

function deleteRecette($id) {
    /* @var $connection PDO */
    global $connection;

    $query = "DELETE FROM recette WHERE id = :id;";

    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
