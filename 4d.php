<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator (Without Built-in Functions)</title>
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
            margin-bottom: 6px;
            font-size: 1.6rem;
        }

        .sub {
            color: #64748b;
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .form-section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .date-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="number"]:focus {
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
            margin-top: 6px;
        }

        .btn-calc:hover {
            background-color: #002244;
        }

        .result-container {
            margin-top: 25px;
            border-top: 2px solid #f1f5f9;
            padding-top: 20px;
            text-align: center;
        }

        .age-badge {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 16px;
            margin-top: 10px;
        }

        .age-numbers {
            font-size: 1.45rem;
            font-weight: 800;
            color: #1d4ed8;
            margin-bottom: 4px;
        }

        .age-detail {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .error-msg {
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Calculate Current Age</h2>
    <p class="sub">Manual Arithmetic (No pre-defined date diff functions)</p>

    <?php
    // Get current date as default
    $curDay = (int)date('d');
    $curMonth = (int)date('m');
    $curYear = (int)date('Y');

    // Values to maintain in form
    $bDay = isset($_POST['b_day']) ? $_POST['b_day'] : '';
    $bMonth = isset($_POST['b_month']) ? $_POST['b_month'] : '';
    $bYear = isset($_POST['b_year']) ? $_POST['b_year'] : '';
    ?>

    <form method="POST" action="">
        <div class="form-section-title">🎂 Date of Birth:</div>
        <div class="date-grid">
            <div>
                <label>Day (1-31):</label>
                <input type="number" name="b_day" min="1" max="31" placeholder="DD" value="<?php echo htmlspecialchars($bDay); ?>" required>
            </div>
            <div>
                <label>Month (1-12):</label>
                <input type="number" name="b_month" min="1" max="12" placeholder="MM" value="<?php echo htmlspecialchars($bMonth); ?>" required>
            </div>
            <div>
                <label>Year:</label>
                <input type="number" name="b_year" min="1900" max="<?php echo $curYear; ?>" placeholder="YYYY" value="<?php echo htmlspecialchars($bYear); ?>" required>
            </div>
        </div>

        <div class="form-section-title">📅 Current Date:</div>
        <div class="date-grid">
            <div>
                <label>Day:</label>
                <input type="number" name="c_day" min="1" max="31" value="<?php echo isset($_POST['c_day']) ? htmlspecialchars($_POST['c_day']) : $curDay; ?>" required>
            </div>
            <div>
                <label>Month:</label>
                <input type="number" name="c_month" min="1" max="12" value="<?php echo isset($_POST['c_month']) ? htmlspecialchars($_POST['c_month']) : $curMonth; ?>" required>
            </div>
            <div>
                <label>Year:</label>
                <input type="number" name="c_year" min="1900" max="2100" value="<?php echo isset($_POST['c_year']) ? htmlspecialchars($_POST['c_year']) : $curYear; ?>" required>
            </div>
        </div>

        <button type="submit" name="calculate_age" class="btn-calc">Calculate Age</button>
    </form>

    <?php
    if (isset($_POST['calculate_age'])) {
        $bd = (int)$_POST['b_day'];
        $bm = (int)$_POST['b_month'];
        $by = (int)$_POST['b_year'];

        $cd = (int)$_POST['c_day'];
        $cm = (int)$_POST['c_month'];
        $cy = (int)$_POST['c_year'];

        // Validation: Birth date cannot be in the future
        if ($by > $cy || ($by == $cy && $bm > $cm) || ($by == $cy && $bm == $cm && $bd > $cd)) {
            echo "<div class='error-msg'>Birth date cannot be greater than current date!</div>";
        } else {
            // Days in each month (January to December)
            $monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            // Manual leap year check: divisible by 4, not 100 unless divisible by 400
            function checkLeap($y) {
                return (($y % 4 == 0 && $y % 100 != 0) || ($y % 400 == 0));
            }

            // If current day < birth day, borrow days from previous month
            if ($cd < $bd) {
                $prevMonth = $cm - 1;
                $prevYear = $cy;
                if ($prevMonth == 0) {
                    $prevMonth = 12;
                    $prevYear--;
                }

                // Check February leap year for borrowed month
                $borrowDays = ($prevMonth == 2 && checkLeap($prevYear)) ? 29 : $monthDays[$prevMonth - 1];

                $cd += $borrowDays;
                $cm -= 1;
            }

            // If current month < birth month, borrow 12 months from current year
            if ($cm < $bm) {
                $cy -= 1;
                $cm += 12;
            }

            // Calculate exact difference without any date diff library
            $finalDays = $cd - $bd;
            $finalMonths = $cm - $bm;
            $finalYears = $cy - $by;

            echo "<div class='result-container'>";
            echo "<div class='age-badge'>";
            echo "<div class='age-numbers'>$finalYears Years, $finalMonths Months, $finalDays Days</div>";
            echo "<div class='age-detail'>Calculated using manual borrow arithmetic</div>";
            echo "</div>";
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>
