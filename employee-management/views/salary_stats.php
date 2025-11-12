<?php

include 'views/header.php';
?>

<h2>Statistik Gaji Karyawan</h2>
<p style="margin-bottom: 2rem; color: #666;">
    Data di bawah menampilkan rata-rata, gaji tertinggi, dan gaji terendah per departemen.
    Data diambil langsung dari fungsi agregat <code>AVG()</code>, <code>MAX()</code>, dan <code>MIN()</code> di PostgreSQL.
</p>

<?php if ($stats->rowCount() > 0): ?>
    <?php
    $salary_stats = $stats->fetchAll(PDO::FETCH_ASSOC);

    $avg_global = round(array_sum(array_column($salary_stats, 'avg_salary')) / count($salary_stats));
    $max_global = max(array_column($salary_stats, 'max_salary'));
    $min_global = min(array_column($salary_stats, 'min_salary'));
    ?>

    <!-- Summary Cards -->
    <div class="dashboard-cards">
        <div class="card">
            <h3>Rata-rata Gaji Semua Dept</h3>
            <div class="number">Rp <?= number_format($avg_global, 0, ',', '.'); ?></div>
        </div>
        <div class="card">
            <h3>Gaji Tertinggi (Global)</h3>
            <div class="number">Rp <?= number_format($max_global, 0, ',', '.'); ?></div>
        </div>
        <div class="card">
            <h3>Gaji Terendah (Global)</h3>
            <div class="number">Rp <?= number_format($min_global, 0, ',', '.'); ?></div>
        </div>
    </div>

    <!-- Tabel Statistik Gaji -->
    <table class="data-table" style="margin-top: 2rem;">
        <thead>
            <tr>
                <th>Departemen</th>
                <th>Rata-rata Gaji</th>
                <th>Gaji Tertinggi</th>
                <th>Gaji Terendah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salary_stats as $dept): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($dept['department']); ?></strong></td>
                    <td>Rp <?= number_format($dept['avg_salary'], 0, ',', '.'); ?></td>
                    <td>Rp <?= number_format($dept['max_salary'], 0, ',', '.'); ?></td>
                    <td>Rp <?= number_format($dept['min_salary'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Visualisasi -->
    <div style="margin-top: 3rem;">
        <h3>Visualisasi Gaji Rata-rata per Departemen</h3>
        <div style="background: white; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #007bff;">
            <?php foreach ($salary_stats as $dept): ?>
                <div style="margin: 0.5rem 0;">
                    <div style="display: flex; justify-content: space-between;">
                        <span><?= htmlspecialchars($dept['department']); ?></span>
                        <span>Rp <?= number_format($dept['avg_salary'], 0, ',', '.'); ?></span>
                    </div>
                    <div style="background: #eee; border-radius: 4px; height: 20px;">
                        <div style="
                            background: #007bff; 
                            height: 100%; 
                            border-radius: 4px; 
                            width: <?= ($dept['avg_salary'] / $max_global) * 100; ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php else: ?>
    <div style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
        <p style="font-size: 1.2rem; color: #666;">❌ Tidak ada data gaji.</p>
        <p style="color: #999;">Pastikan sudah ada data karyawan dan tabel <code>employees</code> terisi.</p>
        <a href="index.php?action=create" class="btn btn-primary" style="margin-top: 1rem;">Tambah Data Karyawan</a>
    </div>
<?php endif; ?>

<div style="margin-top: 2rem; padding: 1rem; background: #e7f3ff; border-radius: 5px;">
    <strong>Informasi:</strong>
    Data ini di-generate secara real-time dari VIEW PostgreSQL yang menggunakan fungsi agregat <code>AVG()</code>, <code>AVG()</code>, <code>MIN()</code>, <code>MAX()</code>, dan <code>GROUP BY</code>.
</div>

<?php include 'views/footer.php'; ?>
