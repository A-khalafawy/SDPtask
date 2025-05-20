<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Attendees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #c9d6ff, #e2e2e2);
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #5d8aa8;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        thead {
            background-color: #5d8aa8;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        th {
            font-weight: bold;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px auto;
            width: fit-content;
            padding: 10px 15px;
            background-color: #5d8aa8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #487693;
        }
    </style>
</head>
<body>
    <h1>Attendees for Event ID: <?= htmlspecialchars($eventId) ?></h1>
    <table>
        <thead>
            <tr>
                <th>Attendee ID</th>
                <th>Ticket Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendees as $attendee): ?>
                <tr>
                    <td><?= htmlspecialchars($attendee['attendee_id']) ?></td>
                    <td><?= $attendee['ticket_status'] ? 'Confirmed' : 'Pending' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?controller=event&action=list">Back to Events</a>
</body>
</html>
