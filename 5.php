<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration to Database</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 16px;
            padding: 35px 30px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 10px 25px rgba(0, 51, 102, 0.12);
        }

        h2 {
            color: #003366;
            text-align: center;
            margin-bottom: 8px;
            font-size: 1.6rem;
        }

        .sub {
            color: #64748b;
            text-align: center;
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #334155;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus, textarea:focus {
            border-color: #003366;
        }

        .gender-options {
            display: flex;
            gap: 20px;
            padding: 4px 0;
        }

        .gender-options label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: normal;
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #002244;
        }

        .msg-success {
            background: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .msg-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .summary-title {
            font-weight: 700;
            color: #003366;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .summary-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-box td {
            padding: 6px 4px;
            font-size: 0.9rem;
        }

        .summary-box td:first-child {
            font-weight: 600;
            color: #475569;
            width: 35%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Registration Form</h2>
    <p class="sub">Stores Registration Details into MySQL Database</p>

    <?php
    $message = "";
    $msgType = "";
    $savedRecord = null;

    if (isset($_POST['register'])) {
        $name    = trim($_POST['name']);
        $email   = trim($_POST['email']);
        $phone   = trim($_POST['phone']);
        $gender  = isset($_POST['gender']) ? $_POST['gender'] : '';
        $dob     = trim($_POST['dob']);
        $address = trim($_POST['address']);
        $pass    = $_POST['password'];

        // Database Configuration
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbName = "wt_lab";

        // Connect to MySQL server
        $conn = @new mysqli($dbHost, $dbUser, $dbPass);

        if ($conn->connect_error) {
            $msgType = "error";
            $message = "Database connection failed: " . $conn->connect_error . " (Make sure Apache/MySQL is running in XAMPP)";
        } else {
            // Auto-create database if not exists
            $conn->query("CREATE DATABASE IF NOT EXISTS $dbName");
            $conn->select_db($dbName);

            // Auto-create students table if not exists
            $createTableSql = "CREATE TABLE IF NOT EXISTS students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                gender VARCHAR(10) NOT NULL,
                dob DATE NOT NULL,
                address TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $conn->query($createTableSql);

            // Insert using prepared statements for safety
            $stmt = $conn->prepare("INSERT INTO students (name, email, phone, gender, dob, address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $phone, $gender, $dob, $address);

            if ($stmt->execute()) {
                $msgType = "success";
                $message = "Registration successful! Record uploaded to database '$dbName' with ID #" . $stmt->insert_id;
                $savedRecord = [
                    'id'      => $stmt->insert_id,
                    'name'    => $name,
                    'email'   => $email,
                    'phone'   => $phone,
                    'gender'  => $gender,
                    'dob'     => $dob,
                    'address' => $address
                ];
            } else {
                $msgType = "error";
                $message = "Error inserting record: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
    ?>

    <?php if ($message): ?>
        <div class="<?php echo ($msgType == 'success') ? 'msg-success' : 'msg-error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter student name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="student@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" placeholder="10-digit mobile number" required>
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <div class="gender-options">
                <label><input type="radio" name="gender" value="Male" required> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
                <label><input type="radio" name="gender" value="Other"> Other</label>
            </div>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="3" placeholder="Enter street address, city, state" required></textarea>
        </div>

        <button type="submit" name="register" class="btn-submit">Submit Registration</button>
    </form>

    <?php if ($savedRecord): ?>
        <div class="summary-box">
            <div class="summary-title">Stored Database Record Details:</div>
            <table>
                <tr><td>Registration ID:</td><td>#<?php echo $savedRecord['id']; ?></td></tr>
                <tr><td>Name:</td><td><?php echo htmlspecialchars($savedRecord['name']); ?></td></tr>
                <tr><td>Email:</td><td><?php echo htmlspecialchars($savedRecord['email']); ?></td></tr>
                <tr><td>Phone:</td><td><?php echo htmlspecialchars($savedRecord['phone']); ?></td></tr>
                <tr><td>Gender:</td><td><?php echo htmlspecialchars($savedRecord['gender']); ?></td></tr>
                <tr><td>Date of Birth:</td><td><?php echo htmlspecialchars($savedRecord['dob']); ?></td></tr>
                <tr><td>Address:</td><td><?php echo htmlspecialchars($savedRecord['address']); ?></td></tr>
            </table>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
