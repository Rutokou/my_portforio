<?php
/**
 * 設定クラス
 */
class Config
{
    /** ワンタイムトークン **/

    /** @var int openssl_random_pseudo_bytes()で使用する文字列の長さ */
    const RANDOM_PSEUDO_STRING_LENGTH = 32;

    /** メッセージ関連 **/

    /** @var string ワンタイムトークンが一致しないとき */
    const MSG_INVALID_PROCESS = '不正な処理が行われました。';

    /** @var string 例外がスローされたときのエラーメッセージ */
    const MSG_EXCEPTION = '申し訳ございません。エラーが発生しました。';

    /** @var string ユーザーが重複しているときのメッセージ */
    const MSG_USER_DUPLICATE = '既に同じメールアドレスが登録されています。';

    /** @var string ログイン失敗 */
    const MSG_USER_LOGIN_FAILURE = 'メールアドレス、または、パスワードに誤りがあります。';

    /** @var string ログイン試行回数オーバー */
    const MSG_USER_LOGIN_TRY_TIMES_OVER = 'ログインできません';

    /** @var string アップロード失敗 */
    const MSG_UPLOAD_FAILURE = 'アップロードに失敗しました。';
}
