<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';

$patient_id = $_GET['id'];

// First, delete all appointments associated with the patient
$sql = "DELETE FROM appointments WHERE patient_id = '$patient_id'";
$conn->query($sql);

// Now delete the patient
$sql = "DELETE FROM users WHERE id = '$patient_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: manage-patients.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}
?>