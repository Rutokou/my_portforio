<?php
// セッションスタート
require_once('./class/util/SessionUtil.php');
SessionUtil::sessionStart();

// エラーがなかったらトップページにリダイレクトする
if (!isset($_SESSION['msg']['err'])) {
    header('Location: ./');
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('./htmlUtil/metadate.php'); ?>
    <title>エラー</title>
</head>

<body>
    <?php require_once('./htmlUtil/error/begin_container.php'); ?>
    <div class="card-header">
        エラーが発生しました
    </div>
    <div class="card-body">
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['msg']['err'] ?>
        </div>
        <a href="./logout.php" class="btn btn-danger">もどる</a>
    </div>
    <?php require_once('./htmlUtil/error/end_container.php'); ?>
</body>

</html>
<?php
// エラーを削除する
unset($_SESSION['msg']['err']);
