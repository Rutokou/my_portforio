<?php

/**
 * 睡眠記録検索クラス
 */
class SearchSleep extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 睡眠記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getSleepBySearchAll(string $search, string $firstdate, string $lastdate)
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
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where sleep_management.is_deleted=0 ';
        $sql .= "and (";
        // sleep_managementテーブルから検索
        $sql .= "sleep_management.bedtime like :bedtime ";
        $sql .= "or sleep_management.wake_up_time like :wake_up_time ";
        $sql .= "or sleep_management.feeling_of_deep_sleep like :feeling_of_deep_sleep ";
        $sql .= "or sleep_management.sleep_management_assessment like :sleep_management_assessment";
        $sql .= ") ";
        $sql .= 'and ';
        $sql .= 'sleep_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by sleep_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':firstdate', $firstdate, PDO::PARAM_STR);
        $stmt->bindValue(':lastdate', $lastdate, PDO::PARAM_STR);
        $stmt->bindValue(':bedtime', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':wake_up_time', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':feeling_of_deep_sleep', $likeWord, PDO::PARAM_INT);
        $stmt->bindValue(':sleep_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 睡眠記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getSleepBySearch(string $search)
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
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where sleep_management.is_deleted=0 ';
        $sql .= "and (";
        // sleep_managementテーブルから検索
        $sql .= "sleep_management.bedtime like :bedtime ";
        $sql .= "or sleep_management.wake_up_time like :wake_up_time ";
        $sql .= "or sleep_management.feeling_of_deep_sleep like :feeling_of_deep_sleep ";
        $sql .= "or sleep_management.sleep_management_assessment like :sleep_management_assessment";
        $sql .= ") ";
        $sql .= 'order by sleep_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':bedtime', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':wake_up_time', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':feeling_of_deep_sleep', $likeWord, PDO::PARAM_INT);
        $stmt->bindValue(':sleep_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /**
     * 睡眠記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getSleepBySearchDate(string $firstdate, string $lastdate)
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
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where sleep_management.is_deleted=0 ';
        $sql .= 'and ';
        $sql .= 'sleep_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by sleep_management.registration_date desc';

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
