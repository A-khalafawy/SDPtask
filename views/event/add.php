<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event</title>
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
        h2 {
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

        input[type="text"], input[type="date"], input[type="number"] {
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

        /* Space after button */
        .submit-btn {
            margin-top: 20px;
        }

        /* Back Button Styling */
        .back-btn {
            text-decoration: none;
            color: white;
            background-color: #5c6e82;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 15px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .back-btn:hover {
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

            h2 {
                font-size: 24px;
            }

            input[type="text"], input[type="date"], input[type="number"], button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <center><h2>Add New Event</h2></center>
        <form action="index.php?controller=event&action=store" method="POST">
            <label for="name">Event Name:</label>
            <input type="text" name="name" id="name" required><br>

            <label for="date">Event Date:</label>
            <input type="date" name="date" id="date" required><br>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required><br>

            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" id="capacity" required><br>

            <center><button type="submit" class="submit-btn">Create Event</button></center>
        </form>
        
        <!-- Enhanced Back Button -->
        <a href="index.php?controller=event&action=list" class="back-btn">Back to Events</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
