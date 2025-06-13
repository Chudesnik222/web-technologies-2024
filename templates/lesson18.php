<?php if(!(isset($_GET['task']) && $_GET['task'] == 'three')): ?>
    <div class="main">
        <?php foreach($tasks as $task): ?>
            <?php if (count($task) > 1): ?>
                <div>
                    <?php foreach($task as $lesson): ?>
                        <p><?= $lesson ?></p>
                    <?php endforeach;?>
                </div>
            <?php endif; ?>
        <?php endforeach;?>
<?php endif; ?>

<?php if((isset($_GET['task']) && $_GET['task'] == 'three') || (!isset($_GET['task']))): ?>
        <div>
            <form method="post">
                <label for="text">Введите текст на русском:</label><br>
                <textarea name="text" id="text"><?= htmlspecialchars($text ?? '') ?></textarea><br><br>
                <input type="submit" value="Транслитерировать">
            </form>

            <?php if (!empty($translit)): ?>
                <div class="result">
                    <strong>Результат:</strong><br>
                    <?= nl2br(htmlspecialchars($translit)) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>            
<?php endif; ?>