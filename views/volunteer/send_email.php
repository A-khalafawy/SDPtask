<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email to Volunteer</title>
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
            text-align: left;
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Form Styling */
        label {
            font-weight: bold;
            color: #3f4c6b;
            margin-top: 10px;
            display: block;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #5c6e82;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
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

            input[type="text"], textarea, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <Center><h1>Send Email to Volunteer</h1> </Center>
        <form method="POST" action="index.php?controller=admin&action=sendEmailToVolunteer&id=<?= htmlspecialchars($_GET['id']) ?>">
            <label>Subject:</label>
            <input type="text" name="subject" required><br>
            <label>Body:</label>
            <textarea name="body" required></textarea><br>
           <center> <button type="submit">Send Email</button> </center>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
