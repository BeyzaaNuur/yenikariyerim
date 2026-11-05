<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>yenikariyerim</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
</head>
<body>
<header>
    <nav class="navbar">
        <div class="container flex-between">
            <a href="index.php" class="logo">yenikariyerim</a>
            <ul class="menu">
                <li><a href="index.php">Anasayfa</a></li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li><a href="login.php" class="btn-login">Giriş Yap</a></li>
                    <li><a href="register.php" class="btn-register">Kayıt Ol</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="job_new.php">İlan Oluştur</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">İlanlarım</a></li>
                    <li class="username">Hoşgeldiniz, <strong><?=htmlspecialchars($_SESSION['user']['ad'])?></strong></li>
                    <li><a href="logout.php" class="btn-logout">Çıkış Yap</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
<main class="container">
