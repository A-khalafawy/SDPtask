<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
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
       <center><h1>Event Details</h1></center> 
        
        <?php if ($event): 
            $eventObj = new Event($event); // Instantiate Event object to leverage state
        ?>
            <p><strong>ID:</strong> <?= htmlspecialchars($event['event_id']) ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($event['name']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($event['date']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            <p><strong>Capacity:</strong> <?= htmlspecialchars($event['capacity']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($eventObj->viewDetails()) ?></p>
        <?php else: ?>
            <p>Event not found.</p>
        <?php endif; ?>
<center><div>
        <a href="index.php?controller=event&action=list">Back to Events List</a>
        <?php if ($event): ?>
            <a href="index.php?controller=event&action=listVolunteers&event_id=<?= htmlspecialchars($event['event_id']) ?>">View Volunteer Attendees</a>
            <a href="index.php?controller=admin&action=viewReport&event_id=<?= htmlspecialchars($event['event_id']) ?>">View Report</a>
        <?php endif; ?>
        </div></center>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
