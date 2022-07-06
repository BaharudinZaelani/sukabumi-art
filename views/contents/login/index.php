
<!-- php logic -->
<?php 

if ( isset($_POST['login']) ){
    $login = LoginLogic::login($_POST['username'], $_POST['password']);
    $_SESSION['recent_login'] = [
        "username" => $_POST['username'],
        "time" => App::date()
    ];
}

?>
<div class="container">
    <div class="card">
        <form method="post">
            <div class="card-body">
                
                <?php if( isset($login) AND $login['status'] == "error" ) : ?>
                    <div class="error-login">
                        <span style="color: red;"><?= $login['message']; ?></span>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" <?= (isset($_SESSION['recent_login'])) ? 'value="' . $_SESSION['recent_login']['username'] . '" autofocus' : "" ?>>
                </div>
                <div class="input-group">
                    <label for="passwrod">Passwrod</label>
                    <input type="password" name="password" id="passwrod">
                </div>
                <div class="input-submit">
                    <button name="login" class="btn">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>