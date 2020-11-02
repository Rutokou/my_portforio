<!doctype html>
<html lang="jp">

<head>
    <?php require_once('./htmlUtil/metadate.php'); ?>
    <title>ナビバー（仮）</title>
</head>

<body>
    <div class="container-fluid">
        <!-- ヘッダー -->
        <?php require_once('./menubar/header.php') ?>

        <div class="row">
            <div class="col-2">
                <!-- 左サイドメニュー -->
                <?php require_once('./nav.php'); ?>
            </div>
            <div class="col-9">
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

    <?php require_once('./htmlUtil/cdn_import.php') ?>
</body>

</html>