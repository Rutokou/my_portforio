<?php

/**
 * バリデーションユーティリティクラスです。
 */
class ValidationUtil
{

    /**
     * 正しい日付形式の文字列かどうかを判定します。
     *
     * @param string $date 日付形式の文字列
     * @return boolean 正しいとき：true、正しくないとき：false
     */
    public static function isDate($date)
    {
        // strtotime()関数を使って、タイムスタンプに変換できるかどうかで正しい日付かどうかを調べます。
        // https://www.php.net/manual/ja/function.strtotime.php
        // 参照
        return strtotime($date) == false ? false : true;
    }

    /**
     * 項目名の長さ（文字数）が正しいかどうかを判定します。
     *
     * @param string $itemName 項目名
     * @return boolean 正しいとき：true、正しくないとき：false
     */
    public static function isValidItemName($itemName)
    {
        if (strlen($itemName) > 100) {
            return false;
        }
        return true;
    }

    /**
     * 指定IDのユーザーが存在するかどうか判定します。
     *
     * @param int $userId ユーザーID
     * @return boolean
     */
    public static function isValidUserId($userId)
    {
        // $userIdが数字でなかったら、falseを返却
        if (!is_numeric($userId)) {
            return false;
        }

        // $userIdが0以下はありえないので、falseを返却
        if ($userId <= 0) {
            return false;
        }
    }

    /**
     * 名前の妥当性をチェックします。
     *
     * @param string $name 名前
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidName($name, &$msg): bool
    {
        $msg = '';
        if (empty($name)) {
            $msg = "お名前を入力してください。";
            return false;
        }
        if (strlen($name) > 50) {
            $msg = "恐れ入りますが、お名前は50文字以内でご入力ください。";
            return false;
        }
        return true;
    }

    /**
     * パスワードの妥当性をチェックします。
     *
     * @param stirng $password パスワード
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidPassword($password, &$msg): bool
    {
        $msg = '';
        if (empty($password)) {
            $msg = "パスワードを入力してください。";
            return false;
        }
        if (!empty($password) && !preg_match('/\A[a-z\d]{8,100}+\z/i', $password)) {
            $msg = "パスワードは半角英数字で正しく入力してください。";
            return false;
        }
        return true;
    }

    /**
     * メールアドレスの妥当性をチェックします。
     *
     * @param string $email メールアドレス
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidEmail($email, &$msg): bool
    {
        $msg = '';
        if (empty($email)) {
            $msg = "メールアドレスを入力してください。";
            return false;
        }
        if (!empty($email) && !preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $email)) {
            $msg = "メールアドレスを正しく入力してください。";
            return false;
        }
        if (strlen($email) > 256) {
            $msg = "恐れ入りますが、メールアドレスは256文字以内で入力してください。";
            return false;
        }
        return true;
    }
}
