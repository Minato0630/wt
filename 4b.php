<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String Case Conversion</title>
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
            max-width: 480px;
            box-shadow: 0 10px 25px rgba(0, 51, 102, 0.12);
        }

        h2 {
            color: #003366;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.6rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
            font-size: 0.95rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            border-color: #003366;
        }

        .btn-convert {
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
        }

        .btn-convert:hover {
            background-color: #002244;
        }

        .results-container {
            margin-top: 25px;
            border-top: 2px solid #f1f5f9;
            padding-top: 20px;
        }

        .result-row {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 12px;
        }

        .result-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }

        .result-val {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
            word-break: break-all;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>String Case Conversion</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label for="str">Enter a String:</label>
            <input type="text" name="str" id="str" placeholder="e.g. Web Technology Lab" value="<?php echo isset($_POST['str']) ? htmlspecialchars($_POST['str']) : ''; ?>" required>
        </div>

        <button type="submit" name="convert" class="btn-convert">Convert String</button>
    </form>

    <?php
    if (isset($_POST['convert'])) {
        $str = $_POST['str'];

        $upper = strtoupper($str);
        $lower = strtolower($str);
        $capital = ucwords(strtolower($str));
        $firstUpper = ucfirst(strtolower($str));

        echo "<div class='results-container'>";
        echo "<div class='result-row'><div class='result-label'>Original String:</div><div class='result-val'>" . htmlspecialchars($str) . "</div></div>";
        echo "<div class='result-row'><div class='result-label'>Uppercase:</div><div class='result-val' style='color:#0284c7;'>" . htmlspecialchars($upper) . "</div></div>";
        echo "<div class='result-row'><div class='result-label'>Lowercase:</div><div class='result-val' style='color:#16a34a;'>" . htmlspecialchars($lower) . "</div></div>";
        echo "<div class='result-row'><div class='result-label'>Capital Case (Title Case):</div><div class='result-val' style='color:#9333ea;'>" . htmlspecialchars($capital) . "</div></div>";
        echo "<div class='result-row'><div class='result-label'>First Letter Uppercase:</div><div class='result-val' style='color:#ea580c;'>" . htmlspecialchars($firstUpper) . "</div></div>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
