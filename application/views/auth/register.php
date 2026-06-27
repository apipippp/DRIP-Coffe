<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DRIP*</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
<div class="container" style="max-width: 400px; padding: 15px;">
    <div class="card shadow">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="mb-0">DRIP<span class="text-red">*</span> Register</h3>
        </div>
        <div class="card-body">
            <?php if(validation_errors()): ?>
                <div class="alert alert-danger"><?= validation_errors() ?></div>
            <?php endif; ?>
            <form action="<?= site_url('auth/do_register') ?>" method="post">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="user">User Biasa</option>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark w-100">Register</button>
            </form>
            <p class="mt-3 text-center mb-1"><a href="<?= site_url('auth/login') ?>">Sudah punya akun? Login</a></p>
            <p class="text-center mb-0"><a href="<?= site_url('/') ?>" class="text-secondary small">← Kembali ke Halaman Utama</a></p>
        </div>
    </div>
</div>
</body>
</html>
