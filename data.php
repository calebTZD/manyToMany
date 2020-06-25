<?php
function getConnection(){
    $connection = new mysqli('localhost', 'root', '', 'testy');
    if ($connection->connect_errno) {
        echo "Errno: " . $connection->connect_errno . "\n";
        echo "Error: " . $connection->connect_error . "\n";
        return NULL;
    }
    mysqli_query($connection, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    return $connection;
}

?>