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
    <title>健康管理新規作成</title>
</head>

<body>
    <?php require_once('../../../../htmlUtil/record/container/function/begin_container.php'); ?>
    <h1>健康管理記録作成</h1>
    <form action="health_input_form_action.php" method="post">
        <input type="hidden" name="token" value="<?= SaftyUtil::generateToken() ?>">
        <input type="hidden" class="form-control" name="user_id" value="<?= $rec['id'] ?>">
        <!-- 作成日 -->
        <div class="form-group">
            <label for="registration_date">作成日</label>
            <input type="date" class="form-control" name="registration_date" value="<?= $date ?>" id="registration_date" class="form-control">
        </div>

        <!-- 健康管理記録入力 -->
        <div class="form-group">
            <label for="body_temperature">体温</label>
            <input type="text" class="form-control" name="body_temperature" id="body_temperature">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="systolic_blood_pressure">最高血圧</label>
                    <input type="number" class="form-control" name="systolic_blood_pressure" id="systolic_blood_pressure">

                </div>
                <div class="col">
                    <label for="diastolic_blood_pressure">最低血圧</label>
                    <input type="number" class="form-control" name="diastolic_blood_pressure" id="diastolic_blood_pressure">

                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="blood_pulse">脈拍</label>
            <input type="number" class="form-control" name="blood_pulse" id="blood_pulse">
        </div>
        <div class="form-group">
            <label for="body_weight">体重</label>
            <input type="text" class="form-control" name="body_weight" id="body_weight">
        </div>
        <div class="form-group">
            <label for="health_management_assessment">気付いたこと</label>
            <textarea class="form-control" id="health_management_assessment" rows="3" name="health_management_assessment"></textarea>
        </div>
        <div class="btn-group">
            <input type="submit" name="input" value="作成">
        </div>
    </form>
    <?php require_once('../../../../htmlUtil/record/container/function/end_container.php') ?>
</body>

</html>