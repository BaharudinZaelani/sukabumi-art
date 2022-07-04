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
        <?php Views::getComponents("dashboard/logo"); ?>

        <!-- list nav -->
        <?php Views::getComponents("dashboard/listnav", [
            [
                "title" => "Dashboard",
                "icon" => "nc-bank",
                "href" => "/dashboard",
                "is-active" => ""
            ],
            [
                "title" => "Account List",
                "icon" => "nc-single-02",
                "href" => "/dashboard/accountlist",
                "is-active" => ""
            ], 
            [
                "title" => "Groups",
                "icon" => "nc-box-2",
                "href" => "/dashboard/groups",
                "is-active" => ""
            ],
            [
                "title" => "Files",
                "icon" => "nc-paper",
                "href" => "/dashboard/files",
                "is-active" => "active"
            ],
            [
                "title" => "Logout",
                "icon" => "nc-minimal-left",
                "href" => "/dashboard/logout",
                "is-active" => ""
            ]
        ]); ?>

    </div>

    <div class="main-panel">
        <!-- Navbar -->
        <?php Views::getComponents("dashboard/navbar"); ?>

        <!-- End Navbar -->
        <div class="content">
            <div class="card-body">
                <form method="post">
                    <button class="btn btn-outline-success">Add Files</button>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>