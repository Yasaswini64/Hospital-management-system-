<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

// Initialize messages
$error = '';
$success = '';

// Get the patient ID from the URL
$patient_id = $_GET['id'] ?? null;

if (!$patient_id) {
    die("Patient ID is missing.");
}

// Fetch the patient's details
$sql = "SELECT * FROM users WHERE id = ? AND role = 'patient'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Patient not found.");
}

$patient = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);

    if (empty($username)) {
        $error = "⚠ Username is required.";
    } else {
        // Check if the username already exists (excluding current patient)
        $sql = "SELECT * FROM users WHERE username = ? AND id != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $username, $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "⚠ Username already exists. Choose a different one.";
        } else {
            // Update patient's username
            $sql = "UPDATE users SET username = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $username, $patient_id);

            if ($stmt->execute()) {
                $success = "✅ Patient updated successfully.";
            } else {
                $error = "❌ Error updating patient: " . $conn->error;
            }
        }
    }
}
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
            color: #333;
            background-color: #fefefe;
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
            padding: 25px;
            max-width: 500px;
            margin: 40px auto;
            background: #FAFAFA;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Heading Styles */
        h2 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 3px solid #4A90E2;
            display: inline-block;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        input {
            padding: 12px;
            font-size: 1.1em;
            border: 1px solid #D0D0D0;
            border-radius: 6px;
            background: #FFF;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #4A90E2;
            outline: none;
        }

        /* Submit Button */
        button {
            background: #4CAF50;
            color: white;
            font-size: 1.1em;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: #43A047;
        }

        /* Messages */
        .success {
            color: #256029;
            background: #E6F9E6;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .error {
            color: #A94442;
            background: #FDEDEC;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 12px;
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
            }

            input, button {
                font-size: 1em;
            }

            .btn {
                font-size: 0.9em;
                padding: 8px 12px;
            }
        }
        footer{
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
        <h2>Edit Patient</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($patient['username']); ?>" required>
            <button type="submit">Update Patient</button>
        </form>
    </main>

</body>
</html>
<footer>
<?php include '../includes/footer.php'; ?>
    </footer>