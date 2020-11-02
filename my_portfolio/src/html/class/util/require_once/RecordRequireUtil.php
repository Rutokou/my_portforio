<?php

/**
 * 記録画面に外部ファイルを読み込む共通の処理一覧
 */
class RecordRequireUtil
{
    public static function recordRequireOnce()
    {
        // セッションスタート
        require_once('../../../class/util/SessionUtil.php');
        SessionUtil::sessionStart();
        // パス
        require_once('../../../class/config/Path.php');
        // コンフィグ
        require_once('../../../class/config/Config.php');
        // データベース
        require_once('../../../class/db/Dbc.php');
        require_once('../../../class/db/Users.php');
        // 安全対策クラス
        require_once('../../../class/util/SaftyUtil.php');
    }

    /**
     * 記録画面の新規作成、更新、削除機能で読み込む外部ファイル
     *
     * @return void
     */
    public static function recordFuncReq()
    {
        // セッションスタート
        require_once('../../../../class/util/SessionUtil.php');
        SessionUtil::sessionStart();
        // パス
        require_once('../../../../class/config/Path.php');
        // コンフィグ
        require_once('../../../../class/config/Config.php');
        // データベース
        require_once('../../../../class/db/Dbc.php');
        require_once('../../../../class/db/Users.php');
        // 安全対策クラス
        require_once('../../../../class/util/SaftyUtil.php');
    }
}
