<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIP* — Good Coffee Vibes</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400&family=DM+Mono:ital,wght@0,300;0,400;1,300&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <script>
        const SITE_URL = "<?= site_url() ?>";
        const ASSET_URL = "<?= base_url('assets') ?>";
    </script>
</head>

<body>

    <!-- HEADER MOBILE (Hanya Tampil di Mobile) -->
    <div class="d-flex d-lg-none justify-content-between align-items-center bg-cream px-3 py-2 border-bottom sticky-top" style="z-index: 1020;">
        <div class="nav-logo" style="cursor:pointer;" onclick="location.href='<?= site_url() ?>'">DRIP<span>*</span></div>
        <div>
            <?php if ($this->session->userdata('user_id')): ?>
                <div class="d-flex align-items-center gap-2">
                    <a href="<?= site_url('dashboard') ?>" class="btn btn-dark btn-sm rounded" style="font-size: 10px;">
                        <i class="fa-solid fa-user"></i> Member
                    </a>
                    <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm" style="font-size: 10px;">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-dark btn-sm rounded" style="font-size: 10px; border-width: 1px;">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- TICKER -->
    <div class="ticker">
        <div class="ticker-inner" id="tickerInner">
            <span class="ticker-item">DRIP* COFFEE - PURWOKERTO</span>
            <span class="ticker-item">OPEN 07:00-22:00</span>
            <span class="ticker-item">SEMUA DIPILIH DENGAN SERIUS</span>
            <span class="ticker-item">V60 · POUR OVER · ESPRESSO</span>
            <span class="ticker-item">DRIP* COFFEE - PURWOKERTO</span>
            <span class="ticker-item">OPEN 07:00-22:00</span>
            <span class="ticker-item">SEMUA DIPILIH DENGAN SERIUS</span>
            <span class="ticker-item">V60 · POUR OVER · ESPRESSO</span>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top bg-cream border-bottom d-none d-lg-block">
        <div class="container-fluid px-4">
            <div class="nav-logo" style="cursor:pointer;" onclick="showPage('home')">DRIP<span>*</span></div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= site_url() ?>">home</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'menu' ? 'active' : '' ?>" href="<?= site_url('menu') ?>">menu</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'antrian' ? 'active' : '' ?>" href="<?= site_url('antrian') ?>">antrian</a></li>
                    <li class="nav-item"><a class="nav-link <?= $this->uri->segment(1) == 'riwayat' ? 'active' : '' ?>" href="<?= site_url('riwayat') ?>">riwayat</a></li>
                </ul>
                
                <div class="d-none d-lg-flex align-items-center">
                    <div class="cart-bubble ms-3" onclick="toggleCart()">
                        <i class="fa-solid fa-cart-shopping"></i> keranjang
                        <span class="count" id="cartCount">0</span>
                    </div>
                </div>

                <?php if ($this->session->userdata('user_id')): ?>
                    <div class="d-flex align-items-center gap-2 ms-lg-3 mt-2 mt-lg-0">
                        <a href="<?= site_url('dashboard') ?>" class="btn btn-dark btn-sm d-flex align-items-center gap-2 w-100 justify-content-center">
                            <i class="fa-solid fa-user"></i> <?= htmlspecialchars($this->session->userdata('name')) ?>
                        </a>
                        <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm" title="Logout">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="mt-2 mt-lg-0 w-100-mobile">
                        <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-dark ms-lg-3 btn-sm d-flex align-items-center gap-2 w-100 justify-content-center">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Page Container -->
    <div class="page-container">
