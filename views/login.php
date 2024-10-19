<!-- views/TaiKhoan/login.php -->

<head>
    <title><?= $title ?></title>
</head>
<body>
    <h1>Đăng nhập</h1>

    <?php if (isset($error)): ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Đăng nhập</button>
    </form>
</body>

