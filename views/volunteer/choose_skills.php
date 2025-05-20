<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Skills</title>
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
            max-width: 600px;
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

        /* Skill Checkbox Styling */
        div {
            margin-bottom: 10px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        label {
            font-size: 16px;
            color: #3f4c6b;
        }

        /* Button Styling */
        button {
            background-color: #5c6e82;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
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

            label {
                font-size: 14px;
            }

            input[type="checkbox"], button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
       <center> <h1>Choose Your Skills</h1> </center>
        <form method="POST" action="index.php?controller=volunteer&action=assignSkills">
            <?php foreach ($skills as $skill): ?>
                <div>
                    <input type="checkbox" name="skills[]" value="<?= $skill['skill_id'] ?>" 
                    <?= in_array($skill['skill_id'], $volunteerSkills) ? 'checked' : '' ?>>
                    <label><?= htmlspecialchars($skill['skill_name']) ?></label>
                </div>
            <?php endforeach; ?>
          <center>  <button type="submit">Save Skills</button> </center>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

</body>
</html>
