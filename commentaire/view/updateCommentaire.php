<?php
include 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';
require_once 'c:/wamp64/www/forum/commentaire/model/commentaire.php';

$error = "";
// create an instance of the controller
$commentaireC = new commentaireC();

if (
    isset($_POST["auteur"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["id_forum"])
) {
    if (
        !empty($_POST["auteur"]) &&
        !empty($_POST["contenu"])
    ) {
        // Retrieve form data
        $id_forum = $_POST["id_forum"];
        $auteur = $_POST["auteur"];
        $contenu = $_POST["contenu"];

        // Create a new Commentaire object with the provided data
        $commentaire = new Commentaire($id_forum, $auteur, $contenu);

        // Update the comment in the database
        $commentaireC->updateCommentaire($commentaire, $id_forum);

        // Redirect to the list of comments page
        header('Location:http://localhost/forum/commentaire/view/back/listCommentaire.php');
        exit();
    } else {
        $error = "Missing information";
    }
}

// If the required fields are not set or empty, or if there's an error, display the form
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Commentaire</title>
    <style>
        /* Your CSS styles */
    </style>
</head>

<body>
    <button><a href="listCommentaire.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    // If $_POST['id_forum'] is set, it means the form was submitted with an ID to update a comment
    if (isset($_POST['id_forum'])) {
        // Retrieve the comment data by its ID
        $commentaire = $commentaireC->showCommentaire($_POST['id_forum']);
    ?>

    <form action="" method="POST">
        <table border="2" align="center">
            <tr>
                <td><label for="auteur">Auteur :</label></td>
                <td>
                    <input type="text" id="auteur" name="auteur" value="<?php echo $commentaire['auteur'] ?>" />
                    <span id="erreurauteur" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="contenu">Contenu :</label></td>
                <td><input type="text" id="contenu" name="contenu" value="<?php echo $commentaire['contenu'] ?>" />
                    <span id="erreurcontenu" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="id_forum" value="<?php echo $_POST['id_forum']; ?>">
                    <input type="submit" value="Update">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    }
    ?>
</body>

</html>
