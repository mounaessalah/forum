<?php

class Notification {
    private $type;
    private $reference_id;
    private $user_id;

    public function __construct($type, $reference_id, $user_id) {
        $this->type = $type;
        $this->reference_id = $reference_id;
        $this->user_id = $user_id;
    }

    public function insertNotification() {
        // Include the database configuration
        include_once "c:/wamp64/www/forum/forum/config.php";

        // Create a new PDO connection
        $db = new PDO($dsn, $username, $password, $options);

        // Prepare the SQL statement to insert the notification
        $sql = "INSERT INTO notifications (type, reference_id, user_id) VALUES (:type, :reference_id, :user_id)";
        $stmt = $db->prepare($sql);

        // Bind the parameters and execute the statement
        $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
        $stmt->bindParam(':reference_id', $this->reference_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
}

?>
