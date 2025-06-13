<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>

    <header>
        <h1><?php echo $title; ?></h1>
    </header>

    <main>
        <section>
            <p><?php echo $content; ?></p>
            <p>Текущий год: <?php echo $current_year; ?></p>
            <p>Текущее время: <?php echo $current_time; ?></p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo $current_year; ?> My Company</p>
    </footer>

</body>
</html>
