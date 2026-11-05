<?php
require_once 'config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Giriş yapılmamışsa yönlendir
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$success = "";
$errors = [];

//  İlan silme 
if (isset($_GET['delete'])) {
    $ilan_id = intval($_GET['delete']);

    $stmt = $pdo->prepare("DELETE FROM ilanlar WHERE ilan_id = ? AND isveren_id = ?");
    $stmt->execute([$ilan_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        $success = "İlan başarıyla silindi.";
    } else {
        $errors[] = "İlan silinemedi veya size ait değil.";
    }
}

// veritabanı kullanıcı ilanı çekme
$stmt = $pdo->prepare("SELECT * FROM ilanlar WHERE isveren_id = ? ORDER BY olusturulma_tarihi DESC");
$stmt->execute([$user_id]);
$ilanlar = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<style>

.dashboard-section {
    max-width: 800px;
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.08);
    padding: 30px;
    border-radius: 20px;
    backdrop-filter: blur(12px);
    color: #fff;
}


.section-title {
    font-size: 26px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 25px;
    text-align: center;
}


.alert-success {
    background: #28a745;
    padding: 10px 15px;
    border-radius: 8px;
    color: white;
    margin-bottom: 15px;
    text-align: center;
}
.alert-danger {
    background: #dc3545;
    padding: 10px 15px;
    border-radius: 8px;
    color: white;
    margin-bottom: 15px;
    text-align: center;
}


.ilan-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.ilan-card {
    background: #ffffff10;
    border: 1px solid #ffffff20;
    border-radius: 16px;
    padding: 20px;
    color: #f5f5f5;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}
.ilan-card:hover {
    transform: translateY(-4px);
    background: #ffffff15;
}


.ilan-card h3 {
    font-size: 20px;
    color: #fff;
    margin-bottom: 8px;
}
.ilan-card .kategori {
    color: #ccc;
    margin-bottom: 8px;
}
.ilan-card .aciklama {
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 10px;
    color: #ddd;
}
.ilan-card .tarih {
    font-size: 13px;
    color: #aaa;
    margin-bottom: 10px;
}

/* --- Sil butonu --- */
.btn-delete {
    display: inline-block;
    background: #dc3545;
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.3s;
}
.btn-delete:hover {
    background: #b92d3a;
}

/* --- Boş ilan mesajı --- */
.no-jobs {
    text-align: center;
    color: #eee;
}
.no-jobs a {
    color: #00bfff;
    text-decoration: underline;
}
</style>

<section class="dashboard-section">
    <h2 class="section-title">İlanlarım</h2>

    <?php if ($success): ?>
        <div class="alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($ilanlar)): ?>
        <p class="no-jobs">
            Henüz bir ilan oluşturmadınız. 
            <a href="job_new.php">Yeni ilan oluştur</a>.
        </p>
    <?php else: ?>
        <div class="ilan-list">
            <?php foreach ($ilanlar as $ilan): ?>
                <div class="ilan-card">
                    <h3><?= htmlspecialchars($ilan['ilan_baslik']) ?></h3>
                    <p class="kategori"><strong>Kategori:</strong> <?= htmlspecialchars($ilan['kategori']) ?></p>
                    <p class="aciklama"><?= nl2br(htmlspecialchars($ilan['ilan_aciklama'])) ?></p>
                    <p class="tarih">📅 <?= date("d.m.Y H:i", strtotime($ilan['olusturulma_tarihi'])) ?></p>

                    <div class="ilan-actions">
                        <a href="dashboard.php?delete=<?= (int)$ilan['ilan_id']; ?>" 
                           onclick="return confirm('Bu ilanı silmek istediğinize emin misiniz?');"
                           class="btn-delete">
                            Sil
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>


