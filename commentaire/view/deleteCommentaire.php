<?php
include 'c:/wamp64/www/forum/commentaire/controller/commentaireC.php';
$commentaireC = new commentaireC();
$commentaireC->deleteCommentaire($_GET["id_forum"]);
header('Location:listCommentaire.php');