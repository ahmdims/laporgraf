<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Detail Pengaduan
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('admin/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('admin/pengaduan'); ?>" class="text-muted text-hover-primary">
                                Data Laporan
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Detail Pengaduan</li>
                    </ul>
                </div>
            </div>
        </div>

        <?php $this->load->view('templates/flasher'); ?>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-15">
                        <div class="d-flex flex-column flex-xl-row">
                            <div class="flex-lg-row-fluid">
                                <div class="mb-17">
                                    <div class="mb-8">
                                        <div class="d-flex flex-wrap mb-6">
                                            <?php $this->load->helper('iddate'); ?>
                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-calendar-8 text-primary fs-2 me-2"></i>
                                                <span class="fw-bold text-gray-500">
                                                    <?= IdDate($pengaduan->date); ?>
                                                </span>
                                            </div>
                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-briefcase text-primary fs-2 me-2"></i>
                                                <span class="fw-bold text-gray-500">
                                                    <?= htmlspecialchars($pengaduan->nama_kategori); ?>
                                                </span>
                                            </div>
                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-geolocation text-primary fs-2 me-2"></i>
                                                <span class="fw-bold text-gray-500">
                                                    <?= htmlspecialchars($pengaduan->tempat); ?>
                                                </span>
                                            </div>
                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-profile-user text-primary fs-2 me-2"></i>
                                                <span class="fw-bold text-gray-500">
                                                    <?= htmlspecialchars($pengaduan->nama_pelapor); ?>
                                                </span>
                                            </div>
                                            <div class="my-1 d-flex align-items-center ms-auto">
                                                <?php if (count($balasan_list) > 0): ?>
                                                    <span class="badge badge-light-success py-3 px-4 fs-7">Sudah
                                                        Ditanggapi</span>
                                                <?php else: ?>
                                                    <span class="badge badge-light-danger py-3 px-4 fs-7">Menunggu
                                                        Tanggapan</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <h2 class="text-gray-900 fs-2 fw-bold">
                                            <?= htmlspecialchars($pengaduan->judul); ?>
                                        </h2>
                                    </div>
                                    <div class="fs-5 fw-semibold text-gray-600">
                                        <p class="mb-8">
                                            <?= nl2br(htmlspecialchars($pengaduan->deskripsi)); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-17">
                                    <h3 class="text-gray-900 mb-5">Tanggapan dari Manajemen</h3>
                                    <div class="separator separator-dashed mb-9"></div>

                                    <?php if (empty($balasan_list)): ?>
                                        <p class="text-center text-gray-500 fs-6">Belum ada tanggapan untuk pengaduan ini.
                                        </p>
                                    <?php endif; ?>
                                    <?php foreach ($balasan_list as $balas): ?>
                                        <div class="mb-10">
                                            <div class="d-flex align-items-center mb-4 justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-light-<?= $balas->status == 'Selesai' ? 'success' : 'primary'; ?> me-4 py-3 px-4 fs-7">
                                                        <?= htmlspecialchars($balas->status); ?>
                                                    </span>
                                                    <span class="fs-7 text-muted">
                                                        Dibalas pada: <?= IdDate($balas->date ?? time()); ?>
                                                    </span>
                                                </div>
                                                <?php
                                                $kepuasan_diberikan = isset($balas->sudah_diberi_kepuasan) && $balas->sudah_diberi_kepuasan;
                                                ?>
                                                <!-- Tidak ada tombol edit/hapus di admin -->
                                            </div>
                                            <div class="fs-5 fw-semibold text-gray-600 mb-7">
                                                <p><?= nl2br(htmlspecialchars($balas->isi_balasan)); ?></p>
                                            </div>

                                            <?php if (isset($balas->kepuasan) && $balas->kepuasan): ?>
                                                <div class="border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                                    <h5 class="text-success fw-bold mb-2">Feedback dari Pelapor:</h5>
                                                    <div class="rating mb-2">
                                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                                            <div class="rating-label me-2">
                                                                <?php if ($i < $balas->kepuasan->rating): ?>
                                                                    <i class="ki-solid ki-star fs-2 text-warning"></i>
                                                                <?php else: ?>
                                                                    <i class="ki-outline ki-star fs-2"></i>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endfor; ?>
                                                    </div>
                                                    <p class="fs-6 text-gray-700 mb-0"><strong>Komentar:</strong>
                                                        <?= htmlspecialchars($balas->kepuasan->komentar); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>


                        <div class="d-flex justify-content-start">
                            <a href="<?= site_url('admin/pengaduan'); ?>" class="btn btn-light me-3">
                                <i class="ki-outline ki-arrow-left"></i>
                                Kembali ke Daftar Pengaduan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-hapus-tanggapan').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var url = btn.getAttribute('data-url');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus tanggapan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger fw-bold',
                        cancelButton: 'btn btn-secondary fw-bold'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>