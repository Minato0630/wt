<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
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
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 35px 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 51, 102, 0.12);
            text-align: center;
        }

        h2 {
            color: #003366;
            margin-bottom: 25px;
            font-size: 1.6rem;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #334155;
            font-size: 0.9rem;
        }

        input[type="number"], select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="number"]:focus, select:focus {
            border-color: #003366;
        }

        .btn-calc {
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

        .btn-calc:hover {
            background-color: #002244;
        }

        .result-box {
            margin-top: 25px;
            padding: 15px;
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            color: #166534;
            font-size: 1.15rem;
            font-weight: bold;
        }

        .error-box {
            margin-top: 25px;
            padding: 15px;
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            color: #991b1b;
            font-size: 1.05rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Simple Calculator</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label for="num1">First Number:</label>
            <input type="number" step="any" name="num1" id="num1" value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="operator">Operator:</label>
            <select name="operator" id="operator" required>
                <?php
                $operators = ['+' => 'Addition (+)', '-' => 'Subtraction (-)', '*' => 'Multiplication (*)', '/' => 'Division (/)', '%' => 'Modulo (%)'];
                $selected = isset($_POST['operator']) ? $_POST['operator'] : '+';
                foreach ($operators as $val => $label) {
                    $sel = ($selected == $val) ? 'selected' : '';
                    echo "<option value='$val' $sel>$label</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="num2">Second Number:</label>
            <input type="number" step="any" name="num2" id="num2" value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>" required>
        </div>

        <button type="submit" name="calculate" class="btn-calc">Calculate</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $op = $_POST['operator'];

        if (is_numeric($num1) && is_numeric($num2)) {
            $isError = false;
            $res = 0;

            switch ($op) {
                case '+':
                    $res = $num1 + $num2;
                    break;
                case '-':
                    $res = $num1 - $num2;
                    break;
                case '*':
                    $res = $num1 * $num2;
                    break;
                case '/':
                    if ($num2 == 0) {
                        $isError = true;
                        $res = "Error: Division by zero!";
                    } else {
                        $res = $num1 / $num2;
                    }
                    break;
                case '%':
                    if ($num2 == 0) {
                        $isError = true;
                        $res = "Error: Modulo by zero!";
                    } else {
                        $res = $num1 % $num2;
                    }
                    break;
                default:
                    $isError = true;
                    $res = "Invalid Operator";
            }

            if ($isError) {
                echo "<div class='error-box'>$res</div>";
            } else {
                echo "<div class='result-box'>Result: $num1 $op $num2 = $res</div>";
            }
        } else {
            echo "<div class='error-box'>Please enter valid numbers!</div>";
        }
    }
    ?>
</div>

</body>
</html>
