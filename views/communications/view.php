<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Communication</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #99c2ff, #5d8aa8);
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 20px 40px;
            max-width: 800px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }

        strong {
            color: #333;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #5d8aa8;
            font-size: 16px;
            text-align: center;
        }

        a:hover {
            color: #333;
        }

        .links {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Communication</h2>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($communication['message']); ?></p>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($communication['type']); ?></p>
        <p><strong>Recipient:</strong> <?php echo htmlspecialchars($communication['recipient']); ?></p>
        <p><strong>Date Sent:</strong> <?php echo htmlspecialchars($communication['date_sent']); ?></p>

        <div class="links">
            <a href="index.php?controller=communication&action=edit&id=<?php echo htmlspecialchars($communication['communication_id']); ?>">Edit</a>
            <a href="index.php?controller=communication&action=list">Back to Communications</a>
        </div>
    </div>
</body>
</html>
