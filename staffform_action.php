<?php 

include('db-config/config.php');


$firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
$staffType = isset($_POST['staffType']) ? htmlspecialchars($_POST['staffType']) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';

$stmt = mysqli_prepare($con, "INSERT INTO staff (firstName, lastName, staffType, phone, email ) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($con));
}


mysqli_stmt_bind_param($stmt, "sssis", $firstName, $lastName, $staffType, $phone, $email);

if (!mysqli_stmt_execute($stmt)) {
    die("Error executing statement: " . mysqli_stmt_error($stmt));
}

echo "<script>alert('Registration successful');</script>";

mysqli_stmt_close($stmt);
mysqli_close($con);

echo "<script>window.location.href='index.php';</script>";

?>
