<?php 

include('db-config/config.php');


$firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
$lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';
$dob = isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : '';
$gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
$city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
$complaint = isset($_POST['complaint']) ? htmlspecialchars($_POST['complaint']) : '';


$gendertrue = (strtolower($gender) === 'male') ? 1 : 0;


$stmt = mysqli_prepare($con, "INSERT INTO patient (firstName, lastName, dateOfBirth, chiefComplaint, gender, phone, address, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($con));
}


mysqli_stmt_bind_param($stmt, "sssssiss", $firstName, $lastName, $dob, $complaint, $gendertrue, $phone, $city, $email);

if (!mysqli_stmt_execute($stmt)) {
    die("Error executing statement: " . mysqli_stmt_error($stmt));
}

echo "<script>alert('Registration successful');</script>";

mysqli_stmt_close($stmt);
mysqli_close($con);

echo "<script>window.location.href='index.php';</script>";

?>
