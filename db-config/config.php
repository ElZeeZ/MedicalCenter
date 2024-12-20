<?php
// Connect to server
function connectServer($host, $log, $pass, $mess) {
    // Establish the connection
    $dbc = mysqli_connect($host, $log, $pass);

    // Check for connection errors
    if (!$dbc) {
        die("Connection error: " . mysqli_connect_errno() . ": " . mysqli_connect_error());
    }

    // Return or display success message
    if ($mess == 1) {
        return $dbc;
    } else {
        echo "Couldn't connect to the server.";
        return null;
    }
}

// Function to select database
function selectDB($dbc, $dbName, $mess) {
    // Select the database
    $db_selected = mysqli_select_db($dbc, $dbName);

    // Check for selection errors
    if (!$db_selected) {
        die("Database selection error: " . mysqli_error($dbc));
    }

    // Return or display success message
    if ($mess == 1) {
        return true;
    } else {
        echo "Couldn't select the database.";
        return false;
    }
}

// Main execution
$con = connectServer("localhost", "root", "", 1); // Connect to the server
if ($con) {
    selectDB($con, "medicalcenter", 1); // Select the database
}
?>
