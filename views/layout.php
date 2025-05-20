<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Profit Organization</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Header Styles */
        header {
            background-color: #3f4c6b;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
            margin-top: 10px;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background-color 0.3s, transform 0.3s;
        }

        nav ul li a:hover {
            background-color: #5c6e82;
            transform: scale(1.05);
        }

        /* Main Content Styling */
        main {
            padding: 40px 20px;
            max-width: 1000px;
            margin: 20px auto;
        }

        /* Footer Styles */
        footer {
            background-color: #3f4c6b;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            header h1 {
                font-size: 24px;
            }

            nav ul li {
                display: block;
                margin: 10px 0;
            }

            nav ul li a {
                font-size: 14px;
                padding: 8px 12px;
            }

            main {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Non-Profit Organization Management</h1>
        <nav>
            <ul>
                <li><a href="index.php?controller=donor&action=list">Donors</a></li>
                <li><a href="index.php?controller=volunteer&action=list">Volunteers</a></li>
                <li><a href="index.php?controller=event&action=list">Events</a></li>
                <li><a href="index.php?controller=communication&action=list">Communications</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php include($content); ?>
    </main>

    <footer>
        <p>&copy; 2024 Non-Profit Organization. All rights reserved.</p>
    </footer>
</body>
</html>
