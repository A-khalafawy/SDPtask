<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
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

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        label, select, button {
            font-size: 16px;
            margin: 0 10px;
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
        <h1>Donations</h1>

        <!-- Sorting Form -->
        <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="listDonations">
            <label for="sort_by">Sort By:</label>
            <select name="sort_by" id="sort_by">
                <option value="donation_id">Donation ID</option>
                <option value="type">Type</option>
                <option value="donor_id">Donor ID</option>
                <option value="amount">Amount</option>
                <option value="date">Date</option>
            </select>
            <select name="order">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <button type="submit">Sort</button>
        </form>

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

        <!-- Link to Download Report -->
        <a href="index.php?controller=admin&action=generateReport" class="button">Download Donations Report</a>
    </div>
</body>

</html>
