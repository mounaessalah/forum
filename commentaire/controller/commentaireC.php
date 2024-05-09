<?php

require_once 'c:/wamp64/www/forum/commentaire/config.php';
class CommentaireC {
    public function afficheCommentaire() {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("SELECT c.*, f.* FROM commentaire c JOIN forum f ON c.id_forum = f.id_forum");
            $query->execute();
            $commentaires = $query->fetchAll();
            return $commentaires;
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return []; // Return an empty array or handle the error as appropriate for your application
        }
    }
    public function rechercheCommentaire($value) {
       
            $db = config::getConnexion();
            $SEARCH=$db->prepare("SELECT * FROM commentaire WHERE auteur LIKE :value");
            $value="%".$value."%";
            $SEARCH->bindParam("value",$value);
            $SEARCH->execute();
            return $SEARCH;
                                  
        
    }
    public function searchCommentaire($value) {
       
        $db = config::getConnexion();
        $SEARCH=$db->prepare("SELECT * FROM commentaire WHERE id_forum LIKE :value");
        $value="%".$value."%";
        $SEARCH->bindParam("value",$value);
        $SEARCH->execute();
        return $SEARCH;
                              
    
}


    public function listCommentaire()
    {
        try {
            $sql = "SELECT * FROM commentaire";
            $db = config::getConnexion();
            $liste = $db->query($sql);
            return $liste;
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return false; // or handle the error as appropriate for your application
        }
    }
    
    function deleteCommentaire($id_forum)
    {
        try {
            $sql = "DELETE FROM commentaire WHERE id_forum = :id_forum"; 
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id_forum', $id_forum);
        
            $result = $req->execute(); // Execute the query and store the result
        
            if ($result) {
                echo "<script type='text/javascript'> 
                        alert('Suppression réussie!'); 
                        window.location.href = 'http://localhost/forum/commentaire/view/listCommentaire.php';
                      </script>";
                exit(); // Make sure to end the script execution after the redirection
            } else {
                echo "<script type='text/javascript'> 
                        alert('Erreur lors de la suppression'); 
                      </script>";
            }
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
        }
    }
    public function forumExists($id_forum) {
        try {
            // Assuming you have a database connection
            $db = config::getConnexion();

            // Prepare the SQL query
            $query = $db->prepare("SELECT COUNT(*) AS count FROM forum WHERE id_forum = :id_forum");

            // Bind the parameter and execute the query
            $query->execute(['id_forum' => $id_forum]);

            // Fetch the result
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Check if count is greater than 0, indicating existence of id_forum
            return ($result['count'] > 0);
        } catch (PDOException $e) {
            // Handle any database errors or exceptions
            // You can log the error, display a user-friendly message, or perform any other action
            // For now, let's just return false to indicate that an error occurred
            return false;
        }
    }
    public function updateNblike($nblike, $id_forum) {
        try {
            // Connect to the database
            $db = config::getConnexion();

            // Prepare the SQL query
            $sql = "UPDATE commentaire SET nblike = :nblike WHERE id_forum = :id_forum";

            // Prepare the query statement
            $query = $db->prepare($sql);

            // Bind the parameters
            $query->bindParam(':nblike', $nblike);
            $query->bindParam(':id_forum', $id_forum);

            // Execute the query
            $query->execute();

            // Close the database connection
            $db = null;
        } catch (PDOException $e) {
            // Handle any errors that occur during execution
            echo "Error: " . $e->getMessage();
        }
    }
    function addCommentaire(Commentaire $commentaire) {
        $sql = "INSERT INTO commentaire (id_forum, auteur, contenu, approved) 
                VALUES (:id_forum, :auteur, :contenu, 0)"; // Set approved status to 0 for pending approval
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $result = $query->execute([
                'id_forum' => $commentaire->getid_forum(),
                'auteur' => $commentaire->getauteur(),
                'contenu' => $commentaire->getcontenu()
            ]);
    
            if ($result) {
                echo "<script type=\"text/javascript\"> 
                        alert('Ajout avec succès!'); 
                        window.location.href = 'http://localhost/forum/commentaire/view/back/listCommentaire.php';
                      </script>";
                exit(); // Make sure to end the script execution after the redirection
            } else {
                echo "<script type=\"text/javascript\"> 
                        alert('Erreur lors de l\'enregistrement'); 
                      </script>";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getApprovedComments() {
     

        try {
            // Get database connection
            $db = config::getConnexion();

            // SQL query to select approved comments
            $sql = "SELECT * FROM commentaire WHERE approved = 1"; // Assuming 'approved' column is used to indicate approval status

            // Prepare and execute the SQL query
            $query = $db->prepare($sql);
            $query->execute();

            // Fetch all rows as an associative array
            $approved_comments = $query->fetchAll(PDO::FETCH_ASSOC);

            // Return the fetched comments
            return $approved_comments;
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return []; // Return an empty array if there's an error
        }
    }
    
    
    
    
    

    function showCommentaire($id_forum)
    {
        $sql = "SELECT * FROM commentaire WHERE id_forum = $id_forum"; // Modification de la requête SQL
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateCommentaire(Commentaire $commentaire, $id_forum)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE commentaire SET
                auteur = :auteur, 
                contenu = :contenu 
            WHERE id_forum = :id_forum'
        );
        
        $result = $query->execute([
            'id_forum' => $id_forum,
            'auteur' => $commentaire->getAuteur(), // Correct method name
            'contenu' => $commentaire->getContenu(), // Correct method name
        ]);
        
             if ($result) {
                echo "<script type=\"text/javascript\"> 
                        alert('mise a jour avec succès!'); 
                        window.location.href = 'http://localhost/forum/commentaire/view/back/listCommentaire.php';
                      </script>";
                exit(); // Make sure to end the script execution after the redirection
            } else {
                echo "<script type=\"text/javascript\"> 
                        alert('Erreur de mise a jour mate'); 
                      </script>";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
         
    public function listCommentaires_stat() {
        $sql = "SELECT * FROM commentaire";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $commentaires = [];
            while ($row = $query->fetch()) {
                $commentaire = new Commentaire($row['id_forum'], $row['auteur'], $row['contenu']);
                $commentaire->setid_forum($row['id']);
                $commentaires[] = $commentaire;
            }
            return $commentaires;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    
}
?>
