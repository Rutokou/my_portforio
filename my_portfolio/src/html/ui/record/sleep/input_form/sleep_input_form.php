<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// リダイレクトロジック
require_once('../../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordFunkLogRed();

try {
    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $date = $dt->format('Y-m-d');

    // todo_itemテーブルクラスのインスタンスを生成する
    $getUserInfo = new Users();
    $rec = $getUserInfo->getUsersInfo();
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <?php require_once('../../../../htmlUtil/metadate.php'); ?>
    <title>睡眠記録新規作成</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>睡眠記録作成</h1>
    <form action="sleep_input_form_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" class="form-control" name="user_id" value="<?= $rec['id'] ?>">
        <!-- 作成日 -->
        <div class="form-group">
            <label for="registration_date">作成日</label>
            <input type="date" class="form-control" name="registration_date" value="<?= $date ?>" id="registration_date" class="form-control">
        </div>

        <!-- 睡眠記録 -->
        <div class="form-group">
            <label for="bedtime">就寝時間</label>
            <input type="datetime-local" class="form-control" name="bedtime" id="bedtime" class="form-control">
        </div>
        <div class="form-group">
            <label for="wake_up_time">起床時間</label>
            <input type="datetime-local" class="form-control" name="wake_up_time" id="wake_up_time" class="form-control">
        </div>
        <div class="form-group">
            <label for="feeling_of_deep_sleep">熟眠感（１～１０で評価）</label>
            <select class="form-control" id="feeling_of_deep_sleep" name="feeling_of_deep_sleep">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sleep_management_assessment">気付いたこと</label>
            <textarea class="form-control" id="sleep_management_assessment" rows="3" name="sleep_management_assessment"></textarea>
        </div>
        <div class="btn-group">
            <input type="submit" name="input" value="作成">
        </div>
    </form>
    <?php require_once('../../../../htmlUtil/record/container/function/end_container.php') ?>
</body>

</html>