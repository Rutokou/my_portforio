<?php
// セッションスタート
require_once('../../class/util/SessionUtil.php');
SessionUtil::sessionStart();

require_once('../../class/util/require_once/UserRequireUtil.php');
// ロジック側の外部ファイル読み込み一覧
UserRequireUtil::actionReq();

// ワンタイムトークンのチェック
if (!SaftyUtil::isValidToken($_POST['token'])) {
    // エラーメッセージをセッションに保存して、リダイレクトする
    $_SESSION['err']['msg']['csrf']  = Config::MSG_INVALID_PROCESS;
    header('Location: ./login.php');
    exit;
}

// 送られてきた情報をサニタイズする
SaftyUtil::sanitize($_POST);

// ログインの情報をセッションに保存する
$_SESSION['login'] = $_POST;

try {
    // ユーザーテーブルクラスのインスタンスを生成する
    $db = new Users();

    // ログイン情報からユーザーを検索
    $user = $db->getUser($_POST['email'], $_POST['password']);

    // ログイン不可のとき
    // エラーメッセージをセッションに保存して、リダイレクトする
    if (empty($user)) {
        $_SESSION['err']['msg']['login_fail'] = Config::MSG_USER_LOGIN_FAILURE;
        header('Location: ./login.php');
        exit;
    }

    // ユーザー情報をセッションに保存する
    $_SESSION['user'] = $user;

    // エラーメッセージを削除して、index.phpにリダイレクト
    unset($_SESSION['err']['msg']['login_fail']);
    unset($_SESSION['err']['msg']['csrf']);
    header('Location: ../../ui/record/meal/meal.php');
    // header('Location: ../../ui/index.php');
    exit;
} catch (Exception $e) {
    // エラーメッセージをセッションに保存してエラーページにリダイレクト
    $_SESSION['msg']['err'] = Config::MSG_EXCEPTION;
    header('Location: ./html/error.php');
    exit;
}
