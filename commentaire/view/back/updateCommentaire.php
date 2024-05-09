<?php
include 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';
require_once 'c:/wamp64/www/forum/commentaire/model/commentaire.php';

$error = "";
// create an instance of the controller
$commentaireC = new commentaireC();

// Retrieve the id_forum from the URL parameter
$id_forum = isset($_GET['id_forum']) ? $_GET['id_forum'] : null;

// Check if form is submitted
if (
    isset($_POST["auteur"]) &&
    isset($_POST["contenu"]) &&
    isset($id_forum)
) {
    if (
        !empty($_POST["auteur"]) &&
        !empty($_POST["contenu"])
    ) {
        // Retrieve form data
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
<!DOCTYPE html>
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
    // If id_forum is set, it means the form was submitted with an ID to update a comment
    if (isset($id_forum)) {
        // Retrieve the comment data by its ID
        $commentaire = $commentaireC->showCommentaire($id_forum);
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
                    <input type="submit" value="Update">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
        <!-- Include id_forum as a hidden input field -->
        <input type="hidden" name="id_forum" value="<?php echo $id_forum; ?>">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
        }
        input[type="text"]:focus {
            border-color: #007bff;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        table tr:last-child td {
            border-bottom: none;
        }
        label {
            font-weight: bold;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>

    <?php
    }
    ?>
</body>
</html>
