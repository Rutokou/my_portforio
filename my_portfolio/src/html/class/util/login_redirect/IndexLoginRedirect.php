<?php
class IndexLoginRedirect
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public static function indexLoginRed() : void
    {
        // ログイン情報がセッションになければlogin.phpにリダイレクト
        if (empty($_SESSION['user'])) {
            header('Location: ../user/login/login.php');
            exit;
        }
    }
}
