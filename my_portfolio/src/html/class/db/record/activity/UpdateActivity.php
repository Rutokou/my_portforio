<?php

/**
 * 活動記録更新クラス
 */
class UpdateActivity extends Dbc
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
    public function updateActivitySelect(int $id)
    {
        $sql = 'select ';
        // activity_managementテーブル
        $sql .= 'activity_management.id,';
        $sql .= 'activity_management.registration_date,';
        $sql .= 'activity_management.activity,';
        $sql .= 'activity_management.evaluated,';
        $sql .= 'activity_management.activity_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id ';
        $sql .= 'from activity_management ';
        $sql .= 'join users ';
        $sql .= 'on activity_management.user_id = users.id ';
        $sql .= 'where activity_management.id=:id';

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
     * @param string $activity
     * @param integer $evaluated
     * @param string $activity_management_assessment
     * @return void
     */
    public function updateActivity(int $id, string $registration_date,  string $activity, int $evaluated, string $activity_management_assessment)
    // finished_dateの引数はnullかdateの日付が入っているから型宣言は何も指定しない
    {
        $sql = 'update activity_management set ';
        $sql .= 'registration_date=:registration_date,';
        $sql .= 'activity=:activity,';
        $sql .= 'evaluated=:evaluated,';
        $sql .= 'activity_management_assessment=:activity_management_assessment ';
        $sql .= 'where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        // idをwhereで検索する場合もbindvalueでidを割り当てる
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // 以下から作業項目を更新するために引数を割り当てる
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':activity', $activity, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $evaluated, PDO::PARAM_INT);
        $stmt->bindValue(':activity_management_assessment', $activity_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}
