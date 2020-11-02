<?php

/**
 * 健康管理検索クラス
 */
class SearchHealth extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 健康管理記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getHealthBySearchAll(string $search,  string $firstdate, string $lastdate)
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
        $sql .= "and (";
        // health_managementテーブルから検索
        $sql .= 'health_management.body_temperature like :body_temperature ';
        $sql .= 'or health_management.systolic_blood_pressure like :systolic_blood_pressure ';
        $sql .= 'or health_management.diastolic_blood_pressure like :diastolic_blood_pressure ';
        $sql .= 'or health_management.blood_pulse like :blood_pulse ';
        $sql .= 'or health_management.body_weight like :body_weight ';
        $sql .= "or health_management.health_management_assessment like :health_management_assessment";
        $sql .= ") ";
        $sql .= 'and ';
        $sql .= 'health_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by health_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':firstdate', $firstdate, PDO::PARAM_STR);
        $stmt->bindValue(':lastdate', $lastdate, PDO::PARAM_STR);
        $stmt->bindValue(':body_temperature', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':systolic_blood_pressure', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':diastolic_blood_pressure', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':blood_pulse', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':body_weight', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':health_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 健康管理記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getHealthBySearch(string $search)
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
        $sql .= "and (";
        // health_managementテーブルから検索
        $sql .= 'health_management.body_temperature like :body_temperature ';
        $sql .= 'or health_management.systolic_blood_pressure like :systolic_blood_pressure ';
        $sql .= 'or health_management.diastolic_blood_pressure like :diastolic_blood_pressure ';
        $sql .= 'or health_management.blood_pulse like :blood_pulse ';
        $sql .= 'or health_management.body_weight like :body_weight ';
        $sql .= "or health_management.health_management_assessment like :health_management_assessment";
        $sql .= ") ";
        $sql .= 'order by health_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':body_temperature', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':systolic_blood_pressure', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':diastolic_blood_pressure', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':blood_pulse', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':body_weight', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':health_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * 健康管理記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getHealthBySearchDate(string $firstdate, string $lastdate)
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
        // health_managementテーブルから検索
        $sql .= 'and ';
        $sql .= 'health_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by health_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':firstdate', $firstdate, PDO::PARAM_STR);
        $stmt->bindValue(':lastdate', $lastdate, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
