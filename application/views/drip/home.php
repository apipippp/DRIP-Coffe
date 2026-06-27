<div class="page active" id="home">
    <div class="container-fluid px-5 py-5">
        <div class="row min-vh-100 align-items-start">
            <!-- Sisi Kiri: Teks & Statistik -->
            <div class="col-lg-6">
                <div class="home-badge mb-4">
                    <span class="pulse-dot"></span> open now · 07:00–22:00
                </div>

                <div class="home-headline">
                    <div class="display-1 fw-black text-stroke">GOOD</div>
                    <div class="display-1 fw-black text-red">COFFEE</div>
                    <div class="display-1 fw-black">VIBES</div>
                </div>

                <p class="home-sub mt-4">bukan cafe biasa. tempat nongkrong buat lo yang tau bedanya V60 sama tubruk.</p>

                <div class="home-actions mt-4 d-flex gap-3">
                    <button class="btn btn-dark px-4 py-3" onclick="location.href='<?= site_url('menu') ?>'">lihat menu →</button>
                    <button class="btn btn-outline-dark px-4 py-3" onclick="location.href='<?= site_url('antrian') ?>'">cek antrian</button>
                </div>

                <div class="home-stats mt-5 pt-4 border-top">
                    <div class="d-flex gap-5">
                        <div>
                            <div class="stat-num display-4 fw-black text-red">30+</div>
                            <div class="small text-secondary">menu pilihan</div>
                        </div>
                        <div>
                            <div class="stat-num display-4 fw-black text-red">4.9</div>
                            <div class="small text-secondary">rating google</div>
                        </div>
                        <div>
                            <div class="stat-num display-4 fw-black text-red">2k+</div>
                            <div class="small text-secondary">pelanggan / bulan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisi Kanan: CAROUSEL GAMBAR -->
            <div class="col-lg-6 position-relative">
                <div id="carouselCoffee" class="carousel slide h-100" data-bs-ride="carousel">
                    <!-- Indikator (opsional) -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselCoffee" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#carouselCoffee" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#carouselCoffee" data-bs-slide-to="2"></button>
                    </div>

                    <!-- Slide Gambar -->
                    <div class="carousel-inner rounded-4 shadow-lg" style="height: 500px; overflow: hidden;">
                        <div class="carousel-item active">
                            <img src="<?= base_url('assets/images/coffee1.jpg') ?>" 
                                 class="d-block w-100 h-100 object-fit-cover" 
                                 alt="Kopi 1">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/images/coffee2.jpg') ?>" 
                                 class="d-block w-100 h-100 object-fit-cover" 
                                 alt="Kopi 2">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('assets/images/coffee3.jpg') ?>" 
                                 class="d-block w-100 h-100 object-fit-cover" 
                                 alt="Kopi 3">
                        </div>
                    </div>

                    <!-- Tombol Navigasi -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCoffee" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselCoffee" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
