<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary Details</title>
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
            position: relative; /* Added for footer positioning */
        }

        /* Main Container */
        .container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b; /* Neutral tone */
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Paragraph Styles */
        p {
            font-size: 16px;
            color: #5c6e82; /* Muted neutral color */
            margin: 12px 0;
            text-align: left; /* Align text to the left */
        }

        strong {
            color: #3f4c6b;
        }

        /* Button (Back to List) Styling */
        a {
            text-decoration: none;
            color: #fff;
            background-color: #5c6e82;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
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

            p, a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Beneficiary Details</h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($beneficiary['beneficiary_id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($beneficiary['name']) ?></p>
        <p><strong>Need:</strong> <?= htmlspecialchars($beneficiary['need']) ?></p>
        <a href="index.php?controller=beneficiary&action=listBeneficiaries">Back to Beneficiaries List</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
