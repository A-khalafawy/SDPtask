<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Donor</title>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a8c0ff, #3f4c6b); /* Soft, neutral gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        /* Main Container */
        .container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b; /* Neutral tone */
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Form Label and Input */
        label {
            font-size: 16px;
            color: #5c6e82;
            text-align: left;
            margin-bottom: 8px;
            display: inline-block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            background-color: #5c6e82;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
        }

        /* Footer Styles */
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
                padding: 25px;
            }

            h1 {
                font-size: 24px;
            }

            label, input, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Add New Donor</h1>
        <form method="post" action="/donor/add">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="contact_info">Contact Info:</label>
            <input type="text" name="contact_info" id="contact_info" required>
            <br>
            <button type="submit">Add Donor</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
