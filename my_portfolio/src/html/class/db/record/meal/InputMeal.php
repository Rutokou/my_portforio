<?php
/**
 * 食事記録の新規作成クラス
 */
class InputMeal extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insertMeal(string $registration_date, int $user_id, string $breakfast, string $lunch, string $dinner, int $evaluated, string $meal_management_assessment)
    {
        $sql = 'insert into meal_management (';
        $sql .= 'registration_date,';
        $sql .= 'user_id,';
        $sql .= 'breakfast,';
        $sql .= 'lunch,';
        $sql .= 'dinner,';
        $sql .= 'evaluated,';
        $sql .= 'meal_management_assessment';
        $sql .= ') values (';
        $sql .= ':registration_date,';
        $sql .= ':user_id,';
        $sql .= ':breakfast,';
        $sql .= ':lunch,';
        $sql .= ':dinner,';
        $sql .= ':evaluated,';
        $sql .= ':meal_management_assessment';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':breakfast', $breakfast, PDO::PARAM_STR);
        $stmt->bindValue(':lunch', $lunch, PDO::PARAM_STR);
        $stmt->bindValue(':dinner', $dinner, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $evaluated, PDO::PARAM_INT);
        $stmt->bindValue(':meal_management_assessment', $meal_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}