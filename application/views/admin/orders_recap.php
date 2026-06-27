<div class="container py-5 admin-dashboard">
    <div class="page-title mb-5">
        <h1 class="display-1 fw-black">REKAP<br>PESANAN<span class="text-red">*</span></h1>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Total Pesanan Selesai</h5>
                    <h3 class="fw-black text-red mb-0"><?= $total_orders ?> Pesanan</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Total Penghasilan</h5>
                    <h3 class="fw-black text-success mb-0">Rp <?= number_format($total_revenue, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-3" style="border: 2px solid var(--dark); border-radius: 4px; background: white;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center gap-2 mb-3">
                <h5 class="fw-bold mb-0">Seluruh Rekapan Pesanan</h5>
                <a href="<?= site_url('admin') ?>" class="btn btn-outline-dark btn-sm" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Kembali</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" style="border: 2px solid var(--dark);">
                    <thead class="table-dark">
                        <tr>
                            <th>No. Antrean</th>
                            <th>Order ID</th>
                            <th>Meja</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr><td colspan="7" class="text-center text-secondary py-4">Belum ada pesanan selesai.</td></tr>
                        <?php endif; ?>
                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td data-label="No. Antrean" class="fw-bold"><?= $order['queue_number'] ?></td>
                                <td data-label="Order ID"><?= $order['id'] ?></td>
                                <td data-label="Meja">Meja <?= $order['table_number'] ?></td>
                                <td data-label="Total" class="fw-bold text-success">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                <td data-label="Metode" class="text-uppercase"><?= $order['payment_method'] ?></td>
                                <td data-label="Status"><span class="badge bg-success border border-dark" style="border-radius: 4px;">SELESAI</span></td>
                                <td data-label="Tanggal"><?= date('d F Y H:i', strtotime($order['updated_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
