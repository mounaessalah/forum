<?php
include_once "c:/wamp64/www/forum/commentaire/controller/commentaireC.php";
include_once "c:/wamp64/www/forum/commentaire/model/commentaire.php";

$id_forum = isset($_POST["id_forum"]) ? $_POST["id_forum"] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set and not empty
    if (isset($_POST["auteur"]) && isset($_POST["contenu"]) && !empty($_POST["auteur"]) && !empty($_POST["contenu"])) {
        // Create a new commentaire instance
        $commentaire = new commentaire($_POST['auteur'], $_POST['contenu'], $id_forum);

        // Assuming $commentaireC is an instance of your CommentaireController
        // Add the comment to the database
        $commentaireC = new commentaireC();
        $commentaireC->addCommentaire($commentaire,$id_forum);

        // Redirect to the appropriate page after adding the comment
        header('Location: http://localhost/forum/commentaire/view/back/listCommentaire.php');
        exit();
    } else {
        // Handle validation errors or missing fields here
        // For example, set an error message and display it on the form
        $error = "Please fill in all required fields.";
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire</title>
    <link rel="stylesheet" href="../css.css">
</head>
<body> 
    <script src="../js/commentaire.js"></script>

    <a href="listCommentaire.php">Back to list</a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form id="commentaire" method="POST">
        <table>
            <tr>
            </tr>
            <tr>
                <td><label for="auteur">Auteur :</label></td>
                <td>
                    <input type="text" id="auteur" name="auteur" />
                    <div id="erreurauteur" style="color: red"></div>
                </td>
            </tr>
            <tr>
                <td><label for="contenu">Contenu :</label></td>
                <td>
                    <input type="text" id="contenu" name="contenu" />
                    <div id="erreurcontenu" style="color: red"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" onclick="return validercommentaire()" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <script src="../js/commentaire.js"></script>
</body>
</html>
