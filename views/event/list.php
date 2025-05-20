<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
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

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #5c6e82;
            color: #fff;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

        /* Button Styling */
        a {
            text-decoration: none;
            color: #fff;
            background-color: #5c6e82;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 16px;
            margin-right: 10px;
            display: inline-block;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
        }

        /* Space after button */
        .add-event-btn {
            margin-bottom: 20px; /* Add space below the button */
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

            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <center><h1>Events</h1></center>
        <center>
            <a href="index.php?controller=event&action=add" class="btn btn-primary add-event-btn">Add New Event</a>
        </center>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['event_id']) ?></td>
                    <td><?= htmlspecialchars($event['name']) ?></td>
                    <td><?= htmlspecialchars($event['date']) ?></td>
                    <td><?= htmlspecialchars($event['location']) ?></td>
                    <td>
                        <a href="index.php?controller=event&action=view&id=<?= urlencode($event['event_id']) ?>">View</a>
                        <a href="index.php?controller=event&action=edit&id=<?= urlencode($event['event_id']) ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
