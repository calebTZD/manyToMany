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
// function getPeople() {
    // $people = array();
    // $dbConn = getConnection();

    // // run query 
    // $sql = 'SELECT * FROM person';
    // if (!$result = $dbConn->query($sql)) {
    //     $err = "Error Query: " . $sql . "\n" .
    //             "Errno: " . $dbConn->errno . "\n" . 
    //             "Error: " . $dbConn->error . "\n";
    //     echo $err;
    //     return NULL;
    // }

    // // zero rows
    // if ($result->num_rows === 0) {
    // }

    // while ($row = $result->fetch_assoc()) {  
    //     $people[] = $row; 
    // }
    // mysqli_close($dbConn);
    // return $people;
  // } 

  // function getPerson($id) {
  //   $people = array();
  //   $dbConn = getConnection();

  //   // run query 
  //   $sql = 'SELECT * FROM person WHERE id = ' . $id;
  //   if (!$result = $dbConn->query($sql)) {
  //       $err = "Error Query: " . $sql . "\n" .
  //               "Errno: " . $dbConn->errno . "\n" . 
  //               "Error: " . $dbConn->error . "\n";
  //       echo $err;
  //       return NULL;
  //   }

  //   $person = $result->fetch_assoc();
  //   mysqli_close($dbConn);
  //   return $person;
  // } 

//   $results = getPeople();
//   if ($results){
//       echo json_encode($results);
//   } else {
//       echo "Failed";
//   }

//   $results = getPerson(1);
//   if ($results){
//       echo json_encode($results);
//   } else {
//       echo "Failed";
//   }
?>