<?php
/**
 * 睡眠記録の新規作成クラス
 */
class InputSleep extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insertSleep(string $registration_date, int $user_id, string $bedtime, string $wake_up_time, int $feeling_of_deep_sleep, string $sleep_management_assessment)
    {
        $sql = 'insert into sleep_management (';
        $sql .= 'registration_date,';
        $sql .= 'user_id,';
        $sql .= 'bedtime,';
        $sql .= 'wake_up_time,';
        $sql .= 'feeling_of_deep_sleep,';
        $sql .= 'sleep_management_assessment';
        $sql .= ') values (';
        $sql .= ':registration_date,';
        $sql .= ':user_id,';
        $sql .= ':bedtime,';
        $sql .= ':wake_up_time,';
        $sql .= ':feeling_of_deep_sleep,';
        $sql .= ':sleep_management_assessment';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':bedtime', $bedtime, PDO::PARAM_STR);
        $stmt->bindValue(':wake_up_time', $wake_up_time, PDO::PARAM_STR);
        $stmt->bindValue(':feeling_of_deep_sleep', $feeling_of_deep_sleep, PDO::PARAM_INT);
        $stmt->bindValue(':sleep_management_assessment', $sleep_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}