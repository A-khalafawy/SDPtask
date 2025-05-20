<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Volunteer</title>
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
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: #5c6e82;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #555;
            background-color: #5c6e82;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #3f4c6b;
            color: white;
            transform: scale(1.05);
        }

        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: black;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }

            button, a {
                font-size: 14px;
                padding: 6px 15px;
            }

            label {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Volunteer</h2>
        <form action="index.php?controller=volunteer&action=update&id=<?php echo htmlspecialchars($volunteer['volunteer_id']); ?>" method="POST">
            <label for="person_id">Person ID:</label>
            <input type="text" name="person_id" id="person_id" value="<?php echo htmlspecialchars($volunteer['person_id']); ?>" required><br>
            
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($volunteer['name']); ?>" required><br>
            
            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" id="contact_info" value="<?php echo htmlspecialchars($volunteer['contact_info']); ?>" required><br>

            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability" id="availability" <?php echo $volunteer['availability'] ? 'checked' : ''; ?>><br>

            <button type="submit">Update Volunteer</button>
        </form>
        <a href="index.php?controller=volunteer&action=list">Back to Volunteers</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
