<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Attendees</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a8c0ff, #3f4c6b);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: left;
        }
        h1 {
            font-size: 28px;
            color: #3f4c6b;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }
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
        a.action {
            text-decoration: none;
            color: #fff;
            background-color: #c44536;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 0;
            display: inline-block;
            transition: background-color 0.3s, transform 0.3s;
        }
        a.action:hover {
            background-color: #a80000;
            transform: scale(1.05);
        }
        a,
        a:not(.action) {
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
        a:not(.action):hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
        }
        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: black;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }
            h1 {
                font-size: 24px;
            }
            a, a.action {
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
        <center><h1>Volunteer Attendees for Event</h1></center>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($volunteers)): ?>
                    <?php foreach ($volunteers as $volunteer): ?>
                        <tr>
                            <td><?= htmlspecialchars($volunteer['name']) ?></td>
                            <td><?= htmlspecialchars($volunteer['contact_info']) ?></td>
                            <td>
                                <?php if (isset($_SESSION['user_id']) && isset($volunteer['user_id']) && $volunteer['user_id'] == $_SESSION['user_id']): ?>
                                    <a class="action" href="index.php?controller=event&action=unregister&event_id=<?= htmlspecialchars($_GET['event_id']) ?>" onclick="return confirm('Are you sure you want to unregister from this event?');">Unregister</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No volunteers have registered for this event yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?controller=event&action=view&id=<?= htmlspecialchars($_GET['event_id']) ?>">Back to Event Details</a>
        <center>
            <a href="index.php?controller=volunteer&action=assignTasks&event_id=<?= htmlspecialchars($_GET['event_id']) ?>">Assign Tasks to Volunteers</a>
        </center>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
