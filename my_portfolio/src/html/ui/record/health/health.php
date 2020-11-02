<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../class/util/require_once/RecordRequireUtil.php');
RecordRequireUtil::recordRequireOnce();

// 健康管理記録
require_once('../../../class/db/record/health/SelectHealth.php');

// 健康管理検索クラス
require_once('../../../class/db/record/health/SearchHealth.php');

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

    if ($_GET) {
        // GETパラメータのサニタイジング
        $get = SaftyUtil::sanitize($_GET);

        if (!empty($_GET['search']) && (!empty($_GET['firstdate']) && !empty($_GET['lastdate']))) {
            // GETにキーワードと日付が入力されていれば検索
            $search = $get['search'];
            $firstdate = $get['firstdate'];
            $lastdate = $get['lastdate'];
            $searchAll = true;
            $searchHealthAll = new SearchHealth();
            $list = $searchHealthAll->getHealthBySearchAll($search, $firstdate, $lastdate);
        } elseif (!empty($_GET['search'])) {
            // GETにキーワードのみ入力されているときは、検索
            $search = $get['search'];
            $isSearch = true;
            $searchHealth = new SearchHealth();
            $list = $searchHealth->getHealthBySearch($search);
        } elseif (!empty($_GET['firstdate']) && !empty($_GET['lastdate'])) {
            // GETに日付のみあるときは、検索
            $firstdate = $get['firstdate'];
            $lastdate = $get['lastdate'];
            $isSearchDate = true;
            $searchHealthDate = new SearchHealth();
            $list = $searchHealthDate->getHealthBySearchDate($firstdate, $lastdate);
        }
    }

    if (isset($_GET['reset'])) {
        $search = "";
        $firstdate = "";
        $lastdate = "";
        $isSearch = false;
        $isSearchDate = false;
        $searchAll = false;
    }

    if ((!$isSearch && !$isSearchDate && !$searchAll)) {
        $db = new SelectHealth();
        // GETに項目がないときは、レコードを全件取得（期限日の古いものから並び替える）
        $list = $db->selectHealth();
    }
} catch (Exception $e) {
    var_dump($e);
    exit;
}
?>
<!doctype html>
<html lang="jp">

<head>
    <?php require_once('../../../htmlUtil/metadate.php'); ?>
    <title>健康管理</title>
</head>

<body>
    <!-- コンテナ呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/health/health_container.php'); ?>

    <!-- ホーム -->
    <div class="tab-pane fade show active" id="health" role="tabpanel" aria-labelledby="v-pills-health-tab">
        <!-- 一覧とグラフのタブ -->
        <?php require_once('../../../htmlUtil/main_tab.php'); ?>

        <div class="tab-content" id="myTabContent">
            <!-- テーブル -->
            <!-- テーブルタブ -->
            <?php require_once('../../../htmlUtil/record/table/tableTabBegin.php'); ?>

            <h3>健康管理（バイタル）</h3>
            <a href="<?= Path::RECORD_PATH ?>/health/input_form/health_input_form.php" class="nav-link">新規作成</a>
            <?php if (empty($list)) : ?>
                <!-- まだデータはありませんと表示 -->
                <?php require_once('../../../htmlUtil/record/no_data.php'); ?>
            <?php else : ?>
                <!-- テーブルクラス -->
                <?php require_once('../../../htmlUtil/record/table/tableClassBegin.php'); ?>

                <thead>
                    <tr>
                        <th scope="col">作成日</th>
                        <th scope="col">体温</th>
                        <th scope="col">最高血圧 / 最低血圧</th>
                        <th scope="col">脈拍</th>
                        <th scope="col">体重</th>
                        <th scope="col">気付いたこと</th>
                        <th scope="col">機能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $v) : ?>
                        <tr>
                            <th scope="row"><?= $v['registration_date'] ?></th>
                            <td><?= $v['body_temperature'] ?>℃</td>
                            <td><?= $v['systolic_blood_pressure'] ?> / <?= $v['diastolic_blood_pressure'] ?>mmHg</td>
                            <td><?= $v['blood_pulse'] ?>回/分</td>
                            <td><?= $v['body_weight'] ?>Kg</td>
                            <td><?= nl2br($v['health_management_assessment']) ?></td>
                            <td>
                                <form action="./update_item/update_health.php" method="get">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input type="submit" value="更新">
                                </form>
                                <form action="./delete/delete_health.php" method="get">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input type="submit" value="削除" name="delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <!-- クラス終了 -->
                <?php require_once('../../../htmlUtil/record/table/tableClassEnd.php'); ?>
            <?php endif ?>
            <!-- テーブルタブ終了 -->
            <?php require_once('../../../htmlUtil/record/table/tableTabEnd.php'); ?>

            <!-- グラフ -->
            <div class="tab-pane" id="graph" role="tabpanel" aria-labelledby="graph-tab">ここに健康管理のグラフを表示</div>
        </div>
    </div>
    <!-- コンテナ終了、スクリプトの呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/end_container.php'); ?>
</body>

</html>