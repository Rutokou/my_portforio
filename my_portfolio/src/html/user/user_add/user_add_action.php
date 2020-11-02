<?php
// セッションスタート
require_once('../../class/util/SessionUtil.php');
SessionUtil::sessionStart();

require_once('../../class/util/require_once/UserRequireUtil.php');
// ロジック側の外部ファイル読み込み一覧
UserRequireUtil::actionReq();

require_once('../../class/util/ValidationUtil.php');

// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    // エラーメッセージをセッションに保存して、リダイレクトする
    $_SESSION['err']['msg']['csrf']  = Config::MSG_INVALID_PROCESS;
    header('Location: ./login.php');
    exit;
}

// エラーメッセージをクリアする
unset($_SESSION['err']['msg']);
$_SESSION['err']['msg'] = null;

// 送られてきた情報をサニタイズする
$post = SaftyUtil::sanitize($_POST); 

// ログインの情報をセッションに保存する
$_SESSION['login'] = $_POST;

// バリデーションチェック
$validityCheck = array();

// メールアドレスのバリデーション
$validityCheck[] = ValidationUtil::isValidEmail($post['email'], $_SESSION['err']['msg']['email']);

// パスワードのバリデーション
$validityCheck[] = ValidationUtil::isValidPassword($post['password'], $_SESSION['err']['msg']['password']);

// 名前のバリデーション
$validityCheck[] = ValidationUtil::isValidName($post['name'], $_SESSION['err']['msg']['name']);

// バリデーションで不備があった場合
foreach ($validityCheck as $k => $v) {
    // $vにnullが代入されている可能性があるので、必ず「===」で比較する。ß
    if ($v === false) {
        header('Location: ./user_add.php');
        exit;
    }
}

try {
    // ユーザーテーブルクラスのインスタンスを生成する。
    $db = new Users();

    // レコードのインサート
    $ret = $db->addUser($_POST['email'], $_POST['password'], $_POST['name']);
    if (!$ret) {
        // エラーメッセージをセッションに保存して、リダイレクトする
        $_SESSION['err']['msg']['duplicate']  = Config::MSG_USER_DUPLICATE;
        header('Location: ./user_add.php');
        exit;
    }

    // 正常終了したときは、ログイン情報とエラーメッセージを削除して、index.phpにリダイレクトする。
    unset($_SESSION['login']);
    header('Location: ../login/login.php');
    exit;
} catch (Exception $e) {
    // エラーメッセージをセッションに保存してエラーページにリダイレクト
    $_SESSION['msg']['err'] = Config::MSG_EXCEPTION;
    header('Location: ../../error.php');
    exit;
}
