<?php
require __DIR__ . '/data.php';

function readItems(){
    $items = array();
    $dbConn = getConnection();

    $sql = 'SELECT * FROM items';
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
        $items[] = $row; 
    }
    mysqli_close($dbConn);
    return $items;
}
function deleteItem($id){
    $dbConn = getConnection();
    $data = NULL;

    $sql = 'DELETE FROM items WHERE id ='.$id;
   
    if ($dbConn->query($sql) === TRUE) {
        $data = "item deleted";
    }
   
    mysqli_close($dbConn);
    return $data;
}
function update($iname, $id){
    $dbConn = getConnection();
    $data = NULL;

    $sql = "UPDATE items SET iname = '".$iname."' WHERE id = '".$id."'";
    if ($dbConn->query($sql) === TRUE) {
        $data = "item Changed";
    }
    mysqli_close($dbConn);
    return $data;
}
function insert($iname, $id){
    $dbConn = getConnection();
    $data = NULL;

    $sql = "INSERT INTO items (id, iname)  VALUES ('".$id."','".$iname."')";

    if ($dbConn->query($sql) === TRUE) {
        $data = "item Changed";
    }
    mysqli_close($dbConn);
    return $data;
}
?>