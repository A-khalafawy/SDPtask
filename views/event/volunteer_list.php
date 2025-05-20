<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Events</title>
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

        /* Paragraph */
        p {
            font-size: 16px;
            color: #5c6e82;
            margin: 12px 0;
            text-align: left;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
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

        span {
            color: #ff4d4d; /* Red for "Registration Closed" */
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

            p, a {
                font-size: 14px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <center><h1>Available Events</h1></center>
        <p>Browse the events and register for those you wish to participate in.</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): 
                    $eventObj = new Event($event); // Instantiate Event object to use state behavior
                ?>
                    <tr>
                        <td><?= htmlspecialchars($event['event_id']) ?></td>
                        <td><?= htmlspecialchars($event['name']) ?></td>
                        <td><?= htmlspecialchars($event['date']) ?></td>
                        <td><?= htmlspecialchars($event['location']) ?></td>
                        <td><?= htmlspecialchars($eventObj->viewDetails()) ?></td>
                        <td>
                            <?php if (strpos($eventObj->viewDetails(), 'is open for registration.') !== false): ?>
                                <a href="index.php?controller=event&action=register&event_id=<?= $event['event_id'] ?>"
                                    onclick="return confirm('Are you sure you want to register for this event?')">Register</a>
                            <?php else: ?>
                                <span>Registration Closed</span>
                            <?php endif; ?>
                            <a href="index.php?controller=event&action=unregister&event_id=<?= $event['event_id'] ?>"
                                onclick="return confirm('Are you sure you want to unregister from this event?')">Unregister</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="">Back to Dashboard</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
