<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a8c0ff, #3f4c6b); /* Soft, neutral gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        /* Main Container */
        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease-in-out;
        }

        .register-container:hover {
            transform: translateY(-10px);
        }

        /* Heading */
        h1 {
            font-size: 28px;
            color: #3f4c6b; /* Neutral tone */
            text-align: center;
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
        }

        /* Input Styles */
        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 2px solid #3f4c6b;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f4f9fc; /* Soft, neutral background */
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #5c6e82;
            box-shadow: 0 0 10px rgba(92, 110, 130, 0.3);
            outline: none;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 14px;
            background-color: #5c6e82; /* Neutral tone */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: block;
            margin: 0 auto;
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

        /* Link Styles */
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3f4c6b;
            font-weight: 600;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #5c6e82;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .register-container {
                padding: 25px;
            }

            h1 {
                font-size: 24px;
            }

            input, select, button {
                font-size: 14px;
            }
        }
    </style>

    <script>
        // Dynamically show/hide the contact_info field based on the selected role
        function toggleRoleFields() {
            const role = document.querySelector('select[name="role"]').value;
            const contactInfoField = document.getElementById('contact-info-field');

            // Show contact info for Donor and Volunteer roles, hide for Admin
            contactInfoField.style.display = (role === 'Donor' || role === 'Volunteer') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?controller=auth&action=register">
            <label>Username:</label>
            <input type="text" name="username" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <label>Role:</label>
            <select name="role" onchange="toggleRoleFields()" required>
                <option value="">Select Role</option>
                <option value="Admin">Admin</option>
                <option value="Donor">Donor</option>
                <option value="Volunteer">Volunteer</option>
            </select><br>

            <!-- Contact Info Field -->
            <div id="contact-info-field" style="display: none;">
                <label>Contact Info:</label>
                <input type="text" name="contact_info" id="contact_info"
                       value="<?php echo htmlspecialchars($_POST['contact_info'] ?? ''); ?>"><br>
            </div>

            <button type="submit">Register</button>
        </form>

        <a href="index.php?controller=auth&action=login">Back to Login</a>
    </div>
</body>
</html>
