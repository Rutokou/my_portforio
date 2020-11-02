<?php
/**
 * 活動記録の新規作成クラス
 */
class InputActivity extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insertActivity(string $registration_date, int $user_id, string $activity, int $evaluated, string $activity_management_assessment)
    {
        $sql = 'insert into activity_management (';
        $sql .= 'registration_date,';
        $sql .= 'user_id,';
        $sql .= 'activity,';
        $sql .= 'evaluated,';
        $sql .= 'activity_management_assessment';
        $sql .= ') values (';
        $sql .= ':registration_date,';
        $sql .= ':user_id,';
        $sql .= ':activity,';
        $sql .= ':evaluated,';
        $sql .= ':activity_management_assessment';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':activity', $activity, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $evaluated, PDO::PARAM_INT);
        $stmt->bindValue(':activity_management_assessment', $activity_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}