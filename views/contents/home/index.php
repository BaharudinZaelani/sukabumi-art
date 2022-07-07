<div class="container">
    <div class="row">
        <!-- nav -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="/login" class="btn btn-outline-primary">Sign In<a>
                </div>
            </div>
        </div>

        <!-- group -->
        <?php foreach( Views::$dataSend['groups'] as $group ) : ?>
            <?php 
                $fileCount = 0;
                foreach ( Views::$dataSend['files'] as $file ) {
                    if ( $file['group_id'] == $group['id'] ) {
                        $fileCount++;
                    }
                }
                if ( $fileCount <= 0 ) {
                    continue;
                }
            ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title" style="font-size: 1.4rem;"><?= $group['name'] . " <code>$fileCount</code>"; ?> </h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php $fileCount = 0; ?>
                            <?php foreach ( Views::$dataSend['files'] as $row ) :  ?>
                                <?php if ( $row['group_id'] == $group['id']) : ?>
                                    <?php $fileCount++; ?>

                                    <?php if ( $fileCount <= 1 ) : ?>
                                        <div class="col-12">
                                            <?php 
                                                $result = explode(".", $row['filePath']); 
                                                $result = explode("/", $result[0]);
                                            ?>
                                            <a href="file/<?= $result[2] . "/" . $group['id']; ?>" class="card shadow-zaw image-button">
                                                <img 
                                                    src="<?= URI . $row['filePath']; ?>" 
                                                    class="card-img-top" 
                                                    >
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php foreach ( Views::$dataSend['users'] as $row ) : ?>
                            <?= ($group['user_id'] == $row['id'])? "by : " . $row['username'] : "" ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>