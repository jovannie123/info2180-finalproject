<?php
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    $dashboard_url = $uri . '/dashboard/';
    header('Location: ' . $dashboard_url);
    exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Dashboard</title>
    <style>
        body {
            font-size: 16px;
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            margin: 0;
            padding: 0;
            background-color: #cccccc;
        }

        .container2 {
            display: grid;
            grid-template-columns: 15fr 75fr;
            grid-template-rows: 8vh 15vh 77vh;
        }

        header {
            grid-column: 1/3;
            grid-row: 1/2;
            background-color: #062053;
            color: white;
            padding: 0;
            margin: 0;
            border-bottom: 2px solid black;
        }

        header h1 {
            font-size: 16px;
            padding-left: 20px;
            padding-top: 20px;
        }

        aside {
            grid-column: 1/2;
            grid-row: 2/4;
            background-color: white;
            border-right: 2px solid black;
        }

        aside a {
            font-size: 16px;
            margin: 20px;
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        aside a:hover {
            color: #3f00ff;
        }

        aside button {
            font-weight: bold;
            font-size: 16px;
            margin-left: 20px;
            background: none;
            border: none;
        }

        aside button:hover {
            color: #3f00ff;
        }

        main {
            grid-column: 2/3;
            grid-row: 2/3;
            background-color: #cccccc;
            padding: 10px 40px 30px 40px;
        }

        .container1 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        main h2 {
            grid-column: 1/2;
            grid-row: 1/2;
            font-weight: bolder;
            font-size: 35px;
        }

        main button {
            grid-column: 2/3;
            grid-row: 1/2;
            background-color: #3f00ff;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            font-weight: bold;
            height: 40px;
            width: 100px;
            align-self: center;
            justify-self: end;
        }

        main button:hover {
            background-color: #806bf8;
        }

        section {
            grid-column: 2/3;
            grid-row: 3/4;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div class="message">
        Redirecting to Dashboard. If not redirected, <a href="<?php echo $dashboard_url; ?>" class="redirect-link">click here</a>.
    </div>
</body>

</html>
