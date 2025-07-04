<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';


// Fetch patient's medical history
$patient_id = $_SESSION['user_id'];
$sql = "SELECT a.id, u.username AS doctor_name, a.appointment_date, a.prescription 
        FROM appointments a
        JOIN users u ON a.doctor_id = u.id
        WHERE a.patient_id = '$patient_id'";
$result = $conn->query($sql);
?>

<header class="navbar">
    <h1>🏥 Hospital Management System</h1>
    <div class="nav-links">
        <a href="../index.php" class="nav-button">Home</a>
        <a href="../logout.php" class="nav-button logout">Logout</a>
    </div>
</header>

<main class="history-container">
    <h2>Your Medical History</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Appointment ID</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Prescription</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo !empty($row['prescription']) ? $row['prescription'] : 'N/A'; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-history">📄 No medical history found.</p>
    <?php endif; ?>

    <a href="javascript:history.back()" class="back-button">⬅ Back</a>
</main>

<?php include '../includes/footer.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #f3e5f5, #d1c4e9);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }

    /* Navbar */
    .navbar {
        width: 100%;
        background: #6a1b9a;
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
        background: #8e24aa;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2);
    }

    .nav-button:hover {
        background: #7b1fa2;
    }

    .logout {
        background: #d32f2f;
    }

    .logout:hover {
        background: #b71c1c;
    }

    /* Medical History Table */
    .history-container {
        max-width: 700px;
        margin-top: 40px;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-align: center;
        animation: fadeIn 0.6s ease-in-out;
    }

    .history-container h2 {
        color: #4a148c;
        font-size: 2em;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background: #7b1fa2;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background: #f3e5f5;
    }

    .no-history {
        font-size: 1.2em;
        color: #666;
        margin-top: 20px;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 20px;
        font-size: 1.2em;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        background: #757575;
        color: white;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .back-button:hover {
        background: #616161;
        transform: translateY(-2px);
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
