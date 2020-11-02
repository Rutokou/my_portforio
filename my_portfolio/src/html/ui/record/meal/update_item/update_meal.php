<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// 食事記録更新用データベース
require_once('../../../../class/db/record/meal/UpdateMeal.php');

// リダイレクトロジック
require_once('../../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordFunkLogRed();

try {
    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $date = $dt->format('Y-m-d');

    // 更新する食事記録を取得
    $updateMeal = new UpdateMeal();
    $rec = $updateMeal->updateMealSelect($_GET['id']);
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../../../htmlUtil/metadate.php'); ?>
    <title>食事記録編集</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>食事記録を編集する</h1>
    <form action="update_meal_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" value="<?= $rec['id'] ?>" name="id">
        <!-- 作成日 -->
        <div class="form-group">
            <label for="registration_date">作成日</label>
            <input type="date" class="form-control" name="registration_date" value="<?= $rec['registration_date'] ?>" id="registration_date" class="form-control">
        </div>

        <!-- 食事記録 -->
        <div class="form-group">
            <label for="breakfast">朝食</label>
            <textarea class="form-control" id="breakfast" rows="3" name="breakfast"><?= $rec['breakfast'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="lunch">昼食</label>
            <textarea class="form-control" id="lunch" rows="3" name="lunch"><?= $rec['lunch'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="dinner">夕食</label>
            <textarea class="form-control" id="dinner" rows="3" name="dinner"><?= $rec['dinner'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="evaluated">評価（１～１０で評価）</label>
            <select class="form-control" id="evaluated" name="evaluated">
                <option <?php if ($rec['evaluated'] == "1") echo 'selected' ?>>1</option>
                <option <?php if ($rec['evaluated'] == "2") echo 'selected' ?>>2</option>
                <option <?php if ($rec['evaluated'] == "3") echo 'selected' ?>>3</option>
                <option <?php if ($rec['evaluated'] == "4") echo 'selected' ?>>4</option>
                <option <?php if ($rec['evaluated'] == "5") echo 'selected' ?>>5</option>
                <option <?php if ($rec['evaluated'] == "6") echo 'selected' ?>>6</option>
                <option <?php if ($rec['evaluated'] == "7") echo 'selected' ?>>7</option>
                <option <?php if ($rec['evaluated'] == "8") echo 'selected' ?>>8</option>
                <option <?php if ($rec['evaluated'] == "9") echo 'selected' ?>>9</option>
                <option <?php if ($rec['evaluated'] == "10") echo 'selected' ?>>10</option>
            </select>
        </div>
        <div class="form-group">
            <label for="meal_management_assessment">気付いたこと</label>
            <textarea class="form-control" id="meal_management_assessment" rows="3" name="meal_management_assessment"><?= $rec['meal_management_assessment'] ?></textarea>
        </div>
        <div class="btn-group">
            <input type="submit" name="input" value="更新">
        </div>
    </form>
    <?php require_once('../../../../htmlUtil/record/container/function/end_container.php') ?>
</body>

</html>