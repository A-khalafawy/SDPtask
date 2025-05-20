<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            background-color: #3f4c6b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #5c6e82;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Send Message</h1>
        <form method="POST" action="index.php?controller=communication&action=sendMessage">
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="email">Email</option>
                <option value="sms">SMS</option>
                <option value="social_media">Social Media</option>
            </select>
            <br>

            <label for="recipient">Recipient:</label>
            <input type="text" name="recipient" id="recipient" required>
            <br>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea>
            <br>

            <button type="submit">Send</button>
        </form>
    </div>

</body>
</html>
