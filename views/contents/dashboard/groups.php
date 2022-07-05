<?php 

if ( isset($_POST['addGroup']) ) {
    $name = $_POST['groupName'];
    $res = Database::add("group_file", [
        "user_id" => Middleware::$user['id'],
        "name" => $_POST['groupName'],
        "description" => $_POST['description'],
        "created_at" => App::date()
    ], "Group $name berhasil ditambahkan !");
    $_SESSION['user']['group_count'] += 1;
    $_SESSION['storage']['alert_add_group'] = $res;
    App::redirect("/dashboard/groups");
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
                "is-active" => "active "
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
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahGroup">Add Group</button>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php foreach ( Views::$dataSend['groups'] as $row ) : ?>
                                            <tr>
                                                <td>
                                                    <a class="btn btn-sm btn-outline-success">Edit</a>
                                                    <a href="/dashboard/groups/delete/<?= $row['id']?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                                </td>
                                                <td>
                                                    <a href="/dashboard/groups/<?= $row['id']?>"><?= $row['name']?></a>
                                                </td>
                                                <td><?= $row['description']?></td>
                                                <td>
                                                    <?php 
                                                        $count = count(Database::getAll("image_file", "=", "group_id", $row['id']));
                                                        echo $count;
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php Views::getComponents("dashboard/profile-card");?>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>


<!-- tambah group -->
<div class="modal fade" id="tambahGroup" tabindex="-1" role="dialog" aria-labelledby="tambahGroup" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahGroup">Add Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Group Name</label>
                    <input name="groupName" type="text" placeholder="ex: Pixel Art" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description Group</label>
                    <textarea name="description" class="form-control" id="desc" rows="3"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addGroup" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
  </div>
</div>