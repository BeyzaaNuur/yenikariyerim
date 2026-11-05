<?php
include 'includes/header.php';
require_once 'config/db.php';

// Kategorileri çek
$kategoriler = $pdo->query("SELECT DISTINCT kategori FROM ilanlar ORDER BY kategori")->fetchAll(PDO::FETCH_COLUMN);

// Filtreleme
$kategori = $_GET['kategori'] ?? '';
$arama = $_GET['arama'] ?? '';

$sql = "SELECT i.*, k.ad, k.soyad FROM ilanlar i JOIN kullanıcı k ON i.isveren_id = k.id WHERE 1=1";
$params = [];

if ($kategori) {
    $sql .= " AND i.kategori = ?";
    $params[] = $kategori;
}

if ($arama) {
    $sql .= " AND (i.ilan_baslik LIKE ? OR i.ilan_aciklama LIKE ?)";
    $params[] = "%$arama%";
    $params[] = "%$arama%";
}

$sql .= " ORDER BY i.olusturulma_tarihi DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$ilanlar = $stmt->fetchAll();
?>

<div class="container">
    <h1>İş İlanları</h1>

    <!-- Arama Formu -->
    <form method="GET" class="filtre-form">
        <input type="text" name="arama" placeholder="İlan ara..." value="<?= htmlspecialchars($arama) ?>">
        
        <select name="kategori">
            <option value="">Tüm Kategoriler</option>
            <?php foreach($kategoriler as $kat): ?>
                <option value="<?= htmlspecialchars($kat) ?>" <?= $kategori==$kat ? 'selected' : '' ?>><?= htmlspecialchars($kat) ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Ara</button>
        <a href="index.php">Temizle</a>
    </form>

    <!-- İlan Listesi -->
    <div class="ilan-listesi">
        <?php if(empty($ilanlar)): ?>
            <p class="uyari">İlan bulunamadı.</p>
        <?php else: ?>
            <?php foreach($ilanlar as $ilan): ?>
                <div class="ilan-karti">
                    <h3><?= htmlspecialchars($ilan['ilan_baslik']) ?></h3>
                    <p class="kategori"><?= htmlspecialchars($ilan['kategori']) ?></p>
                    <p class="isveren"><?= htmlspecialchars($ilan['ad'].' '.$ilan['soyad']) ?></p>
                    <p class="aciklama"><?= nl2br(htmlspecialchars(mb_substr($ilan['ilan_aciklama'],0,200))) ?>...</p>
                    <p class="tarih"><?= date('d.m.Y', strtotime($ilan['olusturulma_tarihi'])) ?></p>
                    <a href="job_detail.php?id=<?= $ilan['ilan_id'] ?>" class="detay-btn">İncele</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
.container { max-width: 1200px; margin: 0 auto; padding: 20px; }
h1 { text-align: center; margin-bottom: 30px; }

.filtre-form { 
    display: flex; 
    gap: 10px; 
    margin-bottom: 30px;
    flex-wrap: wrap;
}
.filtre-form input, .filtre-form select { 
    padding: 10px; 
    border: 1px solid #ddd; 
    border-radius: 5px;
    flex: 1;
    min-width: 200px;
}
.filtre-form button, .filtre-form a { 
    padding: 10px 20px; 
    background: #007bff; 
    color: white; 
    border: none; 
    border-radius: 5px; 
    text-decoration: none;
    cursor: pointer;
}
.filtre-form a { background: #6c757d; }

.ilan-listesi { display: grid; gap: 20px; }
.ilan-karti { 
    border: 1px solid #ddd; 
    padding: 20px; 
    border-radius: 10px; 
    background: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.ilan-karti h3 { margin: 0 0 10px 0; color: #333; }
.kategori { 
    background: #007bff; 
    color: white; 
    padding: 5px 10px; 
    border-radius: 15px; 
    display: inline-block;
    margin-bottom: 10px;
}
.isveren { color: #666; margin-bottom: 10px; }
.aciklama { color: #444; line-height: 1.5; margin-bottom: 10px; }
.tarih { color: #999; font-size: 0.9em; margin-bottom: 10px; }
.detay-btn { 
    display: inline-block; 
    padding: 8px 15px; 
    background: #28a745; 
    color: white; 
    text-decoration: none; 
    border-radius: 5px;
}

.uyari { 
    text-align: center; 
    padding: 40px; 
    color: #666; 
    font-size: 1.2em;
}

@media (min-width: 768px) {
    .ilan-listesi { grid-template-columns: repeat(2, 1fr); }
}
@media (min-width: 1200px) {
    .ilan-listesi { grid-template-columns: repeat(3, 1fr); }
}
</style>

<?php include 'includes/footer.php'; ?>
