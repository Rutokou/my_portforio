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
    <title>新規ユーザー登録</title>
</head>

<body>
    <?php require_once('../../htmlUtil/user/begin_container.php'); ?>
    <div class="card-header">新規ユーザー登録</div>
    <div class="card-body">
        <?php if (isset($_SESSION['err']['msg']['duplicate'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['err']['msg']['duplicate'] ?>
            </div>
        <?php elseif (isset($_SESSION['err']['msg']['csrf'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['err']['msg']['csrf'] ?>
            </div>
        <?php endif ?>
        <form action="./user_add_action.php" method="post">
            <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
            <div class="form-group">
                <?php if (isset($_SESSION['err']['msg']['email'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['err']['msg']['email'] ?>
                    </div>
                <?php endif ?>
                <label for="email">メールアドレス</label>
                <input type="text" name="email" value="<?php if (isset($_SESSION['login']['email'])) echo $_SESSION['login']['email'] ?>" class="form-control" id="emal">
            </div>
            <div class="form-group">
                <?php if (isset($_SESSION['err']['msg']['password'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['err']['msg']['password'] ?>
                    </div>
                <?php endif ?>
                <label for="password">パスワード</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <?php if (isset($_SESSION['err']['msg']['name'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['err']['msg']['name'] ?>
                    </div>
                <?php endif ?>
                <label for="name">ユーザー名</label>
                <input type="text" name="name" value="<?php if (isset($_SESSION['login']['name'])) echo $_SESSION['login']['name'] ?>" class="form-control" id="name">
            </div>
            <div class="form-group">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </form>
    </div>
    <?php require_once('../../htmlUtil/user/end_container.php'); ?>
</body>

</html>