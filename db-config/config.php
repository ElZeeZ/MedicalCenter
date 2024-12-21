<?php

function connectServer($host, $log, $pass, $mess) {
   
    $dbc = mysqli_connect($host, $log, $pass);

  
    if (!$dbc) {
        die("Connection error: " . mysqli_connect_errno() . ": " . mysqli_connect_error());
    }

   
    if ($mess == 1) {
        return $dbc;
    } else {
        echo "Couldn't connect to the server.";
        return null;
    }
}


function selectDB($dbc, $dbName, $mess) {
   
    $db_selected = mysqli_select_db($dbc, $dbName);

    
    if (!$db_selected) {
        die("Database selection error: " . mysqli_error($dbc));
    }

    
    if ($mess == 1) {
        return true;
    } else {
        echo "Couldn't select the database.";
        return false;
    }
}


$con = connectServer("localhost", "root", "", 1); 
if ($con) {
    selectDB($con, "medicalcenter", 1);
}
?>
