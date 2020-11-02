<?php
/**
 * 健康管理記録の新規作成クラス
 */
class InputHealth extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insertHealth(string $registration_date, int $user_id, string $body_temperature, string $systolic_blood_pressure, string $diastolic_blood_pressure, string $blood_pulse, string $body_weight, string $health_management_assessment)
    {
        $sql = 'insert health_management (';
        $sql .= 'registration_date,';
        $sql .= 'user_id,';
        $sql .= 'body_temperature,';
        $sql .= 'systolic_blood_pressure,';
        $sql .= 'diastolic_blood_pressure,';
        $sql .= 'blood_pulse,';
        $sql .= 'body_weight,';
        $sql .= 'health_management_assessment';
        $sql .= ') values (';
        $sql .= ':registration_date,';
        $sql .= ':user_id,';
        $sql .= ':body_temperature,';
        $sql .= ':systolic_blood_pressure,';
        $sql .= ':diastolic_blood_pressure,';
        $sql .= ':blood_pulse,';
        $sql .= ':body_weight,';
        $sql .= ':health_management_assessment';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':body_temperature', $body_temperature, PDO::PARAM_STR);
        $stmt->bindValue(':systolic_blood_pressure', $systolic_blood_pressure, PDO::PARAM_STR);
        $stmt->bindValue(':diastolic_blood_pressure', $diastolic_blood_pressure, PDO::PARAM_STR);
        $stmt->bindValue(':blood_pulse', $blood_pulse, PDO::PARAM_STR);
        $stmt->bindValue(':body_weight', $body_weight, PDO::PARAM_STR);
        $stmt->bindValue(':health_management_assessment', $health_management_assessment, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
    }
}