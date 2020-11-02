<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// 健康管理記録データ入力用
require_once('../../../../class/db/record/health/InputHealth.php');

// リダイレクトロジック
require_once('../../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordFunkLogRed();

// ワンタイムトークンのチェック
SaftyUtil::checkToken();

try {
    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $date = $dt->format('Y-m-d');

    if ($_POST['input']) {
        // インスタンス生成
        $db = new InputHealth();
        $db->insertHealth($_POST['registration_date'], $_POST['user_id'], $_POST['body_temperature'], $_POST['systolic_blood_pressure'], $_POST['diastolic_blood_pressure'], $_POST['blood_pulse'], $_POST['body_weight'], $_POST['health_management_assessment']);
    }

    // meal.phpへリダイレクトする
    header('Location: ../health.php');
    exit;
} catch (Exception $e) {
    var_dump($e);
    exit;
}
