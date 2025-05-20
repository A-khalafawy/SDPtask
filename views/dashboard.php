<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Non-Profit Management System</title>
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
        .container.dashboard {
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
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* List Styles */
        ul.list-group {
            list-style-type: none;
            padding: 0;
        }

        .list-group-item {
            background-color: #f4f9fc;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px 15px;
            text-align: left;
        }

        .list-group-item a {
            text-decoration: none;
            color: #5c6e82;
            transition: background-color 0.3s, transform 0.3s;
        }

        .list-group-item a:hover {
            background-color: #5c6e82;
            color: white;
            transform: scale(1.05);
        }

        /* Logout Button */
        .btn-danger {
            background-color: #5c6e82;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-danger:hover {
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
            .container.dashboard {
                padding: 25px;
            }

            h1 {
                font-size: 24px;
            }

            .list-group-item, .btn-danger {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container dashboard">
        <h1>Non-Profit Management System Dashboard</h1>
        <?php if (!empty($links)): ?>
            <ul class="list-group">
                <?php foreach ($links as $link): ?>
                    <li class="list-group-item">
                        <a href="<?= htmlspecialchars($link['url']) ?>">
                            <?= htmlspecialchars($link['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No dashboard items available.</p>
        <?php endif; ?>
        <br>
        <a href="?controller=auth&action=logout" class="btn btn-danger">Logout</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
