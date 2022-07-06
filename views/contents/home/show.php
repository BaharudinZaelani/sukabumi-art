<?php 
$result = explode(".", Views::$dataSend['file']['filePath']); 
$result = explode("/", $result[0]);
if( isset($_POST['download']) ) {
    App::redirect("/file" . "/" . $result[2] . "/download");
}

?>
<style>

    .img {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="img">
                        <img src="<?= "/" . Views::$dataSend['file']['filePath']; ?>" class="img-fluid">
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
                                <th>Uploaded By </th>
                                <td>: <code><?= Views::$dataSend['user']['username'] ?></code></td>
                                <td></td>
                                <td></td>
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
                                        : <button name="download" class="btn btn-sm btn-success">Download</button>
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