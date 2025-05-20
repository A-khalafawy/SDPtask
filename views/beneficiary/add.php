<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Beneficiary</title>
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
            max-width: 500px;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-10px);
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b; /* Neutral tone */
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Label Styles */
        label {
            font-size: 14px;
            color: #5c6e82; /* Slightly muted neutral color */
            margin-bottom: 5px;
            display: block;
            font-weight: 600;
            text-align: left; /* Align labels to the left inside the form */
            margin-left: 5%; /* Move the labels a bit to the right */
        }

        /* Input Styles */
        input {
            width: 90%; /* Adjusted width to make the textboxes shorter */
            padding: 12px;
            margin-bottom: 18px;
            border: 2px solid #3f4c6b;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f4f9fc; /* Soft, neutral background */
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #5c6e82;
            box-shadow: 0 0 10px rgba(92, 110, 130, 0.3);
            outline: none;
        }

        /* Button Styles */
        button {
            width: 90%; /* Matches input field width for consistency */
            padding: 14px;
            background-color: #5c6e82; /* Neutral tone */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #3f4c6b;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

            input, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Add New Beneficiary</h1>
        <form method="post" action="index.php?controller=beneficiary&action=addBeneficiary">
            <div class="form-group">
                <label for="name">Beneficiary Name:</label>
                <input type="text" name="name" id="name" required placeholder="Enter the beneficiary's name">
            </div>

            <div class="form-group">
                <label for="need">Need/Requirement:</label>
                <input type="text" name="need" id="need" required placeholder="Describe the need/requirement">
            </div>

            <button type="submit">Add Beneficiary</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
