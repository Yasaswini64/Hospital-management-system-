<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include '../config/database.php';


// Fetch doctors from the database
$sql = "SELECT * FROM users WHERE role = 'doctor'";
$result = $conn->query($sql);
?>

<style>
    body {
        background-color: #f4f6f9;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 900px;
        margin: 30px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #007bff;
        color: white;
        padding: 15px;
        border-radius: 8px 8px 0 0;
    }
    .header h1 {
        margin: 0;
    }
    .header a {
        padding: 8px 12px;
        background: white;
        color: #007bff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    h2 {
        margin-top: 20px;
        font-size: 22px;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        margin-top: 10px;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    th {
        background: #007bff;
        color: white;
    }
    tr:nth-child(even) {
        background: #f2f2f2;
    }
    .btn {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .footer {
        color: black;
        text-align: center;
        padding: 10px;
        margin-top: 20px;
        border-radius: 0 0 8px 8px;
    }
    .btn-edit { background: #ffc107; color: black; }
    .btn-delete { background: #dc3545; color: white; }
    .btn-add { background: #28a745; color: white; display: inline-block; margin-top: 10px; }
</style>

<div class="container">
    <div class="header">
        <h1>Hospital Analytics System</h1>
        <div>
            <a href="../login.php">Home</a>
            <a href="dashboard.php">Back</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>
    
    <h2>Manage Doctors</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td>
                <a href="edit-doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="delete-doctor.php?id=<?php echo $row['id']; ?>" class="btn btn-delete">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="add-doctor.php" class="btn btn-add">Add New Doctor</a>
</div>
<div class="footer">
<?php include '../includes/footer.php'; ?>
        </div>