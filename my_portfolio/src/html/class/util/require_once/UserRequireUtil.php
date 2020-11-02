<?php
class UserRequireUtil
{
    public static function indexReq()
    {
        // 必要なファイルの読み込み
        require_once('../../class/config/Config.php');
        require_once('../../class/util/SaftyUtil.php');
    }

    public static function actionReq()
    {
        // 必要なファイルを読み込む
        self::indexReq();
        require_once('../../class/db/Dbc.php');
        require_once('../../class/db/Users.php');
    }
}
