<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';

$doctor_id = $_GET['id'];

// First, delete all appointments associated with the doctor
$sql = "DELETE FROM appointments WHERE doctor_id = '$doctor_id'";
$conn->query($sql);

// Now delete the doctor
$sql = "DELETE FROM users WHERE id = '$doctor_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: manage-doctors.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}
?>