<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
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
            max-width: 1000px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 32px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            font-size: 28px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .button {
            display: inline-block;
            background-color: #5d8aa8;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #99c2ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Donor Details</h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($donor['donor_id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($donor['name']) ?></p>
        <p><strong>Contact Info:</strong> <?= htmlspecialchars($donor['contact_info']) ?></p>

        <h2>Transaction History</h2>
        <table>
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date Issued</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['donation_id']) ?></td>
                        <td><?= htmlspecialchars($transaction['type']) ?></td>
                        <td><?= htmlspecialchars($transaction['amount']) ?></td>
                        <td><?= htmlspecialchars($transaction['date_issued']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php?controller=admin&action=listDonations" class="button">Back to Donations</a>
    </div>
</body>
</html>
