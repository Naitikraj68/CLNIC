<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor | AN Clinic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Doctor Panel</h1>
    <h2>All Appointments</h2>
    <table>
        <tr><th>Name</th><th>Reason</th></tr>
        <?php
        $rows = $db->query("SELECT * FROM appointments ORDER BY id DESC");
        foreach ($rows as $row) {
            echo "<tr><td>{$row['patient_name']}</td><td>{$row['reason']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>
