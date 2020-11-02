<?php
/**
 * 活動記録削除クラス
 */
class DeleteActivity extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 項目の削除
     *
     * @param integer $id
     * @return void
     */
    public function deleteActivity(int $id)
    {
        // 削除フラグ切替で論理削除を行う
        $sql = 'update activity_management set is_deleted=1 ';
        $sql .= 'where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // SQLを実行する
        $stmt->execute();
    }
}
