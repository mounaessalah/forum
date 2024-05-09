<style>
@keyframes changeImage {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

/* CSS pour l'effet de transition au survol */
.image-button1 {
    background: none; /* Remove background */
    border: none; /* Remove border */
    cursor: pointer;
    transition: transform 0.9s ease-in-out;
}


/* Effet d'animation lors du clic */
.image-button1.clicked img {
    animation: changeImage 0.3s ease-in-out forwards;
    content: url('../back/image/like.png');
    
}
</style>

<?php
// Connectez-vous à votre base de données
require 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';
$error = "";
//$n=new news;
$commentaireC = new CommentaireC();// Create an instance of the news controller
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez l'ID de la news à incrémenter depuis la requête
    $id_forum = $_POST['id_forum'];
    //$n=$ne-> getNews($news_id);
    $nblke=1+$n['nblike'];
    $commentaireC->updateNblike($nblke,$id_forum);
 
    echo "Nblike incremented successfully";
}
?>


 <!-- Navigation Buttons (Like, Comment) -->
 <nav class="navbar">
                  <ul>
                    <li>
                    <button id="lkBtn_<?php echo $commentaire['id_forum']; ?>" type="button" class="image-button1" data_like="<?php echo $commentaire['id_forum']; ?>">
                        <img src="like.png" alt="Like">
                        
                    </button>
                  </ul>
              </nav>


<script>
d<script>
    // JavaScript function to handle the like button click event
    function likeComment(commentId) {
        // Send an AJAX request to update the like count
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'updateLikeCount.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Update the like count displayed on the page
                var likeCountElement = document.getElementById('likeCount_' + commentId);
                var newLikeCount = parseInt(likeCountElement.innerHTML) + 1;
                likeCountElement.innerHTML = newLikeCount;
            } else {
                // Handle errors
                console.error('Failed to update like count');
            }
        };
        xhr.onerror = function () {
            // Handle errors
            console.error('Failed to update like count');
        };
        xhr.send('commentId=' + commentId);
    }
</script>
</script>