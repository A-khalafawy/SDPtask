<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Communication</title>
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
            max-width: 600px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 120px;
            resize: none;
        }

        button {
            background-color: #5d8aa8;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #4b7c8a;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
        }

        a:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Communication</h2>
        <form action="index.php?controller=communication&action=update&id=<?php echo htmlspecialchars($communication['communication_id']); ?>" method="POST">
            <label for="message">Message:</label>
            <textarea name="message" id="message" required><?php echo htmlspecialchars($communication['message']); ?></textarea><br>

            <label for="type">Type:</label>
            <input type="text" name="type" id="type" value="<?php echo htmlspecialchars($communication['type']); ?>" required><br>

            <label for="recipient">Recipient:</label>
            <input type="text" name="recipient" id="recipient" value="<?php echo htmlspecialchars($communication['recipient']); ?>" required><br>

            <button type="submit">Update Communication</button>
        </form>
        <a href="index.php?controller=communication&action=list">Back to Communications</a>
    </div>
</body>
</html>
