<div class="container py-5 admin-dashboard">
    <div class="page-title mb-5">
        <h1 class="display-1 fw-black">ADMIN<br>DASHBOARD<span class="text-red">*</span></h1>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Total Laba Bulan Ini</h5>
                    <h3 class="fw-black text-red">Rp <?= number_format($total_income, 0, ',', '.') ?></h3>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?= site_url('admin/orders_recap') ?>" class="btn btn-outline-dark w-100 py-3" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">
                    <i class="fa-solid fa-receipt"></i> Seluruh Rekap Pesanan
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <h5 class="fw-bold mb-0">Grafik Penjualan Harian</h5>
                        <form method="GET" action="<?= site_url('admin') ?>" class="d-flex gap-2">
                            <input type="date" name="date" value="<?= $selected_date ?>" class="form-control form-control-sm" style="border: 2px solid var(--dark); border-radius: 4px;">
                            <button class="btn btn-dark btn-sm text-white" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Sortir</button>
                        </form>
                    </div>
                    <canvas id="chartDaily" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-4">
            <div class="card p-3 h-100" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Penghasilan Tanggal</h5>
                    <div class="small text-secondary mb-2"><?= date('d F Y', strtotime($selected_date)) ?></div>
                    <h3 class="fw-black text-success">Rp <?= number_format($selected_income, 0, ',', '.') ?></h3>
                    <div class="small text-secondary"><?= count($selected_orders) ?> pesanan selesai</div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Rekapan Pesanan Tanggal Ini</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="border: 2px solid var(--dark);">
                            <thead class="table-dark">
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Order ID</th>
                                    <th>Meja</th>
                                    <th>Total</th>
                                    <th>Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($selected_orders)): ?>
                                    <tr><td colspan="5" class="text-center text-secondary py-4">Belum ada pesanan selesai pada tanggal ini.</td></tr>
                                <?php endif; ?>
                                <?php foreach($selected_orders as $order): ?>
                                    <tr>
                                        <td data-label="No. Antrean" class="fw-bold"><?= $order['queue_number'] ?></td>
                                        <td data-label="Order ID"><?= $order['id'] ?></td>
                                        <td data-label="Meja">Meja <?= $order['table_number'] ?></td>
                                        <td data-label="Total" class="fw-bold text-success">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                        <td data-label="Metode" class="text-uppercase"><?= $order['payment_method'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartDaily').getContext('2d');
const dailyData = <?= json_encode($daily_data) ?>;
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: dailyData.map(d => d.hour + ':00'),
        datasets: [{
            label: 'Penjualan per Jam',
            data: dailyData.map(d => d.total),
            backgroundColor: '#C94B2C',
            borderColor: '#1C1A17',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    font: {
                        family: 'DM Mono'
                    }
                }
            }
        }
    }
});
</script>
