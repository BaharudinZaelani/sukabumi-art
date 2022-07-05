<?php 
if( isset($_POST['upload']) ){
    UploadFile::upload($_FILES, intval($_POST['group']));
    App::redirect("/dashboard/files");
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
    .img {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-button {
        cursor: pointer;
    }
    .image-button:hover img {
        filter: blur(0.8px);
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <button 
                                type="button" 
                                data-toggle="modal" 
                                data-target="#filesModal" 
                                class="btn btn-success">
                                    Add Files
                            </button>
                        </div>
                    </div>
                </div>
                

                <?php foreach ( Views::$dataSend['group'] as $group ) : ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $group['name']?></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach( Views::$dataSend['files'] as $row ) : ?>
                                        <?php if ( $row['group_id'] == $group['id']) :?>
                                            <div class="col-md-3">
                                                <a class="card shadow-zaw image-button" href="/dashboard/files/<?= $row['id']?>">
                                                    <img 
                                                        src="<?= URI . $row['filePath']; ?>" 
                                                        class="card-img-top" 
                                                        >
                                                </a>
                                                
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>

<!-- Files Modal -->
<div class="modal fade" id="filesModal" tabindex="-1" role="dialog" aria-labelledby="filesModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="filesModalTitle">Add File</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <!-- file -->
                <div class="mb-3">
                    <input class="form-control" id="formFileLg" name="file_data" type="file">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="outside" placeholder="URL (optional)">
                </div>

                <!-- group -->
                <div class="mb-3">
                    <select class="form-select" size="5" name="group" aria-label="size 5 select example">
                        <option selected>Select Group you want</option>
                        <?php foreach ( Views::$dataSend['group'] as $row ) : ?>
                            <option value="<?= $row['id']; ?>"><?= $row['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="suubmit" name="upload" class="btn btn-primary">Save To Database</button>
            </div>
        </form>
    </div>
  </div>
</div>

