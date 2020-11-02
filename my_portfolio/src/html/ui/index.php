<?php
// セッションスタート
require_once('../class/util/SessionUtil.php');
SessionUtil::sessionStart();

// パス
require_once('../class/config/Path.php');

// リダイレクトロジック
require_once('../class/util/login_redirect/IndexLoginRedirect.php');
IndexLoginRedirect::indexLoginRed();
?>
<!doctype html>
<html lang="jp">

<head>
    <?php require_once('../htmlUtil/metadate.php'); ?>
    <title>PBA</title>
</head>

<body>
    <div class="container-fluid">
        <!-- ヘッダー -->
        <?php require_once('../htmlUtil/header/headerBegin.php'); ?>
        <?php require_once('../htmlUtil/record/search/searchMeal.php') ?>
        <?php require_once('../htmlUtil/header/headerEnd.php'); ?>

        <div class="row">
            <div class="col-1">
                <!-- 左サイドメニュー -->
                <?php require_once('../htmlUtil/navbar.php'); ?>
            </div>
            <div class="col-11">
                <!-- メインコンテンツ -->
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- ホーム -->
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        お知らせ
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('../htmlUtil/cdn_import.php') ?>
</body>

</html>