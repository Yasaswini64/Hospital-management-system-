<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include '../config/database.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'patient')");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $message = "<p class='success'>✅ Patient added successfully.</p>";
    } else {
        $message = "<p class='error'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
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
            <a href="../index.php" class="btn">🏠 Home</a>
            <button onclick="history.back()" class="btn back"> Back</button>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <h2>Add New Patient</h2>
        <?= $message; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Add Patient</button>
        </form>
    </main>

</body>
</html>

<footer>
    <?php include '../includes/footer.php'; ?>
</footer>