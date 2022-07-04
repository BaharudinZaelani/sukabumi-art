<?php 
$data = Views::sessionStorage();
// App::clearAlert("contoh_satu");

?>
<?php foreach($data as $key => $row) : ?>

    <form method="post">
        <input type="text" name="name" value="<?= $key; ?>" hidden>
        <!-- jika sukssess -->
        <?php if( $row['status'] == "success" ) : ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button name="clear" type="submit" class="close" data-dismiss="" aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span><b> Success - </b><?= $row['message'];?> </span>
            </div>
        <?php endif; ?>

        <!-- jika gagal -->
        <?php if( $row['status'] == "error" ) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button name="clear" type="submit" class="close" data-dismiss="" aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                
                <span><b> Error - </b><?= $row['message'];?></span>
            </div>
        <?php endif; ?>
    </form>
<?php endforeach;?>