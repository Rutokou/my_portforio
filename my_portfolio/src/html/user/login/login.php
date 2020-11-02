<?php
// セッションスタート
require_once('../../class/util/SessionUtil.php');
SessionUtil::sessionStart();

require_once('../../class/util/require_once/UserRequireUtil.php');
UserRequireUtil::indexReq();
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../htmlUtil/metadate.php'); ?>
    <title>ログイン</title>
</head>

<body>
    <?php require_once('../../htmlUtil/user/begin_container.php'); ?>
    <div class="card-header">ログイン</div>
    <div class="card-body">
        <?php if (isset($_SESSION['err']['msg']['login_fail'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['err']['msg']['login_fail'] ?>
            </div>
        <?php elseif (isset($_SESSION['err']['msg']['csrf'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['err']['msg']['csrf'] ?>
            </div>
        <?php endif ?>
        <form action="./login_action.php" method="post">
            <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" name="email" value="<?php if (isset($_SESSION['login']['email'])) echo $_SESSION['login']['email'] ?>" class="form-control" id="emal">
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <input type="submit" value="ログイン" class="btn btn-primary">
            </div>
        </form>
        <a href="../user_add/user_add.php">会員登録をされてない方はこちら</a>
    </div>
    <?php require_once('../../htmlUtil/user/end_container.php') ?>
</body>

</html>