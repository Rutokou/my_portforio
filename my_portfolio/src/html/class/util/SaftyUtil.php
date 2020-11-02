<?php

/**
 * 安全対策クラス
 */
class SaftyUtil
{
    // /**
    //  * POSTされたデータをサニタイズします。こちらは引数とメソッドのデータ型を指定しない場合の書き方です
    //  *
    //  * @param array $before サニタイズ前のPOST配列
    //  * @return array サニタイズ後のPOST配列
    //  */
    // public static function sanitize($before)
    // {
    //     $after = array();
    //     foreach ($before as $k => $v) {
    //         $after[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    //     }
    //     return $after;
    // }

    /**
     * POSTまたはGETで送信されてきた連想配列の要素の値をサニタイズする（1次元配列のみ）
     *
     * @param array $post POSTまたはGETで取得した連想配列
     * @return array
     */
    public static function sanitize(array $post): array
    {
        foreach ($post as $k => $v) {
            $post[$k] = htmlspecialchars($v);
        }
        return $post;
    }

    /**
     * ワンタイムトークンを発生させる
     *
     * @param string $tokenName セッションに保存するトークンのキーの名前
     * @return string
     */
    public static function generateToken(string $tokenName = 'token'): string
    {
        // ワンタイムトークンを生成してセッションに保存する
        $token = bin2hex(openssl_random_pseudo_bytes(Config::RANDOM_PSEUDO_STRING_LENGTH));
        $_SESSION[$tokenName] = $token;
        return $token;
    }

    /**
     * 送信されてきたトークンが正しいかどうか調べる
     *
     * @param string $token 送信されてきたトークン
     * @param string $tokenName セッションに保存されているトークンのキーの名前
     * @return boolean
     */
    public static function isValidToken(string $token, string $tokenName = 'token'): bool
    {
        if (!isset($_SESSION[$tokenName]) || $_SESSION[$tokenName] !== $token) {
            return false;
        }
        return true;
    }

    public static function checkToken(): void
    {
        // ワンタイムトークンのチェック
        if (!SaftyUtil::isValidToken($_POST['token'])) {
            $loginRoot = $_SERVER['DOCUMENT_ROOT'] . '\programing\my_portfolio\src\html\user\login\login.php';
            // エラーメッセージをセッションに保存して、リダイレクトする
            $_SESSION['err']['msg']['csrf']  = Config::MSG_INVALID_PROCESS;
            header('Location: ' . $loginRoot);
            exit;
        }
    }
}
