<?php
class RecordLoginRedirect
{
    /**
     * 記録トップ画面からログイン画面へリダイレクト
     *
     * @return void
     */
    public static function recordLoginRed(): void
    {

        // ログイン情報がセッションになければlogin.phpにリダイレクト
        if (empty($_SESSION['user'])) {
            header('Location: ../../../user/login/login.php');
            exit;
        }
    }

    /**
     * 記録画面の新規作成、更新、削除画面からログイン画面へリダイレクト
     *
     * @return void
     */
    public static function recordFunkLogRed(): void
    {

        // ログイン情報がセッションになければlogin.phpにリダイレクト
        if (empty($_SESSION['user'])) {
            header('Location: ../../../../user/login/login.php');
            exit;
        }

        // // ワンタイムトークンのチェック
        // if (!SaftyUtil::isValidToken($_POST['token'])) {
        //     // エラーメッセージをセッションに保存して、リダイレクトする
        //     $_SESSION['err']['msg']['csrf']  = Config::MSG_INVALID_PROCESS;
        //     header('Location: ../../../../user/login/login.php');
        //     exit;
        // }
    }
}
