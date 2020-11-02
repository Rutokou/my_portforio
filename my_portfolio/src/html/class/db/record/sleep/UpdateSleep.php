<?php

/**
 * 食事記録更新クラス
 */
class UpdateSleep extends Dbc
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
    public function updateSleepSelect(int $id)
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
        $sql .= 'where sleep_management.id=:id';

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
     * @param string $sleep_management_assessment
     * @return void
     */
    public function updateSleep(int $id, string $registration_date, string $bedtime, string $wake_up_time, int $feeling_of_deep_sleep, string $sleep_management_assessment)
    // finished_dateの引数はnullかdateの日付が入っているから型宣言は何も指定しない
    {
        $sql = 'update sleep_management set ';
        $sql .= 'registration_date=:registration_date,';
        $sql .= 'bedtime=:bedtime,';
        $sql .= 'wake_up_time=:wake_up_time,';
        $sql .= 'feeling_of_deep_sleep=:feeling_of_deep_sleep,';
        $sql .= 'sleep_management_assessment=:sleep_management_assessment ';
        $sql .= 'where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        // idをwhereで検索する場合もbindvalueでidを割り当てる
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // 以下から作業項目を更新するために引数を割り当てる
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':bedtime', $bedtime, PDO::PARAM_STR);
        $stmt->bindValue(':wake_up_time', $wake_up_time, PDO::PARAM_STR);
        $stmt->bindValue(':feeling_of_deep_sleep', $feeling_of_deep_sleep, PDO::PARAM_INT);
        $stmt->bindValue(':sleep_management_assessment', $sleep_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}
