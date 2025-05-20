<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Donations</title>
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
        }

        /* Heading */
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
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #5c6e82;
            color: white;
        }

        table td {
            background-color: #f9f9f9;
        }

        /* Button Styling for Download Link */
        a {
            text-decoration: none;
            background-color: #5c6e82;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
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

            table th, table td {
                font-size: 14px;
            }

            a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Your Donations</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($donations)): ?>
                <?php foreach ($donations as $donation): ?>
                <tr>
                    <td><?= htmlspecialchars($donation['donation_id']) ?></td>
                    <td><?= htmlspecialchars($donation['type']) ?></td>
                    <td>$<?= htmlspecialchars($donation['amount']) ?></td>
                    <td><?= htmlspecialchars($donation['date']) ?></td>
                    <td>
                        <a href="index.php?controller=donor&action=downloadReceipt&donationId=<?= $donation['donation_id'] ?>">Download</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No donations found.</td>
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
