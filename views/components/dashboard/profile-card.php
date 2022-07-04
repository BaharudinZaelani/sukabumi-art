<div class="col-md-4">
    <div class="card card-user">
        <div class="image">
            <img src="<?= Views::$dataSend['user']['cover']?>">
        </div>
        <div class="card-body">
            <div class="author">
                <a href="#">
                    <img class="avatar border-gray" src="<?= Views::$dataSend['user']['image']?>">
                    <h5 class="title"><?= ucfirst(Views::$dataSend['user']['username']); ?></h5>
                </a>
                <p class="description">
                    @<?= Views::$dataSend['user']['username'];?>
                </p>
            </div>
            <p class="description text-center">
            "<?= Views::$dataSend['user']['bio']; ?>"
            </p>
        </div>

        <div class="card-footer">
            <hr>
            <div class="button-container">
                <div class="row">
                    <div class="col-lg col-md-6 col-6 ml-auto">
                        <h5>12<br><small>Files</small></h5>
                    </div>
                    <div class="col-lg col-md-6 col-6 ml-auto mr-auto">
                        <h5>6<br><small>Groups</small></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>