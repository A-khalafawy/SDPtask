<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communication List</title>
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
            max-width: 800px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #555;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #5d8aa8;
            font-size: 16px;
        }

        a:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Communications</h1>
        <a href="/communication/add">Send New Communication</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Type</th>
                <th>Recipient</th>
                <th>Date Sent</th>
            </tr>
            <?php foreach ($communications as $communication): ?>
            <tr>
                <td><?= htmlspecialchars($communication['communication_id']) ?></td>
                <td><?= htmlspecialchars($communication['message']) ?></td>
                <td><?= htmlspecialchars($communication['type']) ?></td>
                <td><?= htmlspecialchars($communication['recipient']) ?></td>
                <td><?= htmlspecialchars($communication['date_sent']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
