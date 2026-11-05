<?php
require_once 'config/db.php';
if(session_status() === PHP_SESSION_NONE) session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad = trim($_POST['ad']);
    $soyad = trim($_POST['soyad']);
    $email = trim($_POST['email']);
    $sifre = $_POST['sifre'];

    if (!$ad || !$soyad || !$email || !$sifre) {
        $errors[] = "Lütfen tüm alanları doldurunuz.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Geçerli bir email adresi giriniz.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM kullanıcı WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Bu mail zaten kayıtlı.";
        } else {
            $hash = password_hash($sifre, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO kullanıcı (ad, soyad, email, sifre) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$ad, $soyad, $email, $hash])) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $errors[] = "Kayıt sırasında hata oluştu.";
            }
        }
    }
}

include 'includes/header.php';
?>

<section class="form-section form-glass">
    <form action="" method="POST" class="form-box">
        <h2>Kayıt Ol</h2>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=htmlspecialchars($error)?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif; ?>

        <label>Ad *</label>
        <input type="text" name="ad" required placeholder="Adınızı giriniz"/>

        <label>Soyad *</label>
        <input type="text" name="soyad" required placeholder="Soyadınızı giriniz"/>

        <label>Email *</label>
        <input type="email" name="email" required placeholder="Email adresinizi giriniz" />

        <label>Şifre *</label>
        <input type="password" name="sifre" required placeholder="Şifrenizi giriniz" />

        <button type="submit" class="btn-submit">Kayıt Ol</button>

        <p class="form-footer">Hesabınız var mı? <a href="login.php">Giriş Yap</a></p>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
