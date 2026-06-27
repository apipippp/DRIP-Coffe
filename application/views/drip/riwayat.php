<div class="page active" id="riwayat">
    <div class="container py-5">
        <div class="page-title mb-5">
            <h1 class="display-1 fw-black">REKAPAN<br>ORDER<span class="text-red">*</span></h1>
        </div>
        
        <?php if ($this->session->userdata('user_id')): ?>
            <!-- Menampilkan data riwayat dari database jika login -->
            <div class="row">
                <div class="col-md-8">
                    <?php if (empty($orders)): ?>
                        <div class="text-center py-5 text-secondary">
                            <div class="display-1 mb-3 opacity-50"><i class="fa-solid fa-clipboard-list"></i></div>
                            <p class="fst-italic">belum ada riwayat orderan nih.<br>pesen kopi dulu yuk biar melek.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($orders as $o): ?>
                            <div class="card mb-3" style="border: 2px solid var(--dark); border-radius: 4px;">
                                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0 fw-bold">#<?= $o['queue_number'] ?> (ID: <?= $o['id'] ?>)</h6>
                                        <small class="text-white-50"><?= $o['created_at'] ?> · Meja <?= $o['table_number'] ?></small>
                                    </div>
                                    <span class="badge bg-success"><?= strtoupper($o['status']) ?></span>
                                </div>
                                <div class="card-body">
                                    <div class="small text-secondary mb-2"><?= $o['items'] ?></div>
                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                        <small class="text-secondary">bayar via <?= strtoupper($o['payment_method']) ?></small>
                                        <span class="h5 text-red mb-0">Rp <?= number_format($o['total'], 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Menampilkan data riwayat dari localStorage jika guest -->
            <div id="riwayatContent"></div>
        <?php endif; ?>
    </div>
</div>
