<?php

/**
 * 活動記録更新クラス
 */
class UpdateHealth extends Dbc
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
    public function updateHealthSelect(int $id)
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
        $sql .= 'health_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from health_management ';
        $sql .= 'join users ';
        $sql .= 'on health_management.user_id = users.id ';
        $sql .= 'where health_management.id=:id';

        // SQLを実行する準備
        $stmt = $this->dbh->prepare($sql);

        // idの割り当て
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // SQL実行
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 健康管理記録の更新
     *
     * @param integer $id
     * @param string $registration_date
     * @param string $body_temperature
     * @param string $systolic_blood_pressure
     * @param string $diastolic_blood_pressure
     * @param string $blood_pulse
     * @param string $body_weight
     * @return void
     */
    public function updateHealth(int $id, string $registration_date, string $body_temperature, string $systolic_blood_pressure, string $diastolic_blood_pressure, string $blood_pulse, string $body_weight, string $health_management_assessment)
    // finished_dateの引数はnullかdateの日付が入っているから型宣言は何も指定しない
    {
        $sql = 'update health_management set ';
        $sql .= 'registration_date=:registration_date,';
        $sql .= 'body_temperature=:body_temperature,';
        $sql .= 'systolic_blood_pressure=:systolic_blood_pressure,';
        $sql .= 'diastolic_blood_pressure=:diastolic_blood_pressure,';
        $sql .= 'blood_pulse=:blood_pulse,';
        $sql .= 'body_weight=:body_weight,';
        $sql .= 'health_management_assessment=:health_management_assessment ';
        $sql .= 'where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        // idをwhereで検索する場合もbindvalueでidを割り当てる
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // 以下から作業項目を更新するために引数を割り当てる
        $stmt->bindValue(':registration_date', $registration_date, PDO::PARAM_STR);
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
