<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send New Communication</title>
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

        h1 {
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

        input[type="text"], select, textarea {
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

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Send New Communication</h1>
        <form method="post" action="/communication/add">
            <div class="form-group">
                <label>Message:</label>
                <textarea name="message" required></textarea>
            </div>
            <div class="form-group">
                <label>Type:</label>
                <select name="type" required>
                    <option value="email">Email</option>
                    <option value="sms">SMS</option>
                    <option value="social_media">Social Media</option>
                </select>
            </div>
            <div class="form-group">
                <label>Recipient:</label>
                <input type="text" name="recipient" required>
            </div>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
