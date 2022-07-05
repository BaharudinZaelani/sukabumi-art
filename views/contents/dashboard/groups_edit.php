<?php 

if ( isset($_POST['edit']) ) {
    $res = Database::update("group_file", [
        "name" => $_POST['name'],
        "description" => $_POST['description']
    ], Views::$dataSend['group']['id'], "Group " . $_POST["name"] . " Berhasil diubah");
    $_SESSION['storage']['update_group'] = $res;
    if ( $res['status'] == "success" ) {
        App::redirect("/dashboard/groups");
    }
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
                "is-active" => "active"
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
                    <div class="card-body">
                        <a href="/dashboard/groups" class="link-success"> < Back to Group list </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Group Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?= Views::$dataSend['group']['name'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?= Views::$dataSend['group']['description'] ?></textarea>
                                </div>
                                <button name="edit" class="btn btn-success">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach( Views::$dataSend['file'] as $row ) : ?>
                                    <li class="list-group-item"><a href="/dashboard/files/<?= $row['id']; ?>"><?= $row['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>