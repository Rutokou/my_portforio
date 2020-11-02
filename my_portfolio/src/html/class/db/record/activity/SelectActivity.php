<?php
/**
 * 活動記録を取り出す処理を行うクラス
 */
class SelectActivity extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 活動記録を取得
     *
     * @return array
     */
    public function selectActivity()
    {
        $sql = 'select ';
        // activity_managementテーブル
        $sql .= 'activity_management.id,';
        $sql .= 'activity_management.registration_date,';
        $sql .= 'activity_management.activity,';
        $sql .= 'activity_management.evaluated,';
        $sql .= 'activity_management.activity_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from activity_management ';
        $sql .= 'join users ';
        $sql .= 'on activity_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where activity_management.is_deleted=0 ';
        $sql .= 'order by activity_management.registration_date desc';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}