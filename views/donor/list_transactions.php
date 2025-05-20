<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transactions</title>
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
            max-width: 900px;
            text-align: left;
            overflow-x: auto;
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #1a2c56;
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1a2c56; /* Dark Blue for header */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #394d7d; /* Slightly lighter blue for even rows */
        }

        tr:hover {
            background-color: #2e3a8c; /* Darker Blue for hover effect */
        }

        /* Actions Button */
        .actions a {
            text-decoration: none;
            color: #fff;
            background-color: #1a2c56; /* Dark Blue background for action buttons */
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .actions a:hover {
            background-color: #122344; /* Darker Blue on hover */
            transform: scale(1.05);
        }

        /* No Data Message */
        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #888;
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
        }
    </style>
</head>
<body>

    <div class="container">
        <center><h1>Manage Transactions</h1> </center>

        <table>
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Donor ID</th>
                    <th>Type</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Event ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($donations)): ?>
                    <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td><?= htmlspecialchars($donation['donation_id']) ?></td>
                        <td><?= htmlspecialchars($donation['donor_id']) ?></td>
                        <td><?= htmlspecialchars($donation['type']) ?></td>
                        <td><?= htmlspecialchars($donation['payment_method'] ?? 'N/A') ?></td>
                        <td>$<?= htmlspecialchars($donation['amount']) ?></td>
                        <td><?= htmlspecialchars($donation['date']) ?></td>
                        <td><?= htmlspecialchars($donation['event_id'] ?? 'N/A') ?></td>
                        <td class="actions">
                            <a href="index.php?controller=payment&action=processRefund&donation_id=<?= $donation['donation_id'] ?>">Refund</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="no-data">No donations found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
