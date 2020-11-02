<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// 健康管理記録更新用データベース
require_once('../../../../class/db/record/health/UpdateHealth.php');

// リダイレクトロジック
require_once('../../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordFunkLogRed();

try {
    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $date = $dt->format('Y-m-d');

    // 更新する食事記録を取得
    $updateHealth = new UpdateHealth();
    $rec = $updateHealth->updateHealthSelect($_GET['id']);
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../../../htmlUtil/metadate.php'); ?>
    <title>食事記録の削除</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>この記録を削除しますか？</h1>
    <form action="delete_health_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" class="form-control" name="id" value="<?= $rec['id'] ?>">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">作成日</th>
                    <th scope="col">体温</th>
                    <th scope="col">最高血圧 / 最低血圧</th>
                    <th scope="col">脈拍</th>
                    <th scope="col">体重</th>
                    <th scope="col">気付いたこと</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?= $rec['registration_date'] ?></th>
                    <td><?= $rec['body_temperature'] ?></td>
                    <td><?= $rec['systolic_blood_pressure'] ?> / <?= $rec['diastolic_blood_pressure'] ?></td>
                    <td><?= $rec['blood_pulse'] ?></td>
                    <td><?= $rec['body_weight'] ?></td>
                    <td><?= nl2br($rec['health_management_assessment']) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="btn-group">
            <input type="submit" name="input" value="削除">
        </div>
    </form>
    <?php require_once('../../../../htmlUtil/record/container/function/end_container.php') ?>
</body>

</html>