<?php
// セッションスタート
require_once('../../class/util/SessionUtil.php');
SessionUtil::sessionStart();

// セッションに保存されているユーザー情報を削除する
unset($_SESSION['user']);

// セッションに保存されているログインユーザー名を削除する
unset($_SESSION['login']);

// セッションに保存されているエラーメッセージを削除する
unset($_SESSION['msg']['err']);

// login.phpへリダイレクト
header('Location: ./login.php');
exit;
