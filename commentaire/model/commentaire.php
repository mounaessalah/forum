<?php
class Commentaire {
    private $id_forum;
    private $auteur;
    private $contenu;

    // Constructor
    public function __construct($id_forum = null, $auteur = null, $contenu = null) {
        $this->id_forum = $id_forum;
        $this->auteur = $auteur;
        $this->contenu = $contenu;
    }

    // Getter methods
    public function getid_forum() {
        return $this->id_forum;
    }

    public function getauteur() {
        return $this->auteur;
    }

    public function getcontenu() {
        return $this->contenu;
    }
    public function setid_forum($id_forum) {
        $this->id_forum = $id_forum;
    }

    public function setauteur($auteur) {
        $this->auteur = $auteur;
    }

    public function setcontenu($contenu) {
        $this->contenu = $contenu;
    }

}
?>
