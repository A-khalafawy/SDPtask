<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tasks to Volunteers</title>
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
            margin-top: 20px;
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

        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #5c6e82;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
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

            button, a {
                font-size: 14px;
                padding: 6px 15px;
            }

            select {
                font-size: 14px;
                padding: 8px;
            }

            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Assign Tasks for Event</h1>

        <form action="index.php?controller=volunteer&action=saveAssignedTasks" method="POST">
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($_GET['event_id']) ?>">

            <table>
                <thead>
                    <tr>
                        <th>Volunteer</th>
                        <th>Task</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($volunteers as $volunteer): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($volunteer['name']) ?>
                                <input type="hidden" name="volunteers[]" value="<?= $volunteer['volunteer_id'] ?>">
                            </td>
                            <td>
                                <select name="tasks[<?= $volunteer['volunteer_id'] ?>]">
                                    <option value="">-- Select Task --</option>
                                    <?php foreach ($tasks as $task): ?>
                                        <option value="<?= $task['task_id'] ?>"><?= htmlspecialchars($task['description']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit">Save Assignments</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
