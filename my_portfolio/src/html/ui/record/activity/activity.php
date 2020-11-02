<?php
// 記録画面で読み込む外部ファイル一覧を呼び出し
require_once('../../../class/util/require_once/RecordRequireUtil.php');
RecordRequireUtil::recordRequireOnce();

// 活動記録の呼び出し
require_once('../../../class/db/record/activity/SelectActivity.php');

// 活動記録検索クラス呼び出し
require_once('../../../class/db/record/activity/SearchActivity.php');

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
            $searchActivityAll = new SearchActivity();
            $list = $searchActivityAll->getActivityBySearchAll($search, $firstdate, $lastdate);
        } elseif (!empty($_GET['search'])) {
            // GETにキーワードのみ入力されているときは、検索
            $search = $get['search'];
            $isSearch = true;
            $searchActivity = new SearchActivity();
            $list = $searchActivity->getActivityBySearch($search);
        } elseif (!empty($_GET['firstdate']) && !empty($_GET['lastdate'])) {
            // GETに日付のみあるときは、検索
            $firstdate = $get['firstdate'];
            $lastdate = $get['lastdate'];
            $isSearchDate = true;
            $searchActivityDate = new SearchActivity();
            $list = $searchActivityDate->getActivityBySearchDate($firstdate, $lastdate);
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
        $db = new SelectActivity();
        // GETに項目がないときは、レコードを全件取得（期限日の古いものから並び替える）
        $list = $db->selectActivity();
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
    <title>活動</title>
</head>

<body>
    <!-- コンテナ呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/activity/activity_container.php'); ?>

    <!-- ホーム -->
    <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="v-pills-activity-tab">
        <!-- 一覧とグラフのタブ -->
        <?php require_once('../../../htmlUtil/main_tab.php'); ?>

        <div class="tab-content" id="myTabContent">
            <!-- テーブル -->
            <!-- テーブルタブ -->
            <?php require_once('../../../htmlUtil/record/table/tableTabBegin.php'); ?>

            <h3>活動</h3>
            <a href="<?= Path::RECORD_PATH ?>/activity/input_form/activity_input_form.php" class="nav-link">新規作成</a>
            <?php if (empty($list)) : ?>
                <!-- まだデータはありませんと表示 -->
                <?php require_once('../../../htmlUtil/record/no_data.php'); ?>
            <?php else : ?>
                <!-- テーブルクラス -->
                <?php require_once('../../../htmlUtil/record/table/tableClassBegin.php'); ?>
                <thead>
                    <tr>
                        <th scope="col">作成日</th>
                        <th scope="col">活動内容</th>
                        <th scope="col">評価</th>
                        <th scope="col">気付いたこと</th>
                        <th scope="col">機能</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $v) : ?>
                        <tr>
                            <th scope="row"><?= $v['registration_date'] ?></th>
                            <td><?= nl2br($v['activity']) ?></td>
                            <td><?= $v['evaluated'] ?></td>
                            <td><?= nl2br($v['activity_management_assessment']) ?></td>
                            <td>
                                <form action="./update_item/update_activity.php" method="get">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                    <input type="submit" value="更新">
                                </form>
                                <form action="./delete/delete_activity.php" method="get">
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
            <div class="tab-pane" id="graph" role="tabpanel" aria-labelledby="graph-tab">ここに活動のグラフを表示</div>
        </div>
    </div>
    <!-- コンテナ終了、スクリプトの呼び出し -->
    <?php require_once('../../../htmlUtil/record/container/end_container.php'); ?>
</body>

</html>