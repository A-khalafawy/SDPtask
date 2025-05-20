<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donation</title>
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

        /* Label and Input */
        label {
            font-size: 16px;
            color: #5c6e82;
            margin-bottom: 8px;
            display: inline-block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            background-color: #5c6e82;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            border: none;
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

            label, input, select, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <center><h1 >Add Donation</h1></center>
        <form method="POST" action="index.php?controller=donor&action=addDonation">
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($_GET['eventId'] ?? '') ?>">

            <label for="type">Type:</label>
            <select name="type" id="type" required onchange="togglePaymentFields(this.value)">
                <option value="">Select Type</option>
                <option value="money">Money</option>
                <option value="blood">Blood</option>
            </select><br>

            <!-- Payment Fields -->
            <div id="payment-fields" style="display: none;">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" onchange="toggleSpecificPaymentFields(this.value)" required>
                    <option value="">Select Method</option>
                    <option value="ewallet">EWallet</option>
                    <option value="bankcard">Bank Card</option>
                </select><br>

                <!-- EWallet Fields -->
                <div id="ewallet-fields" style="display: none;">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email"><br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password"><br>
                </div>

                <!-- Bank Card Fields -->
                <div id="bankcard-fields" style="display: none;">
                    <label for="card_number">Card Number:</label>
                    <input type="text" name="card_number" id="card_number"><br>
                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" id="cvv"><br>
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="date" name="expiry_date" id="expiry_date"><br>
                </div>

                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" step="0.01"><br>
            </div>

            <button type="submit">Donate</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Your Organization</p>
    </div>

    <script>
        function togglePaymentFields(type) {
            document.getElementById('payment-fields').style.display = type === 'money' ? 'block' : 'none';
        }
        function toggleSpecificPaymentFields(method) {
            document.getElementById('ewallet-fields').style.display = method === 'ewallet' ? 'block' : 'none';
            document.getElementById('bankcard-fields').style.display = method === 'bankcard' ? 'block' : 'none';
        }
    </script>

</body>
</html>
