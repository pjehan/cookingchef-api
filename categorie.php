<?php

require_once __DIR__ . "/model/database.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET["id"])) {
        echo json_encode(getCategorie($_GET["id"]));
        die;
    }
    echo json_encode(getAllCategories());
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["_method"])) {
        if ($_POST["_method"] === "DELETE") {
            if (!isset($_POST["id"])) {
                echo "Missing id parameter!";
                die;
            }
            deleteCategorie($_POST["id"]);
        } else if ($_POST["_method"] === "PUT") {
            if (!isset($_POST["id"])) {
                echo "Missing id parameter!";
                die;
            }
            arrayKeysExists($_POST, ["libelle"]);
            updateCategorie($_POST);
        } else {
            echo "_method " . $_POST["_method"] . " not supported!";
            die;
        }
    } else {
        arrayKeysExists($_POST, ["libelle"]);
        insertCategorie($_POST);
    }
}

if (isset($_POST["_redirect"])) {
    header("Location: " . $_POST["_redirect"]);
} else {
    header('Content-type:application/json;charset=utf-8');
}
