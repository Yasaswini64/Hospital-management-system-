<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $prescription = $_POST['prescription'];

    $sql = "UPDATE appointments SET prescription = '$prescription' WHERE id = '$appointment_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Prescription added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$appointment_id = isset($_GET['appointment_id']) ? $_GET['appointment_id'] : null;

?>

<header>
    <h1>Hospital Management System</h1>
    <nav>
        <a href="../index.php" class="button">Home</a>
        <a href="../logout.php" class="button">Logout</a>
    </nav>
</header>

<main>
    <h2>Prescribe Medicine</h2>
    <form method="POST" action="">
        <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
        <textarea name="prescription" placeholder="Enter prescription here..." required></textarea>
        <button type="submit">Submit Prescription</button>
    </form>

    <a href="appointments.php" class="button back-button">Back</a>
</main>

<?php include '../includes/footer.php'; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #00796b;
        padding: 15px;
        color: white;
    }

    nav {
        display: flex;
        gap: 10px;
    }

    .button {
        padding: 10px 15px;
        background: #004d40;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .button:hover {
        background: #00251a;
    }

    .back-button {
        background: #757575;
        margin-top: 15px;
    }

    .back-button:hover {
        background: #616161;
    }

    main {
        margin-top: 30px;
    }

    textarea {
        width: 80%;
        height: 100px;
    }

    button {
        padding: 10px 15px;
        background: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
    }

    button:hover {
        background: #388e3c;
    }
</style>
