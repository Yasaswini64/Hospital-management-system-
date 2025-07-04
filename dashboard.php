<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>

<header class="main-header">
    <h1>🏥 <span class="highlight">Hospital Management System</span></h1>
    <div class="header-buttons">
        <a href="../index.php" class="nav-button">🏠 Home</a>
        <a href="../logout.php" class="nav-button logout">🚪 Logout</a>
    </div>
</header>

<main class="dashboard">
    <h2>🛠️ Admin Panel</h2>
    <p>Welcome, Admin! Manage hospital operations efficiently.</p>

    <div class="dashboard-links">
        <a href="manage-doctors.php" class="dashboard-button">👨‍⚕️ Manage Doctors</a>
        <a href="manage-patients.php" class="dashboard-button">🧑‍⚕️ Manage Patients</a>
        <a href="appointments.php" class="dashboard-button">📅 Manage Appointments</a>
    </div>
</main>

<footer>
    <?php include '../includes/footer.php'; ?>
</footer>

<style>
    /* General Page Styling */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Main Header */
    .main-header {
        width: 100%;
        background: #00796b;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .main-header h1 {
        font-size: 1.8em;
        font-weight: bold;
        margin: 0;
        text-transform: uppercase;
    }

    .highlight {
        color: #ffeb3b;
    }

    .header-buttons {
        display: flex;
        gap: 10px;
    }

    /* Navigation Buttons */
    .nav-button {
        padding: 8px 15px;
        font-size: 1em;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        background: #3498db;
        transition: 0.3s;
        font-weight: bold;
    }

    .nav-button.logout {
        background: #e74c3c;
    }

    .nav-button:hover {
        opacity: 0.8;
    }

    /* Dashboard Section */
    .dashboard {
        max-width: 700px;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin-top: 80px; /* Offset to avoid overlap with fixed header */
    }

    /* Dashboard Links */
    .dashboard-links {
        display: flex;
        flex-direction: column;
        gap: 15px;
        align-items: center;
        margin-top: 20px;
    }

    .dashboard-button {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 25px;
        font-size: 1.1em;
        font-weight: bold;
        color: white;
        background: #00796b;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s ease;
        width: 80%;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }

    .dashboard-button:hover {
        background: #004d40;
        transform: translateY(-2px);
    }

    /* Footer Styling */
    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
        background: #2c3e50;
        color: white;
    }
</style>
