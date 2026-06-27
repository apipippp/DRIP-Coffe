<div class="container py-5">
    <div class="page-title mb-5">
        <h1 class="display-1 fw-black">KASIR<br>DASHBOARD<span class="text-red">*</span></h1>
    </div>
    
    <!-- Nav Tabs untuk Dashboard Kasir -->
    <div class="d-none d-md-flex gap-2 mb-4" id="kasirTab">
        <button class="kasir-tab <?= $active_tab == 'pending' ? 'active' : '' ?>" onclick="switchTab('pending', this)" type="button" style="border: 2px solid #1C1A17; border-radius: 4px; font-weight: bold; padding: 10px 24px; <?= $active_tab == 'pending' ? 'background: #1C1A17; color: white;' : 'background: white; color: #1C1A17;' ?> cursor: pointer;">Pesanan Baru</button>
        <button class="kasir-tab <?= $active_tab == 'processing' ? 'active' : '' ?>" onclick="switchTab('processing', this)" type="button" style="border: 2px solid #1C1A17; border-radius: 4px; font-weight: bold; padding: 10px 24px; <?= $active_tab == 'processing' ? 'background: #1C1A17; color: white;' : 'background: white; color: #1C1A17;' ?> cursor: pointer;">Pesanan Diproses</button>
        <button class="kasir-tab <?= $active_tab == 'completed' ? 'active' : '' ?>" onclick="switchTab('completed', this)" type="button" style="border: 2px solid #1C1A17; border-radius: 4px; font-weight: bold; padding: 10px 24px; <?= $active_tab == 'completed' ? 'background: #1C1A17; color: white;' : 'background: white; color: #1C1A17;' ?> cursor: pointer;">Pesanan Selesai</button>
        <button class="kasir-tab <?= $active_tab == 'revenue' ? 'active' : '' ?>" onclick="switchTab('revenue', this)" type="button" style="border: 2px solid #1C1A17; border-radius: 4px; font-weight: bold; padding: 10px 24px; <?= $active_tab == 'revenue' ? 'background: #1C1A17; color: white;' : 'background: white; color: #1C1A17;' ?> cursor: pointer;">Rekap Pendapatan</button>
    </div>

    <div class="kasir-mobile-nav d-flex d-md-none justify-content-around align-items-center fixed-bottom bg-cream border-top py-2">
        <button class="kasir-mobile-nav-link <?= $active_tab == 'pending' ? 'active' : '' ?>" onclick="switchMobileTab('pending', this)" type="button">
            <div class="fs-5"><i class="fa-solid fa-bell"></i></div>
            <span>baru</span>
        </button>
        <button class="kasir-mobile-nav-link <?= $active_tab == 'processing' ? 'active' : '' ?>" onclick="switchMobileTab('processing', this)" type="button">
            <div class="fs-5"><i class="fa-solid fa-mug-hot"></i></div>
            <span>diproses</span>
        </button>
        <button class="kasir-mobile-nav-link <?= $active_tab == 'completed' ? 'active' : '' ?>" onclick="switchMobileTab('completed', this)" type="button">
            <div class="fs-5"><i class="fa-solid fa-circle-check"></i></div>
            <span>selesai</span>
        </button>
        <button class="kasir-mobile-nav-link <?= $active_tab == 'revenue' ? 'active' : '' ?>" onclick="switchMobileTab('revenue', this)" type="button">
            <div class="fs-5"><i class="fa-solid fa-chart-line"></i></div>
            <span>rekap</span>
        </button>
    </div>

    <div id="kasirTabContent">
        <!-- Tab 1: Pesanan Baru (Pending / Proses) -->
        <div class="kasir-pane" id="pending" style="display: <?= $active_tab == 'pending' ? 'block' : 'none' ?>;">
            <!-- Fitur Filter / Pencarian Sederhana -->
            <div class="row mb-4">
                <div class="col-md-5">
                    <div class="input-group" style="border: 2px solid var(--dark); border-radius: 4px; overflow: hidden;">
                        <span class="input-group-text bg-white border-0"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" id="searchInput" class="form-control border-0" placeholder="Cari ID atau No. Antrean..." onkeyup="filterOrders()">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-3">Daftar Pesanan Masuk</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="border: 2px solid var(--dark); background: white;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="p-3">No. Antrean</th>
                                    <th class="p-3">Order ID</th>
                                    <th class="p-3">Meja</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">
                            <?php foreach($orders as $order): ?>
                                <tr class="order-row">
                                    <td data-label="No. Antrean" class="queue-num fw-bold text-danger p-3"><?= $order['queue_number'] ?></td>
                                    <td data-label="Order ID" class="order-id p-3 fw-bold"><?= $order['id'] ?></td>
                                    <td data-label="Meja" class="p-3">Meja <?= $order['table_number'] ?></td>
                                    <td data-label="Total" class="p-3 fw-bold">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td data-label="Status" class="p-3">
                                        <span class="badge bg-warning text-dark border border-dark px-3 py-2" style="border-radius: 4px; font-weight: bold;"><?= strtoupper($order['status']) ?></span>
                                    </td>
                                    <td data-label="Aksi" class="p-3 text-center">
                                        <div class="btn-group gap-2">
                                            <a href="<?= site_url('kasir/order_detail/'.$order['id']) ?>" target="_blank" class="btn btn-dark btn-sm text-white" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Detail</a>
                                            <a href="<?= site_url('kasir/print_struk/'.$order['id']) ?>" target="_blank" class="btn btn-outline-dark btn-sm" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Print</a>
                                            <a href="<?= site_url('kasir/proses/'.$order['id']) ?>" class="btn btn-sm btn-warning text-dark" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Acc</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Pesanan Diproses -->
        <div class="kasir-pane" id="processing" style="display: <?= $active_tab == 'processing' ? 'block' : 'none' ?>;">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-3">Pesanan Sedang Diproses</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="border: 2px solid var(--dark); background: white;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="p-3">No. Antrean</th>
                                    <th class="p-3">Order ID</th>
                                    <th class="p-3">Meja</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($processing_orders as $order): ?>
                                <tr class="order-row">
                                    <td data-label="No. Antrean" class="queue-num fw-bold text-primary p-3"><?= $order['queue_number'] ?></td>
                                    <td data-label="Order ID" class="order-id p-3 fw-bold"><?= $order['id'] ?></td>
                                    <td data-label="Meja" class="p-3">Meja <?= $order['table_number'] ?></td>
                                    <td data-label="Total" class="p-3 fw-bold">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td data-label="Status" class="p-3">
                                        <span class="badge bg-info text-dark border border-dark px-3 py-2" style="border-radius: 4px; font-weight: bold;">DIPROSES</span>
                                    </td>
                                    <td data-label="Aksi" class="p-3 text-center">
                                        <div class="btn-group gap-2">
                                            <a href="<?= site_url('kasir/order_detail/'.$order['id']) ?>" target="_blank" class="btn btn-dark btn-sm text-white" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Detail</a>
                                            <a href="<?= site_url('kasir/print_struk/'.$order['id']) ?>" target="_blank" class="btn btn-outline-dark btn-sm" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Print</a>
                                            <a href="<?= site_url('kasir/bayar/'.$order['id']) ?>" class="btn btn-sm btn-success" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Selesai</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 3: Pesanan Selesai -->
        <div class="kasir-pane" id="completed" style="display: <?= $active_tab == 'completed' ? 'block' : 'none' ?>;">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-3">Rekap Pesanan Selesai (Completed)</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="border: 2px solid var(--dark); background: white;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="p-3">No. Antrean</th>
                                    <th class="p-3">Order ID</th>
                                    <th class="p-3">Meja</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3">Metode Bayar</th>
                                    <th class="p-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($completed_orders as $order): ?>
                                <tr>
                                    <td data-label="No. Antrean" class="fw-bold text-success p-3"><?= $order['queue_number'] ?></td>
                                    <td data-label="Order ID" class="p-3 fw-bold"><?= $order['id'] ?></td>
                                    <td data-label="Meja" class="p-3">Meja <?= $order['table_number'] ?></td>
                                    <td data-label="Total" class="p-3 fw-bold">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td data-label="Metode Bayar" class="p-3 text-uppercase"><?= $order['payment_method'] ?></td>
                                    <td data-label="Status" class="p-3">
                                        <span class="badge bg-success text-white border border-dark px-3 py-2" style="border-radius: 4px; font-weight: bold;">SELESAI</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 4: Rekap Pendapatan Harian -->
        <div class="kasir-pane" id="revenue" style="display: <?= $active_tab == 'revenue' ? 'block' : 'none' ?>;">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <form method="GET" action="<?= site_url('kasir') ?>" class="d-flex flex-wrap gap-2 align-items-center">
                            <input type="hidden" name="tab" value="revenue">
                            <label class="fw-bold small">Dari:</label>
                            <input type="date" name="start_date" value="<?= $start_date ?>" class="form-control form-control-sm" style="border: 2px solid var(--dark); border-radius: 4px; max-width: 160px;">
                            <label class="fw-bold small">Sampai:</label>
                            <input type="date" name="end_date" value="<?= $end_date ?>" class="form-control form-control-sm" style="border: 2px solid var(--dark); border-radius: 4px; max-width: 160px;">
                            <button type="submit" class="btn btn-dark btn-sm text-white" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Filter</button>
                            <a href="<?= site_url('kasir?tab=revenue') ?>" class="btn btn-outline-dark btn-sm" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold mb-3">Rekap Pendapatan per Hari</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" style="border: 2px solid var(--dark); background: white;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="p-3">Tanggal</th>
                                    <th class="p-3">Jumlah Transaksi Selesai</th>
                                    <th class="p-3">Total Uang Masuk</th>
                                    <th class="p-3 text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($daily_revenue as $day): ?>
                                <tr>
                                    <td data-label="Tanggal" class="p-3 fw-bold"><?= date('d F Y', strtotime($day['date'])) ?></td>
                                    <td data-label="Transaksi" class="p-3"><?= $day['total_orders'] ?> Transaksi</td>
                                    <td data-label="Pemasukan" class="p-3 fw-bold text-success">Rp <?= number_format($day['revenue'], 0, ',', '.') ?></td>
                                    <td data-label="Detail" class="p-3 text-center">
                                        <a href="<?= site_url('kasir/revenue_detail/'.$day['date']) ?>" target="_blank" class="btn btn-dark btn-sm text-white" style="border: 2px solid var(--dark); border-radius: 4px; font-weight: bold;">Detail</a>
                                    </td>
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

<script>
function filterOrders() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var rows = document.getElementsByClassName("order-row");
    
    for (var i = 0; i < rows.length; i++) {
        var queue = rows[i].getElementsByClassName("queue-num")[0].innerText.toUpperCase();
        var id = rows[i].getElementsByClassName("order-id")[0].innerText.toUpperCase();
        
        if (queue.indexOf(input) > -1 || id.indexOf(input) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

function switchTab(tabId, btn) {
    var buttons = document.querySelectorAll('.kasir-tab');
    buttons.forEach(function(b) {
        b.style.background = 'white';
        b.style.color = '#1C1A17';
        b.classList.remove('active');
    });
    btn.style.background = '#1C1A17';
    btn.style.color = 'white';
    btn.classList.add('active');

    var panes = document.querySelectorAll('.kasir-pane');
    panes.forEach(function(p) {
        p.style.display = 'none';
    });
    document.getElementById(tabId).style.display = 'block';
}

function switchMobileTab(tabId, btn) {
    document.querySelectorAll('.kasir-mobile-nav-link').forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');

    var desktopBtn = document.querySelector('.kasir-tab[onclick*="' + tabId + '"]');
    if (desktopBtn) {
        switchTab(tabId, desktopBtn);
    } else {
        document.querySelectorAll('.kasir-pane').forEach(function(p) {
            p.style.display = 'none';
        });
        document.getElementById(tabId).style.display = 'block';
    }
}
</script>
