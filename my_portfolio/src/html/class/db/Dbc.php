<?php

/**
 * データベース操作基底クラス
 */
class Dbc
{
    /** データベース関連の定数 **/

    /** @var string 接続データベース名 */
    protected const DB_NAME = 'pba';

    /** @var string データベースホスト名 */
    // const DB_HOST = 'localhost';
    protected const DB_HOST = '127.0.0.1';

    /** @var string データベース接続ユーザー名 */
    protected const DB_USER = 'kabuto';

    /** @var string データベース接続パスワード */
    protected const DB_PASS = 'ready2Race';

    /** @var object PDOクラスインスタンス */
    protected $dbh;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // データベースに接続するための文字列（DSN 接続文字列）
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST . ';charset=utf8';

        // PDOクラスのインスタンス
        $this->dbh = new PDO($dsn, self::DB_USER, self::DB_PASS);

        // エラーが起きたときのモードを指定する
        // 「PDO::ERRMODE_EXCEPTION」を指定すると、エラー発生時に例外がスローされる
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * トランザクションを開始する
     *
     * @return void
     */
    public function begin()
    {
        $this->dbh->beginTransaction();
    }

    /**
     * トランザクションをコミットする
     *
     * @return void
     */
    public function commit()
    {
        $this->dbh->commit();
    }

    /**
     * トランザクションをロールバックする
     *
     * @return void
     */
    public function rollback()
    {
        $this->dbh->rollback();
    }
}
