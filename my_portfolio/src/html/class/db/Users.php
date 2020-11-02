<?php
/**
 * ユーザーテーブルクラス
 */
class Users extends Dbc
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // 親クラスのコンストラクタの呼び出し
        parent::__construct();
    }

    /**
     * 新規ユーザー追加
     *
     * @param string $email
     * @param string $password
     * @param string $name
     * @return bool
     */
    public function addUser(string $email, string $password, string $name): bool
    {
        // 同じメールアドレスのユーザーがいないか調べる
        if (!empty($this->findUserByEmail($email))) {
            // 同じメールアドレスのユーザーが存在したらfalseを返却
            return false;
        }

        // パスワードをハッシュ化する
        $password = password_hash($password, PASSWORD_DEFAULT);

        // レコードをインサートする
        $sql = 'insert into users (mail_address, pass, user_name)';
        $sql .= ' values ';
        $sql .= '(:mail_address, :pass, :user_name)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':mail_address', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $password, PDO::PARAM_STR);
        $stmt->bindValue(':user_name', $name, PDO::PARAM_STR);
        $stmt->execute();

        // 処理が終了したらtrueを返却
        return true;
    }

    /**
     * メールアドレスとパスワードが一致するユーザーを取得する
     *
     * @param string $email
     * @param string $passord
     * @return array ユーザーの連想配列（一致しないユーザーがなかったときは、空の配列
     */
    public function getUser(string $email, string $passord): array
    {
        $rec = $this->findUserByEmail($email);
        // 空の配列が返却されたとき
        if (empty($rec)) {
            return [];
        }

        // パスワードの照合
        if (password_verify($passord, $rec['pass'])) {
            // 照合できたら、ユーザーの連想配列を返却
            return $rec;
        }
        // 照合できなかったときは、空の配列を返却
        return [];
    }

    /**
     * 同一のメールアドレスのユーザーを探す
     *
     * @param string $email
     * @return array ユーザーの連想配列
     */
    private function findUserByEmail(string $email): array
    {
        $sql = 'select * from users where mail_address=:mail_address';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':mail_address', $email, PDO::PARAM_STR);
        $stmt->execute();
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        // falseが返却されたときは、空の配列を返却
        if (empty($rec)) {
            return [];
        }
        return $rec;
    }

    /**
     * ユーザー情報取得
     *
     * @return array
     */
    public function getUsersInfo()
    {
        $sql = 'select id from users';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
