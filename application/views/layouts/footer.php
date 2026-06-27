    </div> <!-- page-container -->

    <!-- Mobile Bottom Navigation Bar -->
    <div class="mobile-nav d-flex d-lg-none justify-content-around align-items-center fixed-bottom bg-cream border-top py-2" style="z-index: 1030; box-shadow: 0 -2px 10px rgba(0,0,0,0.05);">
        <a href="<?= site_url() ?>" class="mobile-nav-link text-center text-decoration-none <?= $this->uri->segment(1) == '' ? 'active' : 'text-secondary' ?>">
            <div class="fs-4"><i class="fa-solid fa-house"></i></div>
            <span style="font-size: 10px; display: block; letter-spacing: 0.5px;">home</span>
        </a>
        <a href="<?= site_url('menu') ?>" class="mobile-nav-link text-center text-decoration-none <?= $this->uri->segment(1) == 'menu' ? 'active' : 'text-secondary' ?>">
            <div class="fs-4"><i class="fa-solid fa-mug-hot"></i></div>
            <span style="font-size: 10px; display: block; letter-spacing: 0.5px;">menu</span>
        </a>
        <a href="javascript:void(0)" class="mobile-nav-link text-center text-decoration-none position-relative text-secondary" onclick="toggleCart()">
            <div class="fs-4"><i class="fa-solid fa-cart-shopping"></i></div>
            <span style="font-size: 10px; display: block; letter-spacing: 0.5px;">keranjang</span>
            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger" id="cartCountMobile" style="font-size: 8px;">0</span>
        </a>
        <a href="<?= site_url('antrian') ?>" class="mobile-nav-link text-center text-decoration-none <?= $this->uri->segment(1) == 'antrian' ? 'active' : 'text-secondary' ?>">
            <div class="fs-4"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <span style="font-size: 10px; display: block; letter-spacing: 0.5px;">antrian</span>
        </a>
        <a href="<?= site_url('riwayat') ?>" class="mobile-nav-link text-center text-decoration-none <?= $this->uri->segment(1) == 'riwayat' ? 'active' : 'text-secondary' ?>">
            <div class="fs-4"><i class="fa-solid fa-receipt"></i></div>
            <span style="font-size: 10px; display: block; letter-spacing: 0.5px;">riwayat</span>
        </a>
    </div>
    
    <!-- Cart Drawer -->
    <div class="cart-overlay" id="cartOverlay"></div>
    <div class="cart-drawer" id="cartDrawer">
        <div class="cart-drawer-header">
            <h5 class="mb-0 fw-bold">Keranjang</h5>
            <button class="btn-close" onclick="toggleCart()"></button>
        </div>
        <div class="cart-drawer-body" id="cartItems">
            <div class="text-center py-5 text-secondary fst-italic">keranjang masih kosong nih...</div>
        </div>
        <div class="cart-drawer-footer">
            <div class="d-flex justify-content-between small mb-2"><span>Subtotal</span><span id="cartSubtotal">Rp 0</span></div>
            <div class="d-flex justify-content-between small mb-3"><span>Pajak (10%)</span><span id="cartTax">Rp 0</span></div>
            <div class="d-flex justify-content-between fw-bold mb-3"><span>Total</span><span id="cartTotalNum" class="text-red">Rp 0</span></div>
            <input type="text" id="tableInput" class="form-control mb-3" placeholder="Nomor Meja (Cth: 12)">
            <button class="btn btn-dark w-100 py-3" onclick="openPayment()">Lanjut Pembayaran →</button>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="payment-modal" id="paymentModal">
        <div class="payment-content">
            <h4 class="fw-bold mb-4">Pembayaran</h4>
            <div class="bg-light p-3 rounded mb-4">
                <div id="receiptItems" class="mb-2 border-bottom pb-2"></div>
                <div class="d-flex justify-content-between small text-secondary"><span>Subtotal</span><span id="receiptSub"></span></div>
                <div class="d-flex justify-content-between small text-secondary"><span>Pajak</span><span id="receiptTax"></span></div>
                <div class="d-flex justify-content-between fw-bold mt-2 pt-2 border-top"><span>Total</span><span id="receiptTotal" class="text-red"></span></div>
                <div class="small text-secondary mt-2">Meja: <span id="receiptTable"></span> | <span id="receiptTime"></span></div>
            </div>
            
            <h6 class="fw-bold mb-3">Pilih Metode</h6>
            <div class="d-flex justify-content-between gap-3 mb-4">
                <div class="pay-method" onclick="selectPayment('qris', this)">QRIS / E-Wallet</div>
                <div class="pay-method" onclick="selectPayment('cash', this)">Tunai (Kasir)</div>
            </div>
            
            <div id="qrSection" class="payment-section text-center">
                <div class="bg-white p-2 d-inline-block border rounded mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DRIPCOFFEEPAYMENT" alt="QRIS" width="150" height="150">
                </div>
                <p class="small text-secondary mb-1">Scan QRIS di atas untuk membayar</p>
                <h5 class="fw-bold text-red" id="qrAmount"></h5>
            </div>
            
            <div id="cashSection" class="payment-section text-center">
                <div class="display-1 mb-3"><i class="fa-solid fa-money-bill-wave"></i></div>
                <p class="small text-secondary mb-1">Silakan bayar di kasir sesuai nominal</p>
                <h5 class="fw-bold text-red" id="cashAmount"></h5>
            </div>
            
            <button id="payBtn" class="btn btn-dark w-100 py-3 mt-2" disabled onclick="confirmPayment()">pilih metode pembayaran dulu</button>
        </div>
    </div>

    <!-- Success Overlay -->
    <div class="payment-modal" id="successOverlay" style="z-index: 1070;">
        <div class="payment-content text-center py-5">
            <div class="display-1 mb-3"><i class="fa-solid fa-circle-check"></i></div>
            <h3 class="fw-bold mb-2">Pembayaran Sukses!</h3>
            <p class="text-secondary mb-4">Nomor antrian kamu:</p>
            <div class="display-2 fw-black text-red mb-4" id="successQueueNum"></div>
            <button class="btn btn-dark px-5 py-3" onclick="closeSuccess()">Tutup</button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
