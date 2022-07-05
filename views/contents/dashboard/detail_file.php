<?php 

if( isset($_POST['hapus']) ) {
    $idFile = $_POST['idFile'];
    $filePath = $_POST['filePath'];
    $delete = FileLogic::hapus($idFile, $filePath);
    if( $delete ) {
        App::redirect("/dashboard/files");
    }
}

// download file
if ( isset($_POST['download']) ) {
    $filepath = "public_html/" . Views::$dataSend['file']['filePath'];
    if ( file_exists( $filepath ) ) {
        App::redirect(Views::$dataSend['file']['id'] . "/download");
        $_SESSION['storage']['download_file'] = [
            "status" => "success", 
            "message" => "Gambar berhasil diunduh ! Silahkan cek di folder download anda :)"
        ];
    }else {
        $_SESSION['storage']['download_file'] = [
            "status" => "error",
            "message" => "OOPS :( Download Failed ! Internal Server Error !"
        ];
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
    .img {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
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
                    <div class="card-body">
                            
                        <a href="/dashboard/files" class="link-success">< Back to file list </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="img">
                                <img
                                    class="img-fluid" 
                                    src="<?= URI . Views::$dataSend['file']['filePath']?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">File Propertie</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <td>: <?= Views::$dataSend['file']['name'];  ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>in Group</th>
                                        <td>: <?= Views::$dataSend['group']['name'];  ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Size </th>
                                        <td>: <?= App::byteConvert(Views::$dataSend['file']['size'])?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Dimension </th>
                                        <td>: <?= Views::$dataSend['file']['width'] . "x" . Views::$dataSend['file']['height']  ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Uploaded </th>
                                        <td>: <?= Views::$dataSend['file']['created_at'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <form method="post">
                                                : <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-sm btn-danger">Hapus</button>
                                                <button name="download" class="btn btn-sm btn-success">Download</button>
                                            </form>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalCenterTitle">Sukabumi - Art Says :</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Apakah anda yakin ingin menghapus file : <code><?= Views::$dataSend['file']['name'] ?></code></span>
      </div>
      <div class="modal-footer">
        <form method="post">
            <input type="text" name="idFile" hidden value="<?= Views::$dataSend['file']['id'] ?>">
            <input type="text" name="filePath" hidden value="<?= Views::$dataSend['file']['filePath'] ?>">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="hapus" class="btn btn-sm btn-danger">OKE HAPUS!</button>
        </form>
      </div>
    </div>
  </div>
</div>