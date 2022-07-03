<!-- list nav -->
<div class="sidebar-wrapper">
    <ul class="nav">
        <?php foreach( Views::$componentsData as $row ) : ?>
        <li class="<?= $row['is-active']?> ">
            <a href="<?= $row['href']?>">
                <i class="nc-icon <?= $row['icon']?>"></i>
                <p><?= $row['title']?></p>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>