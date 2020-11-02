<?php
/**
 * 活動記録を取り出す処理を行うクラス
 */
class SelectHealth extends Dbc
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
    public function selectHealth()
    {
        $sql = 'select ';
        // health_managementテーブル
        $sql .= 'health_management.id,';
        $sql .= 'health_management.registration_date,';
        $sql .= 'health_management.body_temperature,';
        $sql .= 'health_management.systolic_blood_pressure,';
        $sql .= 'health_management.diastolic_blood_pressure,';
        $sql .= 'health_management.blood_pulse,';
        $sql .= 'health_management.body_weight,';
        $sql .= 'health_management.health_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from health_management ';
        $sql .= 'join users ';
        $sql .= 'on health_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where health_management.is_deleted=0 ';
        $sql .= 'order by health_management.registration_date desc';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}