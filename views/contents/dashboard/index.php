
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
        min-height: 75vh;
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
                "is-active" => "active"
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
                "is-active" => ""
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
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-circle-10 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">User Active</p>
                                        <p class="card-title"><?= Views::$dataSend['account']?><p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh"></i>
                                Update Now
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-chart-pie-36 text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Free Storage</p>
                                        <small><?= Views::$dataSend['storage']; ?><small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h3 class="card-title">Query to Database</h3>
                            <h5>Only for <code>dev</code> role, jangan gunakan fitur ini jika tidak mengerti !!! Karena fitur ini langsung attach ke database !!! <b>INGAT LUURDDD</b></h5>
                        </div>

                        <div class="card-body ">
                            <form method="post">
                                <div class="form-group mb-3">
                                    <textarea type="text" name="query" style="width: 100% !important; height: 30vh; padding: 5px !important;"></textarea>
                                </div>

                                <div class="input-radio">
                                    <div class="flex">
                                        <input name="fetch" type="checkbox" id="withGetAll">
                                        <div>
                                            <label for="withGetAll">With Fetch Assoc (Array)</label>
                                        </div>
                                    </div>
                                </div>

                                <button <?= ( Middleware::$user['role'] !== "dev" ) ? "disabled" : ""?> name="sendQ" class="btn btn-success">SEND</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- result -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                if ( isset($_POST['sendQ']) ) {
                                    // check if user as role dev
                                    if ( Middleware::$user['role'] == "dev" ) {    
                                        if ( isset($_POST['fetch']) AND $_POST['fetch'] == "on" ) {
                                            $res = Database::fetch($_POST['query']);
                                        }else {
                                            $res = Database::query($_POST['query']);
                                        }
                                    }else {
                                        $res = "kamu bukan baharDev >:( !";
                                    }

                                    var_dump($res);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>