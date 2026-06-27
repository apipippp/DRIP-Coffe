<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Dashboard - DRIP*</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;900&family=DM+Mono&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-cream">
<nav class="navbar navbar-expand-lg bg-cream border-bottom py-3 kasir-navbar">
    <div class="container-fluid px-4">
        <div class="nav-logo" style="cursor:pointer;" onclick="location.href='<?= site_url('kasir') ?>'">DRIP<span>*</span> <small class="text-secondary" style="font-size: 12px; font-weight: normal; letter-spacing: 0.5px;">KASIR</small></div>
        <div class="d-flex align-items-center gap-3">
            <span class="small text-secondary"><i class="fa-solid fa-cash-register"></i> <?= htmlspecialchars($this->session->userdata('name')) ?></span>
            <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm" style="font-size: 11px; border-radius: 4px; border-width: 2px; font-weight: bold;">Logout</a>
        </div>
    </div>
</nav>
