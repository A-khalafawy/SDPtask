<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Report</title>
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
            max-width: 800px;
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

        /* Paragraphs */
        p {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        /* Button Styling */
        a {
            text-decoration: none;
            color: #fff;
            background-color: #5c6e82;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
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

            a {
                font-size: 14px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
      <center>  <h1>Event Report</h1> </center>
        
        <p><strong>Event Name:</strong> <?= htmlspecialchars($event['name']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($event['date']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
        <p><strong>Total Volunteers:</strong> <?= htmlspecialchars($report['total_volunteers']) ?></p>
        <p><strong>Total Donations:</strong> $<?= htmlspecialchars(number_format($report['total_donations'], 2)) ?></p>

        <a href="index.php?controller=event&action=view&id=<?= htmlspecialchars($event['event_id']) ?>">Back to Event</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
