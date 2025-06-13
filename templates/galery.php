<?php
include_once BASE_PATH . '/engine/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $result = uploadImage($_FILES['image']);
    if ($result !== true) {
        echo "<p style='color:red;'>Ошибка: $result</p>";
    } else {
        echo "<p style='color:green;'>Файл успешно загружен!</p>";
    }
}
?>

<?php if (!empty($upload_result)): ?>
    <div class="upload-message">
        <h2><?= htmlspecialchars($upload_result) ?></h2>
    </div>
<?php endif; ?>


<h2>Загрузить изображение</h2>
<form method="POST" enctype="multipart/form-data" onsubmit="return checkFileSize()">
  <input type="file" name="image" id="imageInput" required>
  <input type="submit" value="Загрузить">
</form>

<script>
function checkFileSize() {
    const input = document.getElementById('imageInput');
    const file = input.files[0];
    const maxSize = 10 * 1024 * 1024;
    if (file && file.size > maxSize) {
        alert("Файл слишком большой. Максимум — 10 МБ.");
        return false;
    }
    return true;
}
</script>

<h2>Галерея</h2>
<div style="display: flex; flex-wrap: wrap; gap: 10px;">
    <?php
        $smallDir = BASE_PATH . '/images/small/';
        $bigDir = BASE_PATH . '/images/big/';

        $files_big = array_diff(scandir($bigDir), ['.', '..']);
        $files_small = array_diff(scandir($smallDir), ['.', '..']);
        for ($i = 2; $i < count($files_big)+2; $i++){
            $smallUrl = "/image.php?file=" . urlencode($smallDir . $files_small[$i]);

            $bigUrl = "/image.php?file=" . urlencode($bigDir . $files_big[$i]);

            echo "<a href='$bigUrl' target='_blank'>
                    <img src='$smallUrl' alt='Фото' style='border:1px solid #ccc;'>
                </a>";
        }
    ?>
</div>