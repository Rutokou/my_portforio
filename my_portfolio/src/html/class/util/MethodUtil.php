<?php
/**
 * メソッド管理クラス
 */
class MethodUtil
{
    /**
     * 日付のバリデーションチェック
     *
     * @param string $checkdate
     * @return boolean
     */
    public static function isDate($checkdate) : bool
    {
        $d = explode('-', $checkdate);
        return checkdate($d[1], $d[2], $d[0]);
    }

    /**
     * トップページか検索結果ページにリダイレクト
     *
     * @return void
     */
    public static function redirectItemPage() : void
    {
        if (isset($_SESSION['index']) && $_SESSION['index'] == 1) {
            // index.phpへリダイレクトする
            header('Location: ../index.php');
            exit;
        } else if (isset($_SESSION['search_result']) && $_SESSION['search_result'] == 1) {
            SaftyUtil::generateToken('search_token');
            // search.phpへリダイレクトする
            header('Location: ../search.php');
            exit;
        }
    }

    /**
     * バリデーション時に作業登録画面か更新画面にリダイレクト
     *
     * @return void
     */
    public static function redirectForm() : void
    {
        if (isset($_SESSION['input_form']) && $_SESSION['input_form'] == 1) {
            // input_form.phpへリダイレクトする
            header('Location: ../item_action/input_form.php');
            exit;
        } else if (isset($_SESSION['update_item']) && $_SESSION['update_item'] == 1) {
            // update_item.phpへリダイレクトする
            header('Location: ../item_action/update_item.php?id=' . $_POST['id']);
            exit;
        }
    }
}
