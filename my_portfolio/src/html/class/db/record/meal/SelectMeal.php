<?php
/**
 * 食事記録を取り出す処理を行うクラス
 */
class SelectMeal extends Dbc
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
    public function selectMeal()
    {
        $sql = 'select ';
        // meal_managementテーブル
        $sql .= 'meal_management.id,';
        $sql .= 'meal_management.registration_date,';
        $sql .= 'meal_management.breakfast,';
        $sql .= 'meal_management.lunch,';
        $sql .= 'meal_management.dinner,';
        $sql .= 'meal_management.evaluated,';
        $sql .= 'meal_management.meal_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from meal_management ';
        $sql .= 'join users ';
        $sql .= 'on meal_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where meal_management.is_deleted=0 ';
        $sql .= 'order by meal_management.registration_date desc';
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}