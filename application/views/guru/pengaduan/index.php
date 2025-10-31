<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Histori Laporan
                    </h1>
                    <?php $this->load->helper('iddate'); ?>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('guru/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Data Laporan</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="<?= site_url('guru/pengaduan/create'); ?>" class="btn btn-sm fw-bold btn-primary">
                        <i class="ki-outline ki-plus fs-2"></i>Buat Laporan
                    </a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <?php if (empty($pengaduan_list)): ?>
                    <div class="card border-0 h-md-100" data-bs-theme="light"
                        style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                        <div class="card-body">
                            <div class="row align-items-center h-100">
                                <div class="col-7 ps-xl-13">
                                    <div class="text-white mb-6">
                                        <span class="fs-2qx fw-bold">Sampaikan Pengaduanmu di LaporGraf</span>
                                    </div>
                                    <span class="fw-semibold text-white fs-6 mb-8 d-block opacity-75">
                                        Suaramu penting. Laporkan masalah atau keluhanmu sekarang, agar bisa segera
                                        ditindaklanjuti.
                                    </span>
                                    <div class="d-flex flex-column flex-sm-row d-grid gap-2">
                                        <a href="<?= site_url('guru/pengaduan/create'); ?>"
                                            class="btn btn-light-primary me-lg-2">
                                            Buat Laporan
                                        </a>
                                        <a href="#" class="btn btn-outline-info text-white">
                                            Cara Kerja LaporGraf
                                        </a>
                                    </div>
                                </div>
                                <div class="col-5 pt-10">
                                    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px"
                                        style="background-image:url('<?= base_url('asset/media/svg/illustrations/easy/2.svg'); ?>')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                    <input type="text" data-kt-ecommerce-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Cari Pengaduan" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_report_customer_orders_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">No</th>
                                        <th class="min-w-100px">Judul</th>
                                        <th class="min-w-100px">Kategori</th>
                                        <th class="min-w-100px">Tanggal Lapor</th>
                                        <th class="min-w-100px">Status</th>
                                        <th class="text-end min-w-100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <?php $no = 1; ?>
                                    <?php foreach ($pengaduan_list as $pengaduan): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($pengaduan->judul); ?></td>
                                            <td><?= htmlspecialchars($pengaduan->nama_kategori); ?></td>
                                            <td><?= IdDate($pengaduan->date); ?></td>
                                            <td>
                                                <?php if ($pengaduan->jumlah_balasan > 0): ?>
                                                    <span class="badge badge-light-success">Sudah Ditanggapi</span>
                                                <?php else: ?>
                                                    <span class="badge badge-light-danger">Menunggu Tanggapan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Aksi
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i> </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="<?= site_url('guru/pengaduan/detail/' . $pengaduan->id_pengaduan); ?>"
                                                            class="menu-link px-3">
                                                            Detail
                                                        </a>

                                                        <?php if ($pengaduan->jumlah_balasan == 0): ?>
                                                            <a href="<?= site_url('guru/pengaduan/edit/' . $pengaduan->id_pengaduan); ?>"
                                                                class="menu-link px-3">
                                                                Edit
                                                            </a>
                                                            <a href="<?= site_url('guru/pengaduan/delete/' . $pengaduan->id_pengaduan); ?>"
                                                                class="menu-link px-3 btn-hapus">
                                                                Hapus
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>