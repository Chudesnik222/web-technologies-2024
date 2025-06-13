<ul>
    <?php foreach ($menus as $item): ?>
        <li>
            <a href="<?= $item['link'] ?>"><?= $item['title'] ?></a>
            <?php if (!empty($item['children'])): ?>
                <ul>
                    <?php foreach ($item['children'] as $child): ?>
                        <li><a href="<?= $child['link'] ?>"><?= $child['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>