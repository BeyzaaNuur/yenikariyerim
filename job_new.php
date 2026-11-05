<?php
require_once 'config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Kullanıcı giriş yapmamışsa yönlendir
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$errors = [];
$success = "";

// Form gönderildiyse:
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ilan_baslik = trim($_POST['ilan_baslik']);
    $kategori = trim($_POST['kategori']);
    $ilan_aciklama = trim($_POST['ilan_aciklama']);
    $isveren_id = $_SESSION['user']['id'];

    if (empty($ilan_baslik) || empty($kategori) || empty($ilan_aciklama)) {
        $errors[] = "Lütfen tüm alanları doldurun.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO ilanlar (isveren_id, ilan_baslik, kategori, ilan_aciklama, olusturulma_tarihi) 
                                   VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$isveren_id, $ilan_baslik, $kategori, $ilan_aciklama]);
            $success = "İlan başarıyla eklendi! Yönlendiriliyorsunuz...";
            header("refresh:2;url=dashboard.php");
        } catch (PDOException $e) {
            $errors[] = "Bir hata oluştu: " . $e->getMessage();
        }
    }
}

include 'includes/header.php';
?>

<section class="form-section form-glass">
    <form method="POST" class="form-box">
        <div class="icon-user"></div>
        <h2>Yeni İlan Oluştur</h2>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <label>İlan Başlığı *</label>
        <input type="text" name="ilan_baslik" placeholder="Örneğin: Web Tasarım Uzmanı Aranıyor" required />

        <label>Kategori *</label>
        <input type="text" name="kategori" placeholder="Örneğin: Grafik Tasarım, Yazılım, Pazarlama" required />

        <label>Açıklama *</label>
        <textarea name="ilan_aciklama" rows="5" placeholder="İlan açıklamasını yazın..." required></textarea>

        <button type="submit" class="btn-submit">İlanı Yayınla</button>

        <div class="form-footer flex-between">
            <a href="dashboard.php">İlanlarımı Gör</a>
        </div>
    </form>
</section>

<?php include 'includes/footer.php'; ?>


