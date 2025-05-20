<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Report</title>
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

        h3 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-top: 20px;
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
        <h1>Donation Report</h1>

        <!-- Donations Table -->
        <table>
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Type</th>
                    <th>Donor ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= htmlspecialchars($donation['donation_id']) ?></td>
                        <td><?= htmlspecialchars($donation['type']) ?></td>
                        <td><?= htmlspecialchars($donation['donor_id']) ?></td>
                        <td>$<?= number_format(htmlspecialchars($donation['amount']), 2) ?></td>
                        <td><?= htmlspecialchars($donation['date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total Donations -->
        <h3>Total Donations: $<?= number_format($totalAmount, 2) ?></h3>

        <!-- Back to Donations Link -->
        <a href="index.php?controller=admin&action=listDonations" class="button">Back to Donations</a>
    </div>
</body>
</html>
