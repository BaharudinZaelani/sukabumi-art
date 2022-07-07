<?php 

// jika tombol BANNED ditekan hapus user yang diBANNED!
if ( isset($_POST['hapus']) ) {
    $idUser = $_POST['idUser'];

    $hapus = Database::destroy("user", $idUser);
    $_SESSION['storage']['hapusAkun'] = $hapus;
    App::redirect("/dashboard/accountlist");
}
?>
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
                "is-active" => ""
            ],
            [
                "title" => "Account List",
                "icon" => "nc-single-02",
                "href" => "/dashboard/accountlist",
                "is-active" => "active"
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Account List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Update</th>
                                        <?php if( Middleware::$user['role'] == "dev" ) : ?>
                                            <th></th>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <form method="post">
                                            <?php foreach( Views::$dataSend['user'] as $row ) : ?>
                                                <tr>
                                                    <td><?= $row['username']?></td>
                                                    <td><?= $row['role']?></td>
                                                    <td><?= $row['email']?></td>
                                                    <td><?= $row['updated_at']?></td>
                                                    <?php if( Middleware::$user['role'] == "dev" ) : ?>
                                                        <td>
                                                            <?php if ( $row['id'] == Middleware::$user['id'] ) {}else{ ?>                                                        
                                                                <input hidden name="idUser" value="<?= $row['id'] ?>">
                                                                <button name="hapus" class="btn btn-sm btn-danger">BANNED</button>
                                                            <?php }?>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach;?>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>