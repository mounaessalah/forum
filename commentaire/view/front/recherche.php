<?php
// Include commentaireC.php to access the CommentaireC class
include_once 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the id_forum field is set and not empty
  if (isset($_POST['auteur']) && !empty($_POST['auteur'])) {
        // Get the id_forum value from the form
        $auteur = $_POST['auteur'];
        // Create an instance of the CommentaireC class
        $commentaireC = new CommentaireC();

        // Call the searchCommentaire method from CommentaireC instance
        $results = $commentaireC->rechercheCommentaire($auteur);

        // Display the results
        echo "Search successfully";
        if (!empty($results)) {
          echo "<table>";
          echo "<tr><th>Auteur</th><th>Contenu</th><th>Actions</th></tr>"; // Add a new header for actions
          foreach ($results as $row) {
              echo "<tr>";
              echo "<td>" . $row['auteur'] . "</td>";
              echo "<td>" . $row['contenu'] . "</td>";
             
             
              echo "</tr>";
          }
          echo "</table>";
      } 
}}
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px; /* Add some margin at the top for spacing */
    }

    th {
        background-color: #f2f2f2;
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e2e2e2;
    }
</style>
