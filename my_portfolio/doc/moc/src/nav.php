<?php
require_once('./config/PathConfig.php');
?>
<!-- サイドメニュー -->
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="<?= PathConfig::PATH_NAME ?>/navbar_index.php">ホーム</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./record/meal/meal.php">食事</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./record/sleep/sleep.php">睡眠</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li>
</ul>