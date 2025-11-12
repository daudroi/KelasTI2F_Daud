<?php
include 'views/header.php';
?>

<h2>Statistik Masa Kerja Karyawan</h2>
<p style="margin-bottom: 2rem; color: #666;">
    Data di bawah menunjukkan rata-rata, maksimum, dan minimum masa kerja karyawan per departemen.
</p>

<?php if ($stats->rowCount() > 0): ?>
    <?php
    // Fetch semua data menjadi array
    $tenure_stats = $stats->fetchAll(PDO::FETCH_ASSOC);

    // Pastikan ada data sebelum hitung global
    if (count($tenure_stats) > 0) {
        $avg_global = round(array_sum(array_column($tenure_stats, 'avg_years_service')) / count($tenure_stats), 1);
        $max_global = max(array_column($tenure_stats, 'max_years_service'));
        $min_global = min(array_column($tenure_stats, 'min_years_service'));
    } else {
        $avg_global = $max_global = $min_global = 0;
    }
    ?>

    <!-- Summary Cards -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Masa Kerja Rata-rata Semua Dept</h3>
            <div class="number"><?= $avg_global ?> tahun</div>
        </div>
        <div class="card">
            <h3>Masa Kerja Terlama</h3>
            <div class="number"><?= $max_global ?> tahun</div>
        </div>
        <div class="card">
            <h3>Masa Kerja Terpendek</h3>
            <div class="number"><?= $min_global ?> tahun</div>
        </div>
    </div>

    <!-- Tabel Statistik -->
    <table class="data-table" style="margin-top: 2rem;">
        <thead>
            <tr>
                <th>Departemen</th>
                <th>Masa Kerja Rata-rata</th>
                <th>Masa Kerja Maksimum</th>
                <th>Masa Kerja Minimum</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tenure_stats as $dept): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($dept['department']); ?></strong></td>
                    <td><?= $dept['avg_years_service'] ?> tahun</td>
                    <td><?= $dept['max_years_service'] ?> tahun</td>
                    <td><?= $dept['min_years_service'] ?> tahun</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>Tidak ada data masa kerja karyawan.</p>
<?php endif; ?>

<?php include 'views/footer.php'; ?>
