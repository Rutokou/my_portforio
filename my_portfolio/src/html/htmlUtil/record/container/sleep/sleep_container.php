<div class="container-fluid">
    <!-- ヘッダー -->
    <?php require_once('../../../htmlUtil/header/headerBegin.php'); ?>
    <form class="form-inline mr-auto mt-2 mt-lg-0" method="get" action="./sleep.php">
    <input class="form-control mr-sm-1" type="date" name="firstdate" value="<?= $firstdate ?>">
        <input class="form-control mr-sm-1" type="date" name="lastdate" value="<?= $lastdate ?>">
        <input class="form-control mr-sm-2" type="search" placeholder="睡眠記録から検索" value="<?= $search ?>" name="search">
        <button class="btn btn-outline-secondary mr-sm-2" type="submit">検索</button>
        <button class="btn btn-outline-secondary mr-sm-2" type="submit" name="reset">リセット</button>
    </form>
    <?php require_once('../../../htmlUtil/header/headerEnd.php'); ?>

    <div class="row">
        <div class="col-1">
            <!-- 左サイドメニュー -->
            <?php require_once('../../../htmlUtil/navbar.php'); ?>
        </div>
        <div class="col-11">
            <!-- メインコンテンツ -->
            <div class="tab-content" id="v-pills-tabContent">