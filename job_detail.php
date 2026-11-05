<?php
require_once 'config/db.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// İlan ID'sini al
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$ilan_id = intval($_GET['id']);

// İlan bilgilerini veritabanından çek
$stmt = $pdo->prepare("SELECT i.*, k.ad, k.soyad, k.email 
                       FROM ilanlar i 
                       JOIN kullanıcı k ON i.isveren_id = k.id 
                       WHERE i.ilan_id = ?");
$stmt->execute([$ilan_id]);
$ilan = $stmt->fetch(PDO::FETCH_ASSOC);

// İlan bulunamazsa ana sayfaya yönlendir
if (!$ilan) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<style>
.job-detail-section {
    max-width: 900px;
    margin: 50px auto;
    background: rgba(255, 255, 255, 0.08);
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(12px);
    color: #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
}

.job-header {
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.job-title {
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 10px;
}

.job-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #ccc;
    font-size: 14px;
}

.job-category {
    background: rgba(0, 191, 255, 0.2);
    padding: 4px 12px;
    border-radius: 20px;
    color: #00bfff;
    font-size: 14px;
    display: inline-block;
}

.job-content {
    margin-bottom: 30px;
}

.job-description {
    font-size: 16px;
    line-height: 1.8;
    color: #e0e0e0;
    margin-bottom: 30px;
    white-space: pre-line;
}

.employer-info {
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 12px;
    margin-top: 30px;
}

.employer-title {
    font-size: 18px;
    color: #fff;
    margin-bottom: 15px;
    font-weight: 600;
}

.employer-details p {
    margin: 8px 0;
    color: #ccc;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #00bfff;
    text-decoration: none;
    margin-top: 20px;
    padding: 10px 20px;
    border: 1px solid rgba(0, 191, 255, 0.3);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(0, 191, 255, 0.1);
    transform: translateX(-5px);
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn-apply {
    background: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.3s;
}

.btn-apply:hover {
    background: #218838;
}

@media (max-width: 768px) {
    .job-detail-section {
        margin: 20px;
        padding: 25px;
    }
    
    .job-title {
        font-size: 24px;
    }
    
    .job-meta {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<section class="job-detail-section">
    <a href="index.php" class="back-link">
        ← Tüm İlanlara Dön
    </a>

    <div class="job-header">
        <h1 class="job-title"><?= htmlspecialchars($ilan['ilan_baslik']) ?></h1>
        
        <div class="job-meta">
            <div class="meta-item">
                <span>📅</span>
                <span><?= date("d.m.Y H:i", strtotime($ilan['olusturulma_tarihi'])) ?></span>
            </div>
            <div class="meta-item">
                <span>👤</span>
                <span><?= htmlspecialchars($ilan['ad'] . ' ' . $ilan['soyad']) ?></span>
            </div>
        </div>
        
        <div class="job-category">
            <?= htmlspecialchars($ilan['kategori']) ?>
        </div>
    </div>

    <div class="job-content">
        <div class="job-description">
            <?= nl2br(htmlspecialchars($ilan['ilan_aciklama'])) ?>
        </div>

        <div class="action-buttons">
            <a href="mailto:<?= htmlspecialchars($ilan['email']) ?>?subject=<?= rawurlencode($ilan['ilan_baslik']) ?> İlanı İçin Başvuru" 
               class="btn-apply">
                📧 Başvur
            </a>
        </div>
    </div>

    <div class="employer-info">
        <h3 class="employer-title">İşveren Bilgileri</h3>
        <div class="employer-details">
            <p><strong>Ad Soyad:</strong> <?= htmlspecialchars($ilan['ad'] . ' ' . $ilan['soyad']) ?></p>
            <p><strong>İletişim:</strong> <?= htmlspecialchars($ilan['email']) ?></p>
            <p><strong>İlan Tarihi:</strong> <?= date("d.m.Y", strtotime($ilan['olusturulma_tarihi'])) ?></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
