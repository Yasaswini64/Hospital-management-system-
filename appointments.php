<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

// Fetch appointments from the database
$sql = "SELECT a.id, a.appointment_date, u1.username AS patient, u2.username AS doctor 
        FROM appointments a
        JOIN users u1 ON a.patient_id = u1.id
        JOIN users u2 ON a.doctor_id = u2.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #4A90E2, #56A3F0);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            font-size: 1.8em;
            font-weight: bold;
            border-radius: 0 0 15px 15px;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            background: #56A3F0;
            color: white;
            font-size: 0.9em;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn:hover {
            background: #318CE7;
        }

        .back {
            background: #FF7373;
        }

        .back:hover {
            background: #FF5C5C;
        }

        /* Main Layout */
        main {
            padding: 20px;
            max-width: 800px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 1.6em;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 3px solid #4A90E2;
            display: inline-block;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #4A90E2;
            color: white;
            font-size: 1em;
        }

        td {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        /* Delete Button */
        .delete-btn {
            background: #FF7373;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .delete-btn:hover {
            background: #FF5C5C;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .nav-buttons {
                margin-top: 10px;
                justify-content: center;
            }

            main {
                width: 90%;
                padding: 15px;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                font-size: 0.9em;
            }

            .btn {
                font-size: 0.8em;
                padding: 8px 12px;
            }
        }
        footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
       
        color: black;
    }
    </style>
</head>
<body>

    <!-- Header with Navigation -->
    <div class="header">
        Hospital Management System
        <div class="nav-buttons">
            <a href="dashboard.php" class="btn">🏠 Home</a>
            <button onclick="history.back()" class="btn back">Back</button>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <h2>Manage Appointments</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['patient']); ?></td>
                <td><?php echo htmlspecialchars($row['doctor']); ?></td>
                <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                <td>
                    <a href="delete-appointment.php?id=<?php echo $row['id']; ?>" class="delete-btn">❌ Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
            
        </table>
    </main>
    <footer>
    <?php include '../includes/footer.php'; ?>
</footer>

</body>
</html>

