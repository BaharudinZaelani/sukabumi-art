
<!-- style -->
<style>
    .wrp {
        margin: 0 !important;
        width: 100% !important;
    }
    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }
    .content {
        min-height: 80vh;
    }
</style>

<!-- content -->
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <!-- logo -->
        <div class="logo">
            <a href="" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="../assets/img/logo-small.png">
                </div>
            </a>
            <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                <?= APP_NAME; ?>
            </a>
        </div>

        <!-- list nav -->
        <?php Views::getComponents("dashboard/listnav", [
            [
                "title" => "Dashboard",
                "icon" => "nc-bank",
                "href" => "/dashboard",
                "is-active" => "active"
            ]
        ]); ?>

    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="javascript:;">
                                <i class="nc-icon nc-layout-11"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="/dashboard/account">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <!-- End Navbar -->
        <div class="content">

        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>