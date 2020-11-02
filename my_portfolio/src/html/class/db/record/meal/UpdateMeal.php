<?php

/**
 * 食事記録更新クラス
 */
class UpdateMeal extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 更新する食事記録を取得
     *
     * @return array
     */
    public function updateMealSelect(int $id)
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
        $sql .= 'users.id as user_id ';
        $sql .= 'from meal_management ';
        $sql .= 'join users ';
        $sql .= 'on meal_management.user_id = users.id ';
        $sql .= 'where meal_management.id=:id';

        // SQLを実行する準備
        $stmt = $this->dbh->prepare($sql);

        // idの割り当て
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // SQL実行
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 食事記録更新の実行
     *
     * @param integer $id
     * @param string $registration_date
     * @param integer $user_id
     * @param string $breakfast
     * @param string $lunch
     * @param string $dinner
     * @param integer $evaluated
     * @param string $meal_management_assessment
     * @return void
     */
    public function updateMeal(int $id, string $registration_date, string $breakfast, string $lunch, string $dinner, int $evaluated, string $meal_management_assessment)
    // finished_dateの引数はnullかdateの日付が入っているから型宣言は何も指定しない
    {
        $sql = 'update meal_management set ';
        $sql .= 'registration_date=:registration_date,';
        $sql .= 'breakfast=:breakfast,';
        $sql .= 'lunch=:lunch,';
        $sql .= 'dinner=:dinner,';
        $sql .= 'evaluated=:evaluated,';
        $sql .= 'meal_management_assessment=:meal_management_assessment ';
        $sql .= 'where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        // idをwhereで検索する場合もbindvalueでidを割り当てる
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // 以下から作業項目を更新するために引数を割り当てる
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':breakfast', $breakfast, PDO::PARAM_STR);
        $stmt->bindValue(':lunch', $lunch, PDO::PARAM_STR);
        $stmt->bindValue(':dinner', $dinner, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $evaluated, PDO::PARAM_INT);
        $stmt->bindValue(':meal_management_assessment', $meal_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}
