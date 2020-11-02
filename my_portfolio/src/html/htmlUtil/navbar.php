<!-- サイドメニュー -->
<ul class="accordion nav flex-column">
    <li class="nav-item">
        <ul class="nav flex-column">
            <!-- <li class="nav-item">
                <a class="nav-link active" href="<?= Path::UI_PATH ?>/index.php">ホーム</a>
            </li> -->
            <a href="#record" class="nav-link dropdown-toggle" data-toggle="collapse" aria-expanded="false" role="button" aria-haspopup="true">記録
            </a>
            <ul id="record" class="collapse list-unstyled pl-3" data-parent=".accordion">

                <li class="nav-item">
                    <a class="nav-link" href="<?= Path::RECORD_PATH ?>/meal/meal.php">食事</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Path::RECORD_PATH ?>/sleep/sleep.php">睡眠</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Path::RECORD_PATH ?>/activity/activity.php">活動</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Path::RECORD_PATH ?>/health/health.php">健康管理</a>
                </li>
            </ul>
        </ul>
    </li>
</ul>