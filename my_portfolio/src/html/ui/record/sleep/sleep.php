<?php
// // 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../class/util/require_once/RecordRequireUtil.php');
RecordRequireUtil::recordRequireOnce();

// 睡眠記録の呼び出し
require_once('../../../class/db/record/sleep/SelectSleep.php');

// 睡眠記録検索クラス呼び出し
require_once('../../../class/db/record/sleep/SearchSleep.php');

// リダイレクトロジック
require_once('../../../class/util/login_redirect/RecordLoginRedirect.php');
RecordLoginRedirect::recordLoginRed();

try {
    // 通常の一覧表示か、検索結果かを保存するフラグ
    $search = "";
    $firstdate = "";
    $lastdate = "";
    $isSearch = false;
    $isSearchDate = false;
    $searchAll = false;

    // レコードを全件取得する
    // $list = $db->selectsleep();

    if ($_GET) {
        // GETパラメータのサニタイジング
        $get = SaftyUtil::sanitize($_GET);

        if (!empty($_GET['search']) && (!empty($_GET['firstdate']) && !empty($_GET['lastdate']))) {
            // GETにキーワードと日付が入力されていれば検索
            $search = $get['search'];
            $firstdate = $get['firstdate'];
            $lastdate = $get['lastdate'];
            $searchAll = true;
            $searchSleepAll = new SearchSleep();
            $list = $searchSleepAll->getSleepBySearchAll($search, $firstdate, $lastdate);
        } elseif (!empty($_GET['search'])) {
            // GETにキーワードのみ入力されているときは、検索
            $search = $get['search'];
            $isSearch = true;
            $searchSleep = new SearchSleep();
            $list = $searchSleep->getSleepBySearch($search);
        } elseif (!empty($_GET['firstdate']) && !empty($_GET['lastdate'])) {
            // GETに日付のみあるときは、検索
            $firstdate = $get['firstdate'];
            $lastdate = $get['lastdate'];
            $isSearchDate = true;
            $searchSleepDate = new SearchSleep();
            $list = $searchSleepDate->getSleepBySearchDate($firstdate, $lastdate);
        }
    }

    if(isset($_GET['reset'])) {
        $search = "";
        $firstdate = "";
        $lastdate = "";
        $isSearch = false;
        $isSearchDate = false;
        $searchAll = false;        
    }

    if ((!$isSearch && !$isSearchDate && !$searchAll)) {
        $db = new SelectSleep();
        // GETに項目がないときは、レコードを全件取得（期限日の古いものから並び替える）
        $list = $db->selectSleep();
    }

    // 日本標準時の現在日付を取得
    $dt = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $date = $dt->format('Y-m-d');
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>

<!doctype html>
<html lang="jp">

<head>
    <?php include('../../../htmlUtil/metadate.php'); ?>
    <title>睡眠</title>
</head>

<body>
    <!-- コンテナ呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/sleep/sleep_container.php'); ?>

    <!-- ホーム -->
    <div class="tab-pane fade show active" id="sleep" role="tabpanel" aria-labelledby="v-pills-sleep-tab">
        <!-- 一覧とグラフのタブ -->
        <?php require_once('../../../htmlUtil/main_tab.php'); ?>

        <div class="tab-content" id="myTabContent">
            <!-- テーブル -->
            <!-- テーブルタブ -->
            <?php include('../../../htmlUtil/record/table/tableTabBegin.php'); ?>

            <h3>睡眠</h3>
            <a href="<?= Path::RECORD_PATH ?>/sleep/input_form/sleep_input_form.php" class="nav-link">新規作成</a>
            <?php if (empty($list)) : ?>
                <!-- まだデータはありませんと表示 -->
                <?php include('../../../htmlUtil/record/no_data.php'); ?>
            <?php else : ?>
                <!-- テーブルクラス -->
                <?php include('../../../htmlUtil/record/table/tableClassBegin.php'); ?>
                <thead>
                    <tr>
                        <th scope="col">作成日</th>
                        <th scope="col">就寝時間</th>
                        <th scope="col">起床時間</th>
                        <th scope="col">合計睡眠時間</th>
                        <th scope="col">熟眠感</th>
                        <th scope="col">気付いたこと</th>
                        <th scope="col">機能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $v) : ?>
                        <?php
                        // UNIXタイムスタンプを取得
                        $origin = new DateTime($v['bedtime']);
                        $target = new DateTime($v['wake_up_time']);
                        // 就寝時間、起床時間の形式を変換
                        $bedTime = $origin->format('Y-m-d H:i');
                        $wakeUpTime = $target->format('Y-m-d H:i');
                        // 睡眠時間を計算
                        $interval = $origin->diff($target);
                        $sleepTime = $interval->format('%H時間%i分');
                        ?>
                        <tr>
                            <th scope="row"><?= $v['registration_date'] ?></th>
                            <td><?= $bedTime ?></td>
                            <td><?= $wakeUpTime ?></td>
                            <td><?= $sleepTime ?></td>
                            <td><?= $v['feeling_of_deep_sleep'] ?></td>
                            <td><?= nl2br($v['sleep_management_assessment']) ?></td>
                            <td>
                                <form action="./update_item/update_sleep.php" method="get">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input type="submit" value="更新">
                                </form>
                                <form action="./delete/delete_sleep.php" method="get">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input type="submit" value="削除" name="delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <!-- クラス終了 -->
                <?php include('../../../htmlUtil/record/table/tableClassEnd.php'); ?>

            <?php endif ?>
            <!-- テーブルタブ終了 -->
            <?php include('../../../htmlUtil/record/table/tableTabEnd.php'); ?>

            <!-- グラフ -->
            <div class="tab-pane" id="graph" role="tabpanel" aria-labelledby="graph-tab">ここに睡眠のグラフを表示</div>
        </div>
    </div>
    <!-- コンテナ終了、スクリプトの呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/end_container.php'); ?>

</body>

</html>