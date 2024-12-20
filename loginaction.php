<?php
session_start();

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


if ($username === 'admin' && $password === 'admin') {

    $_SESSION['username'] = $username;
   
    echo "<script>alert('Welcome back!');</script>";
    echo "<script>window.location.href='adminhome.php';</script>";
} else {
   
    echo "<script>alert('Invalid credentials. Please try again.');</script>";
    echo "<script>window.location.href='login.php';</script>";
}
?>
