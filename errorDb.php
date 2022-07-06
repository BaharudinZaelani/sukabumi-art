<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error DB</title>
    <style>
        .center {
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            padding: 12px;
            box-shadow: 0 0 1px black;
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="card">
            <?= $e ?>
        </div>
    </div>
</body>
</html>