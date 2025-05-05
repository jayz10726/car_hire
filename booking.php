<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $car = trim($_POST["car"] ?? "");
    $date = trim($_POST["date"] ?? "");

    if ($name && $email && $car && $date) {
        $entry = "$name | $email | $car | $date\n";
        file_put_contents("bookings.txt", $entry, FILE_APPEND);
        $success = true;
    } else {
        $success = false;
        $error = "Please fill in all fields.";
    }
} else {
    header("Location: booking.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* Add the Fielder image as background */
            background: url('https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            /* Optional: Add a semi-transparent overlay for better readability */
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(65, 105, 225, 0.5); /* royalblue overlay with transparency */
            z-index: 0;
            pointer-events: none;
        }
        /* Make sure content is above the overlay */
        header, section, footer {
            position: relative;
            z-index: 1;
        }
        .confirmation-box {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            padding: 30px 20px;
            text-align: center;
        }
        .confirmation-box h2 {
            color: #155724;
            margin-bottom: 10px;
        }
        .confirmation-box p {
            color: #333;
        }
        .error {
            color: #b71c1c;
            background: #ffebee;
            border: 1px solid #ffcdd2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .success {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        a.button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: royalblue;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        a.button:hover {
            background: #003399;
        }
    </style>
</head>
<body>
    <div class="confirmation-box">
        <?php if (!empty($success)): ?>
            <div class="success">Booking Successful!</div>
            <h2>Thank you, <?= htmlspecialchars($name) ?>!</h2>
            <p>Your booking for <strong><?= htmlspecialchars($car) ?></strong> on <strong><?= htmlspecialchars($date) ?></strong> has been received.<br>
            We will contact you at <strong><?= htmlspecialchars($email) ?></strong> soon.</p>
        <?php else: ?>
            <div class="error"><?= htmlspecialchars($error ?? "An error occurred.") ?></div>
        <?php endif; ?>
        <a class="button" href="booking.html">Back to Booking</a>
    </div>
</body>
</html> 