<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary List</title>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a8c0ff, #3f4c6b); /* Soft, neutral gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* For stacking the container and footer */
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
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b; /* Neutral tone */
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3f4c6b;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f4f9fc;
        }

        /* Action Link Styles */
        a {
            text-decoration: none;
            color: #5c6e82;
            padding: 8px 12px;
            margin-right: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        a:hover {
            background-color: #5c6e82;
            color: white;
            transform: scale(1.05);
        }

        /* Add New Beneficiary Button */
        .add-button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #5c6e82;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .add-button:hover {
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

            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Beneficiaries</h1>
        <a href="index.php?controller=beneficiary&action=add" class="add-button">Add New Beneficiary</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Need</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($beneficiaries as $beneficiary): ?>
                <tr>
                    <td><?= htmlspecialchars($beneficiary['beneficiary_id']) ?></td>
                    <td><?= htmlspecialchars($beneficiary['name']) ?></td>
                    <td><?= htmlspecialchars($beneficiary['need']) ?></td>
                    <td>
                        <a href="?controller=beneficiary&action=view&id=<?= $beneficiary['beneficiary_id'] ?>">View</a>
                        <a href="?controller=beneficiary&action=edit&id=<?= $beneficiary['beneficiary_id'] ?>">Edit</a>
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
