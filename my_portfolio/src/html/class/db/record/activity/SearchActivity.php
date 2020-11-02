<?php

/**
 * 活動記録検索クラス
 */
class SearchActivity extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 活動記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getActivityBySearchAll(string $search, string $firstdate, string $lastdate)
    {
        $sql = 'select ';
        // activity_managementテーブル
        $sql .= 'activity_management.id,';
        $sql .= 'activity_management.registration_date,';
        $sql .= 'activity_management.activity,';
        $sql .= 'activity_management.evaluated,';
        $sql .= 'activity_management.activity_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from activity_management ';
        $sql .= 'join users ';
        $sql .= 'on activity_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where activity_management.is_deleted=0 ';
        $sql .= "and (";
        // activity_managementテーブルから検索
        $sql .= "activity_management.activity like :activity ";
        $sql .= "or activity_management.evaluated like :evaluated ";
        $sql .= "or activity_management.activity_management_assessment like :activity_management_assessment";
        $sql .= ") ";
        $sql .= 'and ';
        $sql .= 'activity_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by activity_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':firstdate', $firstdate, PDO::PARAM_STR);
        $stmt->bindValue(':lastdate', $lastdate, PDO::PARAM_STR);
        $stmt->bindValue(':activity', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $likeWord, PDO::PARAM_INT);
        $stmt->bindValue(':activity_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 活動記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getActivityBySearch(string $search)
    {
        $sql = 'select ';
        // activity_managementテーブル
        $sql .= 'activity_management.id,';
        $sql .= 'activity_management.registration_date,';
        $sql .= 'activity_management.activity,';
        $sql .= 'activity_management.evaluated,';
        $sql .= 'activity_management.activity_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from activity_management ';
        $sql .= 'join users ';
        $sql .= 'on activity_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where activity_management.is_deleted=0 ';
        $sql .= "and (";
        // activity_managementテーブルから検索
        $sql .= "activity_management.activity like :activity ";
        $sql .= "or activity_management.evaluated like :evaluated ";
        $sql .= "or activity_management.activity_management_assessment like :activity_management_assessment";
        $sql .= ") ";
        $sql .= 'order by activity_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = "%" . $search . "%";

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':activity', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $likeWord, PDO::PARAM_INT);
        $stmt->bindValue(':activity_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 活動記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getActivityBySearchDate(string $firstdate, string $lastdate)
    {
        $sql = 'select ';
        // activity_managementテーブル
        $sql .= 'activity_management.id,';
        $sql .= 'activity_management.registration_date,';
        $sql .= 'activity_management.activity,';
        $sql .= 'activity_management.evaluated,';
        $sql .= 'activity_management.activity_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from activity_management ';
        $sql .= 'join users ';
        $sql .= 'on activity_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where activity_management.is_deleted=0 ';
        $sql .= 'and ';
        $sql .= 'activity_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by activity_management.registration_date desc';

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
