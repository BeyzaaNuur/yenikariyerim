<?php
require_once 'config/db.php';
if(session_status() === PHP_SESSION_NONE) session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $sifre = $_POST['password'];

    if (!$email || !$sifre) {
        $errors[] = "Lütfen email ve şifrenizi giriniz.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM kullanıcı WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($sifre, $user['sifre'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'ad' => $user['ad'],
                'soyad' => $user['soyad'],
                'email' => $user['email']
            ];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = "Email veya şifre hatalı.";
        }
    }
}

include 'includes/header.php';
?>

<section class="form-section form-glass">
    <form action="" method="POST" class="form-box">
        <div class="icon-user"></div>
        <h2>Üye Girişi</h2>

        <?php if (isset($_GET['registered'])): ?>
            <div class="alert alert-success">Kaydınız oluşturuldu giriş yapabilirsiniz.</div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?=htmlspecialchars($error)?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif; ?>

        <label>Email *</label>
        <input type="email" name="email" placeholder="Emailinizi Girin" required autocomplete="username" />

        <label>Şifre *</label>
        <input type="password" name="password" placeholder="Şifrenizi Girin" required autocomplete="current-password" />

        <button type="submit" class="btn-submit">Giriş Yapın</button>

        <div class="form-footer flex-between">
            <span>Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></span>
        </div>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
