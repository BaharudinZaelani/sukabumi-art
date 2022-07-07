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
    .d-grid {
        grid-template-columns: 1fr 1fr;
        align-content: center;
        justify-content: center;
        justify-items: center;
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

            <div class="card">
                <div class="card-body">
                    <div class="d-grid">
                        <?php 
                            if (Views::$dataSend['prevItem']['exists']) { 
                                $item = explode("/", Views::$dataSend['prevItem']['item']['filePath']);
                                $item = explode(".", end($item));
                            
                            ?>
                            <a href="/file/<?= $item[0] . "/" . Views::$dataSend['prevItem']['item']['group_id'] ?>">< Sebelumnya</a>
                        <?php }else {
                            echo "<div></div>";
                        } ?>

                        <?php 
                            if (Views::$dataSend['nextItem']['exists']) : 
                                $item = explode("/", Views::$dataSend['nextItem']['item']['filePath']);
                                $item = explode(".", end($item));
                            
                            ?>
                            <a href="/file/<?= $item[0] . "/" . Views::$dataSend['nextItem']['item']['group_id'] ?>">Selanjutnya ></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <?= Views::$dataSend['group']['description']; ?>
                </div>
            </div>

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
                                
                                
                                
                                
                            </tr>
                            <tr>
                                <th>in Group</th>
                                <td>: <?= Views::$dataSend['group']['name'];  ?></td>
                                
                                
                                
                                
                            </tr>
                            <tr>
                                <th>Size </th>
                                <td>: <?= App::byteConvert(Views::$dataSend['file']['size'])?></td>
                                
                                
                                
                                
                            </tr>
                            <tr>
                                <th>Dimension </th>
                                <td>: <?= Views::$dataSend['file']['width'] . "x" . Views::$dataSend['file']['height']  ?></td>
                                
                                
                            </tr>
                            <tr>
                                <th>Uploaded By </th>
                                <td>: <code><?= Views::$dataSend['user']['username'] ?></code></td>
                                
                                
                                
                                
                            </tr>
                            <tr>
                                <th>Uploaded </th>
                                <td>: <?= Views::$dataSend['file']['created_at'] ?></td>
                                
                                
                                
                                
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <form method="post">
                                        : <button name="download" class="btn btn-sm btn-success">Download</button>
                                    </form>
                                </td>
                                
                                
                                
                                
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>