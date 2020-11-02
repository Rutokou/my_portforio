<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../../class/util/require_once/RecordRequireUtil.php');
// 新規作成、更新、削除の階層に外部ファイルを読み込むメソッド
RecordRequireUtil::recordFuncReq();

// 食事記録更新クラス
require_once('../../../../class/db/record/meal/UpdateMeal.php');

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
        $db = new UpdateMeal();
        $db->updateMeal($_POST['id'], $_POST['registration_date'], $_POST['breakfast'], $_POST['lunch'], $_POST['dinner'], $_POST['evaluated'], $_POST['meal_management_assessment']);
    }

    // meal.phpへリダイレクトする
    header('Location: ../meal.php');
    exit;
} catch (Exception $e) {
    var_dump($e);
    exit;
}
