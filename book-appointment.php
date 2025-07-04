<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) VALUES ('$patient_id', '$doctor_id', '$appointment_date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>✅ Appointment booked successfully.</p>";
    } else {
        echo "<p class='error-message'>❌ Error: " . $conn->error . "</p>";
    }
}

// Fetch doctors for the dropdown
$sql = "SELECT * FROM users WHERE role = 'doctor'";
$doctors = $conn->query($sql);
?>

<header class="navbar">
    <h1>🏥 Hospital Management System</h1>
    <div class="nav-links">
        <a href="../index.php" class="nav-button">Home</a>
        <a href="javascript:history.back()" class="nav-button back">⬅ Back</a>
        <a href="../logout.php" class="nav-button logout">Logout</a>
    </div>
</header>

<main class="appointment-container">
    <h2>Book an Appointment</h2>
    <form method="POST" action="">
        <label for="doctor_id">Select Doctor:</label>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">-- Choose a Doctor --</option>
            <?php while ($row = $doctors->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="appointment_date">Choose Date & Time:</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" required>

        <button type="submit" class="book-button">Book Appointment</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #f1f8e9, #a5d6a7);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }

    /* Navbar */
    .navbar {
        width: 100%;
        background: #0d47a1;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .navbar h1 {
        font-size: 1.8em;
        margin: 0;
    }

    .nav-links {
        display: flex;
        gap: 15px;
    }

    .nav-button {
        padding: 10px 20px;
        font-size: 1em;
        font-weight: 600;
        color: white;
        background: #1976d2;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2);
    }

    .nav-button:hover {
        background: #1565c0;
    }

    .logout {
        background: #d32f2f;
    }

    .logout:hover {
        background: #b71c1c;
    }

    .back {
        background: #ffb300;
    }

    .back:hover {
        background: #ff8f00;
    }

    /* Appointment Form */
    .appointment-container {
        max-width: 500px;
        margin-top: 40px;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
        animation: fadeIn 0.6s ease-in-out;
    }

    .appointment-container h2 {
        color: #1b5e20;
        font-size: 2em;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-size: 1.1em;
        color: #333;
    }

    select, input {
        padding: 10px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
    }

    .book-button {
        padding: 12px;
        font-size: 1.2em;
        font-weight: 600;
        color: white;
        background: #388e3c;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s ease;
        display: inline-block;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .book-button:hover {
        background: #2e7d32;
        transform: translateY(-2px);
    }

    /* Success & Error Messages */
    .success-message, .error-message {
        font-size: 1em;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        text-align: center;
    }

    .success-message {
        background: #c8e6c9;
        color: #1b5e20;
    }

    .error-message {
        background: #ffcdd2;
        color: #b71c1c;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
