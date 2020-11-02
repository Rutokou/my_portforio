<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// 睡眠記録更新クラス
require_once('../../../../class/db/record/sleep/UpdateSleep.php');

// リダイレクトロジック
require_once('../../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordFunkLogRed();

try {
    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));

    $date = $dt->format('Y-m-d');

    // 更新する食事記録を取得
    $updateSleep = new UpdateSleep();
    $rec = $updateSleep->updateSleepSelect($_GET['id']);

    // UNIXタイムスタンプを取得
    $origin = new DateTime($rec['bedtime']);
    $target = new DateTime($rec['wake_up_time']);
    // 就寝時間、起床時間の形式を変換
    $bedTime = $origin->format('Y-m-d H:i');
    $wakeUpTime = $target->format('Y-m-d H:i');
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../../../htmlUtil/metadate.php'); ?>
    <title>睡眠記録の削除</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>この記録を削除しますか？</h1>
    <form action="delete_sleep_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" class="form-control" name="id" value="<?= $rec['id'] ?>">
        <!-- 作成日 -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">作成日</th>
                    <th scope="col">就寝時間</th>
                    <th scope="col">起床時間</th>
                    <th scope="col">合計睡眠時間</th>
                    <th scope="col">熟眠感</th>
                    <th scope="col">気付いたこと</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?= $rec['registration_date'] ?></th>
                    <td><?= $bedTime ?></td>
                    <td><?= $wakeUpTime ?></td>
                    <td>ここに合計睡眠時間を記述</td>
                    <td><?= $rec['feeling_of_deep_sleep'] ?></td>
                    <td><?= $rec['sleep_management_assessment'] ?></td>
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