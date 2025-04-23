<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient | AN Clinic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Book Appointment</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <textarea name="reason" placeholder="Reason for Appointment" required></textarea><br>
        <button type="submit" name="submit">Book</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $reason = $_POST['reason'];

        $stmt = $db->prepare("INSERT INTO appointments (patient_name, reason) VALUES (?, ?)");
        $stmt->execute([$name, $reason]);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'yourclinicemail@gmail.com';  // Replace this
            $mail->Password   = 'your-app-password';           // Replace this
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('yourclinicemail@gmail.com', 'Clinic Booking');
            $mail->addAddress('money58322@gmail.com');
            $mail->Subject = "New Appointment from $name";
            $mail->Body    = "Name: $name\nReason: $reason";

            $mail->send();
            echo "<p><strong>Appointment booked and sent to clinic email!</strong></p>";
        } catch (Exception $e) {
            echo "<p>Error sending email: {$mail->ErrorInfo}</p>";
        }
    }
    ?>

    <h2>Your Appointments</h2>
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
