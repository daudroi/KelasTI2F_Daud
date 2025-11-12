<?php
include 'views/header.php';
?>

<h2>Ringkasan Karyawan</h2>
<p style="margin-bottom: 2rem; color: #666;">
    Data berikut menampilkan total karyawan, total gaji per bulan, dan rata-rata masa kerja.
</p>

<?php
// Ambil data overview
$overview_data = $stats->fetch(PDO::FETCH_ASSOC);

// Pastikan data ada
$total_employees = $overview_data['total_employees'] ?? 0;
$total_salary = $overview_data['total_salary'] ?? 0;
$avg_years_service = $overview_data['avg_years_service'] ?? 0;
?>

<!-- Summary Cards -->
<div class="dashboard-cards">
    <div class="card">
        <h3>Total Karyawan</h3>
        <div class="number"><?= $total_employees ?></div>
    </div>
    <div class="card">
        <h3>Total Gaji</h3>
        <div class="number">Rp <?= number_format($total_salary, 0, ',', '.'); ?></div>
    </div>
    <div class="card">
        <h3>Rata-rata Masa Kerja</h3>
        <div class="number"><?= $avg_years_service ?> tahun</div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
