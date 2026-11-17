<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Image Switcher</title>
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
            text-align: center;
        }

        h2 {
            color: #003366;
            margin-bottom: 8px;
            font-size: 1.6rem;
        }

        .sub {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .image-container {
            width: 100%;
            height: 220px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0 20px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .image-container svg {
            width: 100%;
            height: 100%;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .desc-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.95rem;
            color: #334155;
            margin-bottom: 20px;
        }

        .control-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            border-top: 1px solid #f1f5f9;
            padding-top: 18px;
        }

        select, button {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.95rem;
            border: 2px solid #cbd5e1;
            outline: none;
        }

        select {
            flex: 1;
        }

        button {
            background-color: #003366;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        button:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Change Image Automatically</h2>
    <p class="sub">PHP Switch Case Implementation</p>

    <?php
    // Automatically determine image based on selected mode or day of week
    $mode = isset($_POST['mode']) ? $_POST['mode'] : 'auto';

    if ($mode === 'auto') {
        // Automatically picks case based on current day of the week
        $key = date('l'); 
    } else {
        $key = $mode;
    }

    $title = "";
    $desc = "";
    $bgColor = "";
    $badgeColor = "";
    $badgeText = "";

    // Switch case to automatically set the image and theme
    switch ($key) {
        case 'Monday':
        case 'Morning':
            $title = "Morning Sunrise";
            $desc = "Rise and shine! Fresh start to the day.";
            $bgColor = "#fef08a";
            $badgeColor = "#ca8a04";
            $badgeText = "Mode: Morning / Monday";
            $svg = '<svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
                <defs><linearGradient id="g1" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#fdba74"/><stop offset="100%" stop-color="#fed7aa"/></linearGradient></defs>
                <rect width="100%" height="100%" fill="url(#g1)"/>
                <circle cx="200" cy="110" r="50" fill="#f59e0b"/>
                <path d="M0,180 Q100,140 200,180 T400,180 L400,220 L0,220 Z" fill="#84cc16"/>
                <text x="200" y="115" font-family="Arial" font-size="18" font-weight="bold" fill="#fff" text-anchor="middle">☀️ MORNING</text>
            </svg>';
            break;

        case 'Tuesday':
        case 'Wednesday':
        case 'Afternoon':
            $title = "Sunny Afternoon";
            $desc = "Bright and sunny sky, peak productivity.";
            $bgColor = "#bae6fd";
            $badgeColor = "#0284c7";
            $badgeText = "Mode: Afternoon";
            $svg = '<svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
                <defs><linearGradient id="g2" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#38bdf8"/><stop offset="100%" stop-color="#bae6fd"/></linearGradient></defs>
                <rect width="100%" height="100%" fill="url(#g2)"/>
                <circle cx="200" cy="70" r="35" fill="#facc15"/>
                <path d="M60,110 Q90,90 120,110 T180,110 A20,20 0 0,1 60,110 Z" fill="#ffffff" opacity="0.9"/>
                <path d="M240,90 Q270,70 300,90 T360,90 A20,20 0 0,1 240,90 Z" fill="#ffffff" opacity="0.8"/>
                <rect y="170" width="400" height="50" fill="#22c55e"/>
                <text x="200" y="195" font-family="Arial" font-size="18" font-weight="bold" fill="#ffffff" text-anchor="middle">🌤️ AFTERNOON</text>
            </svg>';
            break;

        case 'Thursday':
        case 'Friday':
        case 'Sunset':
            $title = "Golden Sunset";
            $desc = "Winding down with warm twilight colors.";
            $bgColor = "#fed7aa";
            $badgeColor = "#ea580c";
            $badgeText = "Mode: Sunset";
            $svg = '<svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
                <defs><linearGradient id="g3" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#f97316"/><stop offset="50%" stop-color="#ec4899"/><stop offset="100%" stop-color="#6366f1"/></linearGradient></defs>
                <rect width="100%" height="100%" fill="url(#g3)"/>
                <circle cx="200" cy="140" r="45" fill="#fef08a"/>
                <rect y="160" width="400" height="60" fill="#1e1b4b" opacity="0.85"/>
                <text x="200" y="200" font-family="Arial" font-size="18" font-weight="bold" fill="#fbcfe8" text-anchor="middle">🌇 SUNSET</text>
            </svg>';
            break;

        case 'Saturday':
        case 'Sunday':
        case 'Night':
        default:
            $title = "Peaceful Night";
            $desc = "Calm night under the moonlight and stars.";
            $bgColor = "#c7d2fe";
            $badgeColor = "#4338ca";
            $badgeText = "Mode: Night";
            $svg = '<svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
                <defs><linearGradient id="g4" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#0f172a"/><stop offset="100%" stop-color="#1e1b4b"/></linearGradient></defs>
                <rect width="100%" height="100%" fill="url(#g4)"/>
                <circle cx="200" cy="90" r="32" fill="#e2e8f0"/>
                <circle cx="212" cy="85" r="28" fill="#0f172a"/>
                <circle cx="80" cy="50" r="2" fill="#ffffff"/>
                <circle cx="120" cy="80" r="1.5" fill="#ffffff"/>
                <circle cx="310" cy="40" r="2" fill="#ffffff"/>
                <circle cx="280" cy="100" r="1.5" fill="#ffffff"/>
                <circle cx="340" cy="90" r="2.5" fill="#ffffff"/>
                <text x="200" y="180" font-family="Arial" font-size="18" font-weight="bold" fill="#e0e7ff" text-anchor="middle">🌙 NIGHT</text>
            </svg>';
            break;
    }
    ?>

    <div class="badge" style="background: <?php echo $bgColor; ?>; color: <?php echo $badgeColor; ?>;">
        <?php echo $badgeText; ?>
    </div>

    <div class="image-container">
        <?php echo $svg; ?>
    </div>

    <div class="desc-box">
        <strong><?php echo $title; ?></strong>: <?php echo $desc; ?>
    </div>

    <form method="POST" action="" class="control-form">
        <select name="mode">
            <option value="auto" <?php echo ($mode === 'auto') ? 'selected' : ''; ?>>Automatic (Current Day: <?php echo date('l'); ?>)</option>
            <option value="Morning" <?php echo ($mode === 'Morning') ? 'selected' : ''; ?>>Case 1: Morning</option>
            <option value="Afternoon" <?php echo ($mode === 'Afternoon') ? 'selected' : ''; ?>>Case 2: Afternoon</option>
            <option value="Sunset" <?php echo ($mode === 'Sunset') ? 'selected' : ''; ?>>Case 3: Sunset</option>
            <option value="Night" <?php echo ($mode === 'Night') ? 'selected' : ''; ?>>Case 4: Night</option>
        </select>
        <button type="submit">Change</button>
    </form>
</div>

</body>
</html>
