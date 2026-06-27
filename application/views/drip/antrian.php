<div class="page active" id="antrian">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="antrian-title mb-5">
                    <h1 class="display-1 fw-black">NOMOR<br>ANTRIAN <span class="text-red">LO*</span></h1>
                </div>

                <div class="antrian-card bg-warning p-4 rounded position-relative" id="antrianCard" style="border: 2px solid var(--dark);">
                    <div class="text-center">
                        <div class="small text-uppercase text-dark-50">drip* coffee · purwokerto</div>
                        <hr class="my-3 w-25 mx-auto">

                        <!-- Data dikirim dari PHP / Database -->
                        <?php if ($active_order): ?>
                            <div id="antrianContent" data-server-order="1">
                                <div id="antrianNum" class="display-1 fw-black"><?= $active_order['queue_number'] ?></div>
                                <div class="small text-uppercase text-dark-50">nomor antrian lo</div>

                                <div class="antrian-order-list bg-white bg-opacity-25 rounded p-3 my-3 text-start">
                                    <!-- List menu akan dimuat otomatis -->
                                    <div class="small text-secondary mb-1">Order ID: <?= $active_order['id'] ?></div>
                                    <div class="small text-secondary mb-1">Meja: <?= $active_order['table_number'] ?></div>
                                    <div class="small text-secondary mb-1">Total: Rp <?= number_format($active_order['total'], 0, ',', '.') ?></div>
                                </div>

                                <div class="antrian-status bg-dark text-white p-3 rounded text-start">
                                    <div class="fw-bold text-uppercase mb-2">Pesanan diterima, dimohon menunggu</div>
                                    <div class="small text-white-50">Konfirmasi pesanan jika dirasa lama, mohon maaf.</div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Data fallback ke LocalStorage via JS jika tidak ada session aktif dari PHP -->
                            <div id="antrianEmpty" class="py-4">
                                <p class="fst-italic text-dark-50">belum ada pesanan<br>
                                    <span class="small">— pesan dulu yuk</span>
                                </p>
                            </div>

                            <div id="antrianContent" style="display:none;">
                                <div id="antrianNum" class="display-1 fw-black">—</div>
                                <div class="small text-uppercase text-dark-50">nomor antrian lo</div>

                                <div class="antrian-order-list bg-white bg-opacity-25 rounded p-3 my-3 text-start"
                                    id="antrianOrderList"></div>

                                <div class="antrian-status bg-dark text-white p-3 rounded text-start">
                                    <div class="fw-bold text-uppercase mb-2">Pesanan diterima, dimohon menunggu</div>
                                    <div class="small text-white-50">Konfirmasi pesanan jika dirasa lama, mohon maaf.</div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
