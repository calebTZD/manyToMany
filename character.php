<?php

// Character CRUD functionality

require __DIR__ . '/data.php';

function deleteCharacter($id){
    $dbConn = getConnection();
    $data = NULL;
    $sql = 'DELETE FROM players WHERE id ='.$id;
    if ($dbConn->query($sql) === TRUE) {
        $data = "character deleted";
    }
   
    mysqli_close($dbConn);
    return $data;
}

function readCharacters($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `pname` LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function readCharactersDown($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `pname` DESC LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function readRaceDown($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `race` DESC LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function readRace($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `race` LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function readClassDown($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `guild` DESC LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function readClass($idx, $cnt) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = 'SELECT * FROM `players` ORDER BY `guild` LIMIT '.$idx.','.$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function searchCharacters($idx, $cnt, $pstr) {
    $characters = array();
    $dbConn = getConnection();

    // run query 
    $sql = "SELECT * FROM players WHERE pname LIKE '%".$pstr."%' ORDER BY pname LIMIT ".$idx.",".$cnt;
    // echo $sql;
    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }

    
    while ($row = $result->fetch_assoc()) {  
        $characters[] = $row; 
    }
    mysqli_close($dbConn);
    return $characters;
}

function update($pname, $race, $guild, $id){
    $dbConn = getConnection();
    $data = NULL;

    $sql = "UPDATE players SET pname = '".$pname."', race = '".$race."', guild ='".$guild."' WHERE id = ".$id;    
    if ($dbConn->query($sql) === TRUE) {
        $data = "character Changed";
    }

    mysqli_close($dbConn);
    return $data;
}

function insert($pname, $race, $guild, $id){
    $dbConn = getConnection();
    $data = NULL;

    $sql = "INSERT INTO players (id, pname, race, guild) VALUES('".$id."','".$pname."','".$race."','".$guild."')";    
    if ($dbConn->query($sql) === TRUE) {
        $data = "character created";
    }

    mysqli_close($dbConn);
    return $data;
}

function read($id){
    $dbConn = getConnection();
    $items = array();

    // $sql ="SELECT * FROM `items` LEFT JOIN `player_item` ON player_item.itemid = items.id WHERE player_item.playerid =".$id;
    $sql ="SELECT * FROM `items` INNER JOIN (SELECT * FROM `player_item` WHERE player_item.playerid ='".$id."') playeritems ON playeritems.itemid = items.id";

    if (!$result = $dbConn->query($sql)) {
        // TODO: remove error printing
        $err = "Error Query: " . $sql . "\n" .
                "Errno: " . $dbConn->errno . "\n" . 
                "Error: " . $dbConn->error . "\n";
        echo $err;
        return NULL;
    }
    while ($row = $result->fetch_assoc()) {  
        $items[] = $row; 
    }

    mysqli_close($dbConn);
    return $items;
}

function insertIntoMtable($playerid, $itemid){
    $dbConn = getConnection();
    $data = NULL;

    $sql = "INSERT INTO player_item(playerid,itemid) VALUES('".$playerid."','".$itemid."')";
    if ($dbConn->query($sql) === TRUE) {
        $data = "Entry created";
    }

    mysqli_close($dbConn);
    return $data;
}

?>