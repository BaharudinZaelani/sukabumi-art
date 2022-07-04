<?php 
// jika tombol update ditekan
if ( isset($_POST['update-profile']) ){
    $res = AccountLogic::updateProfile([
        "image" => $_POST['image'],
        "cover" => $_POST['cover'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "bio" => $_POST['bio'],
    ], $_POST['password'], Middleware::$user['id']);

    $_SESSION['storage']['alert_update_account'] = $res;
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
                <?php Views::getComponents("dashboard/profile-card")?>

                <div class="col-md-8">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pp">Profile Image</label>
                                            <input readonly value="<?= Views::$dataSend['user']['image']?>" name="image" type="text" id="pp" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cover">Cover Image</label>
                                            <input readonly value="<?= Views::$dataSend['user']['cover']?>" name="cover" type="text" id="cover" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- username email -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input readonly name="username" type="text" class="form-control" placeholder="Username" name="username" value="<?= Views::$dataSend['user']['username']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input name="email" value="<?= Views::$dataSend['user']['email']?>" type="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <!-- bio -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>About Me</label>
                                            <textarea name="bio" class="form-control textarea"><?= Views::$dataSend['user']['bio']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- password -->
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="oldpassword">Old Password</label>
                                            <input type="password" class="form-control" id="oldpassword" name="old_password">
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newpassword">Password</label>
                                            <input name="password" required type="password" class="form-control" id="newpassword">
                                        </div>
                                    </div>
                                </div>

                                <!-- submit -->
                                <div class="row">
                                    <div class="update ml-auto mr-auto">
                                        <button name="update-profile" type="submit" class="btn btn-primary btn-round">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php Views::getComponents("dashboard/footer"); ?>
    </div>
</div>
