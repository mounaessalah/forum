<?php
// Include necessary files and establish database connection
include_once "c:/wamp64/www/forum/commentaire/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deny_comment"])) {
    // Get the comment ID from the form submission
    $comment_id = $_POST["comment_id"];

    // Execute SQL DELETE query to remove the selected comment
    $sql = "DELETE FROM commentaire WHERE id_forum = :comment_id";
    $db = config::getConnexion(); // Assuming 'id_forum' is the column containing comment ID
    $query = $db->prepare($sql);
    $query->bindParam(':comment_id', $comment_id);
    $query->execute();

    // Redirect back to listcommentaire.php after denial
    header("Location: http://localhost/forum/commentaire/view/front/comments.php");
    exit();
} else {
    // Handle invalid or unauthorized request
    echo "Invalid or unauthorized request.";
}
?>
