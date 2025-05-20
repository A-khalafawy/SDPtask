<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #555;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-read {
            color: green;
        }

        .status-unread {
            color: red;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #555;
            background-color: #5c6e82;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #3f4c6b;
            color: white;
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

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            a {
                font-size: 14px;
                padding: 6px 15px;
            }

            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>My Inbox</h1>
        <table>
            <tr>
                <th>Message</th>
                <th>Timestamp</th>
                <th>Status</th>
            </tr>
            <?php foreach ($notifications as $notification): ?>
            <tr>
                <td><?= htmlspecialchars($notification['message']) ?></td>
                <td><?= htmlspecialchars($notification['timestamp']) ?></td>
                <td class="<?= $notification['is_read'] ? 'status-read' : 'status-unread' ?>">
                    <?= $notification['is_read'] ? 'Read' : 'Unread' ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php">Back to Dashboard</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
