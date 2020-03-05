<?php $api_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <title>CookingChef API</title>
    </head>
<body>

<h1>CookingChef API</h1>

<h2>Recettes</h2>

<h3>Récupérer l'ensemble des recettes</h3>
<table>
    <tr>
        <th>URL</th>
        <td><a href="<?php echo $api_url ?>recette.php"><?php echo $api_url ?>recette.php</a></td>
    </tr>
    <tr>
        <th>Method</th>
        <td>GET</td>
    </tr>
    <tr>
        <th>Params</th>
        <td>-</td>
    </tr>
</table>

<h3>Récupérer les dernières recettes</h3>
<table>
    <tr>
        <th>URL</th>
        <td><a href="<?php echo $api_url ?>recette.php"><?php echo $api_url ?>recette.php</a></td>
    </tr>
    <tr>
        <th>Method</th>
        <td>GET</td>
    </tr>
    <tr>
        <th>Params</th>
        <td>
            <ul>
                <li>limit - int</li>
            </ul>
        </td>
    </tr>
</table>

<h3>Récupérer les données d'une requête</h3>
<table>
    <tr>
        <th>URL</th>
        <td><a href="<?php echo $api_url ?>recette.php"><?php echo $api_url ?>recette.php</a></td>
    </tr>
    <tr>
        <th>Method</th>
        <td>GET</td>
    </tr>
    <tr>
        <th>Params</th>
        <td>
            <ul>
                <li>id - int</li>
            </ul>
        </td>
    </tr>
</table>

<h3>Insérer une nouvelle recette</h3>
<table>
    <tr>
        <th>URL</th>
        <td><a href="<?php echo $api_url ?>recette.php"><?php echo $api_url ?>recette.php</a></td>
    </tr>
    <tr>
        <th>Method</th>
        <td>POST</td>
    </tr>
    <tr>
        <th>Params</th>
        <td>
            <ul>
                <li>titre - string</li>
                <li>image - string</li>
                <li>description_courte - string</li>
                <li>description - string</li>
                <li>utilisateur_id - int</li>
                <li>categorie_id - int</li>
            </ul>
        </td>
    </tr>
</table>

</body>
</html>