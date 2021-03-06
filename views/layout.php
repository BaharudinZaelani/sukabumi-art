<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>

    <!-- style -->
    <link rel="stylesheet" href="<?= Views::assets("css/style.css"); ?>">

    <!-- fonts and icon -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="<?= Views::assets("css/bootstrap.min.css"); ?>" rel="stylesheet" />
    <link href="<?= Views::assets("css/paper-dashboard.css?v=2.0.1"); ?>" rel="stylesheet" />

</head>
<body>
    <div class="container-fluid">
        <!-- tidak mengerti ? jangan ubah ini ! -->
        <?php foreach( Views::getContentBody() as $row ) : ?>
            <?php include $row;?>
        <?php endforeach; ?>
    </div>

    <div class="notif">
        <?php Views::getComponents("alert-with-session")?>
    </div>

    <script src="<?= Views::assets("js/app.js"); ?>"></script>
    <!--   Core JS Files   -->
    <script src="<?= Views::assets("js/core/jquery.min.js"); ?>"></script>
    <script src="<?= Views::assets("js/core/popper.min.js"); ?>"></script>
    <script src="<?= Views::assets("js/core/bootstrap.min.js"); ?>"></script>
    <script src="<?= Views::assets("js/plugins/perfect-scrollbar.jquery.min.js"); ?>"></script>
    <!-- Chart JS -->
    <script src="<?= Views::assets("js/plugins/chartjs.min.js"); ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= Views::assets("js/plugins/bootstrap-notify.js"); ?>"></script>
    
</body>
</html>