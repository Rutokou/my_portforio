<?php

/**
 * 食事記録検索クラス
 */
class SearchMeal extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 食事記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param string $search
     * @param string $firstdate
     * @param string $lastdate
     * @return array
     */
    public function getMealBySearchAll(string $search, string $firstdate, string $lastdate)
    {
        $sql = 'select ';
        // meal_managementテーブル
        $sql .= 'meal_management.id,';
        $sql .= 'meal_management.registration_date,';
        $sql .= 'meal_management.breakfast,';
        $sql .= 'meal_management.lunch,';
        $sql .= 'meal_management.dinner,';
        $sql .= 'meal_management.evaluated,';
        $sql .= 'meal_management.meal_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from meal_management ';
        $sql .= 'join users ';
        $sql .= 'on meal_management.user_id = users.id ';
        //is_deletedの値が0のカラムを表示する
        $sql .= 'where meal_management.is_deleted=0 ';
        $sql .= 'and (';
        // meal_managementテーブルから検索
        $sql .= 'meal_management.breakfast like :breakfast ';
        $sql .= 'or meal_management.lunch like :lunch ';
        $sql .= 'or meal_management.dinner like :dinner ';
        $sql .= 'or meal_management.meal_management_assessment like :meal_management_assessment';
        $sql .= ') ';
        $sql .= 'and ';
        $sql .= 'meal_management.registration_date between ';
        $sql .= ':firstdate and :lastdate ';
        $sql .= 'order by meal_management.registration_date desc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = '%' . $search . '%';

        // var_dump($likeWord);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':firstdate', $firstdate, PDO::PARAM_STR);
        $stmt->bindValue(':lastdate', $lastdate, PDO::PARAM_STR);
        $stmt->bindValue(':breakfast', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':lunch', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':dinner', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':meal_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * 食事記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param string $search
     * @return array
     */
    public function getMealBySearch(string $search)
    {
        $sql = 'select ';
        // meal_managementテーブル
        $sql .= 'meal_management.id,';
        $sql .= 'meal_management.registration_date,';
        $sql .= 'meal_management.breakfast,';
        $sql .= 'meal_management.lunch,';
        $sql .= 'meal_management.dinner,';
        $sql .= 'meal_management.evaluated,';
        $sql .= 'meal_management.meal_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from meal_management ';
        $sql .= 'join users ';
        $sql .= 'on meal_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where meal_management.is_deleted=0 ';
        $sql .= 'and (';
        // meal_managementテーブルから検索
        $sql .= 'meal_management.breakfast like :breakfast ';
        $sql .= 'or meal_management.lunch like :lunch ';
        $sql .= 'or meal_management.dinner like :dinner ';
        $sql .= 'or meal_management.evaluated like :evaluated ';
        $sql .= 'or meal_management.meal_management_assessment like :meal_management_assessment';
        $sql .= ') ';
        $sql .= 'order by meal_management.registration_date asc';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // bindParam()の第2引数には値を直接入れることができないので
        // 下記のようにして、検索ワードを変数に入れる。
        $likeWord = '%' . $search . '%';

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':breakfast', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':lunch', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':dinner', $likeWord, PDO::PARAM_STR);
        $stmt->bindValue(':evaluated', $likeWord, PDO::PARAM_INT);
        $stmt->bindValue(':meal_management_assessment', $likeWord, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 食事記録を検索条件で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param string $firstdate
     * @param string $lastdate
     * @return array
     */
    public function getMealBySearchDate(string $firstdate, string $lastdate)
    {
        $sql = 'select ';
        // meal_managementテーブル
        $sql .= 'meal_management.id,';
        $sql .= 'meal_management.registration_date,';
        $sql .= 'meal_management.breakfast,';
        $sql .= 'meal_management.lunch,';
        $sql .= 'meal_management.dinner,';
        $sql .= 'meal_management.evaluated,';
        $sql .= 'meal_management.meal_management_assessment,';
        // usersテーブル
        $sql .= 'users.id as user_id,';
        $sql .= 'users.user_name ';
        $sql .= 'from meal_management ';
        $sql .= 'join users ';
        $sql .= 'on meal_management.user_id = users.id ';
        // is_deletedの値が0のカラムを表示する
        $sql .= 'where meal_management.is_deleted=0 ';
        $sql .= 'and (';
        // meal_managementテーブルから検索
        $sql .= 'meal_management.registration_date between ';
        $sql .= ':firstdate and :lastdate';
        $sql .= ') ';
        $sql .= 'order by meal_management.registration_date asc';

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