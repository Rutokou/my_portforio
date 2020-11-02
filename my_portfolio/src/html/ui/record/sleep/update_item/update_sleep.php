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

    // 更新する睡眠記録を取得
    $updateSleep = new UpdateSleep();
    $rec = $updateSleep->updateSleepSelect($_GET['id']);

    // UNIXタイムスタンプを取得
    $origin = new DateTime($rec['bedtime']);
    $target = new DateTime($rec['wake_up_time']);
    // 就寝時間、起床時間の形式を変換
    $bedTime = $origin->format('Y-m-d\TH:i');
    $wakeUpTime = $target->format('Y-m-d\TH:i');
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../../../htmlUtil/metadate.php'); ?>
    <title>睡眠記録編集</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>睡眠記録を編集する</h1>
    <form action="update_sleep_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" value="<?= $rec['id'] ?>" name="id">
        <!-- 作成日 -->
        <div class="form-group">
            <label for="registration_date">作成日</label>
            <input type="date" class="form-control" name="registration_date" value="<?= $rec['registration_date'] ?>" id="registration_date">
        </div>

        <!-- 睡眠記録 -->
        <div class="form-group">
            <label for="bedtime">就寝時間</label>
            <input type="datetime-local" value="<?= $bedTime ?>" class="form-control" name="bedtime" id="bedtime" class="form-control">
        </div>
        <div class="form-group">
            <label for="wake_up_time">起床時間</label>
            <input type="datetime-local" value="<?= $wakeUpTime ?>" class="form-control" name="wake_up_time" id="wake_up_time" class="form-control">
        </div>
        <div class="form-group">
            <label for="feeling_of_deep_sleep">熟眠感（１～１０で評価）</label>
            <select class="form-control" id="feeling_of_deep_sleep" name="feeling_of_deep_sleep">
                <option <?php if ($rec['feeling_of_deep_sleep'] == "1") echo 'selected' ?>>1</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "2") echo 'selected' ?>>2</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "3") echo 'selected' ?>>3</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "4") echo 'selected' ?>>4</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "5") echo 'selected' ?>>5</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "6") echo 'selected' ?>>6</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "7") echo 'selected' ?>>7</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "8") echo 'selected' ?>>8</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "9") echo 'selected' ?>>9</option>
                <option <?php if ($rec['feeling_of_deep_sleep'] == "10") echo 'selected' ?>>10</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sleep_management_assessment">気付いたこと</label>
            <textarea class="form-control" id="sleep_management_assessment" rows="3" name="sleep_management_assessment"><?= $rec['sleep_management_assessment'] ?></textarea>
        </div>
        <div class="btn-group">
            <input type="submit" name="input" value="更新">
        </div>
    </form>
    <?php require_once('../../../../htmlUtil/record/container/function/end_container.php') ?>
</body>

</html>