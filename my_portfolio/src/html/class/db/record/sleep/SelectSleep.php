<?php
/**
 * 食事記録を取り出す処理を行うクラス
 */
class SelectSleep extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 食事記録を取得
     *
     * @return array
     */
    public function selectSleep()
    {
        $sql = 'select ';
        // sleep_managementテーブル
        $sql .= 'sleep_management.id,';
        $sql .= 'sleep_management.registration_date,';
        $sql .= 'sleep_management.bedtime,';
        $sql .= 'sleep_management.wake_up_time,';
        $sql .= 'sleep_management.feeling_of_deep_sleep,';
        $sql .= 'sleep_management.sleep_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from sleep_management ';
        $sql .= 'join users ';
        $sql .= 'on sleep_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where sleep_management.is_deleted=0 ';
        $sql .= 'order by sleep_management.registration_date desc';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}