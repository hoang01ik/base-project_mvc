<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <?php if (isset($_SESSION['user'])) { ?>
            <a href="/logout">logout</a>
        <?php } else { ?>
            <a href="/login">login</a>';
        <?php } ?>
    </header>
    <main>
        admin
        <?= $content ?>
    </main>
    <footer>
        footer
    </footer>
</body>

</html>