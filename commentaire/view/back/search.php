<?php
// Include commentaireC.php to access the CommentaireC class
include_once 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the id_forum field is set and not empty
    if (isset($_POST["id_forum"]) && !empty($_POST["id_forum"])) {
        // Get the id_forum value from the form
        $id_forum = $_POST["id_forum"];

        // Create an instance of the CommentaireC class
        $commentaireC = new CommentaireC();

        // Call the searchCommentaire method from CommentaireC instance
        $results = $commentaireC->searchCommentaire($id_forum);

        // Display the results
        echo "Search successfully";
        if (!empty($results)) {
          echo "<table>";
          echo "<tr><th>Auteur</th><th>Contenu</th><th>Actions</th></tr>"; // Add a new header for actions
          foreach ($results as $row) {
              echo "<tr>";
              echo "<td>" . $row['auteur'] . "</td>";
              echo "<td>" . $row['contenu'] . "</td>";
              echo "<td align='center'>
                      <form method='POST' action='../updateCommentaire.php'>
                          <input type='hidden' name='id_forum' value='" . $row['id_forum'] . "'>
                          <input type='submit' name='update' value='Update'>
                      </form>
                  </td>";
              echo "<td>
                      <a href='deleteCommentaire.php?id_forum=" . $row['id_forum'] . "' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                  </td>";
              echo "</tr>";
          }
          echo "</table>";
      } else {
          // No results found for the provided id_forum
          echo "<p>No commentaires found for id_forum: $id_forum. It may not be a valid id_forum.</p>";
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
