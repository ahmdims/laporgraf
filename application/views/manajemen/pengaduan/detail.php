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
                            <a href="<?= site_url('manajemen/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('manajemen/pengaduan'); ?>" class="text-muted text-hover-primary">Data
                                Pengaduan</a>
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
                                            <?php if (!empty($pengaduan->tempat)): ?>
                                                <div class="me-9 my-1 d-flex align-items-center">
                                                    <i class="ki-outline ki-geolocation text-primary fs-2 me-2"></i>
                                                    <span class="fw-bold text-gray-500">
                                                        <?= htmlspecialchars($pengaduan->tempat); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
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
                                    <h3 class="text-gray-900 mb-5">Tanggapan</h3>
                                    <div class="separator separator-dashed mb-9"></div>
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
                                                <?php if (!$kepuasan_diberikan): ?>
                                                    <div class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                            Aksi
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                        </a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a href="<?= site_url('manajemen/pengaduan/edit_tanggapan/' . $balas->id_balasan); ?>"
                                                                    class="menu-link px-3">
                                                                    Ubah
                                                                </a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a href="<?= site_url('manajemen/pengaduan/hapus_tanggapan/' . $balas->id_balasan); ?>"
                                                                    class="menu-link px-3 btn-hapus-tanggapan"
                                                                    data-id="<?= $balas->id_balasan; ?>"
                                                                    data-url="<?= site_url('manajemen/pengaduan/hapus_tanggapan/' . $balas->id_balasan); ?>">
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="fs-5 fw-semibold text-gray-600 mb-7">
                                                <p><?= nl2br(htmlspecialchars($balas->isi_balasan)); ?></p>
                                            </div>

                                            <?php if (isset($balas->kepuasan) && $balas->kepuasan): ?>
                                                <div class="border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                                    <h5 class="text-success fw-bold mb-2">Feedback dari Pelapor:</h5>
                                                    <div class="rating mb-2">
                                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                                            <div
                                                                class="rating-label me-2 <?= ($i < $balas->kepuasan->rating) ? 'checked' : ''; ?>">
                                                                <i class="ki-outline ki-star fs-2"></i>
                                                            </div>
                                                        <?php endfor; ?>
                                                        <span
                                                            class="fw-bold fs-6 ms-2">(<?= $balas->kepuasan->rating; ?>/5)</span>
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

                        <?php if (!$sudah_ditanggapi): ?>
                            <div class="border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                <div class="fs-6 w-100">
                                    <h5 class="text-primary mb-5">Beri Tanggapan untuk Pengaduan Ini:</h5>
                                    <?= form_open('manajemen/pengaduan/beri_tanggapan/' . $pengaduan->id_pengaduan, ['class' => 'w-100']); ?>
                                    <input type="hidden" name="id_kategori" value="<?= $pengaduan->id_kategori; ?>">
                                    <div class="mb-5">
                                        <label class="form-label fw-semibold">Isi Tanggapan</label>
                                        <textarea name="isi_balasan" class="form-control form-control w-100" rows="4"
                                            placeholder="Tulis tanggapan Anda..." required></textarea>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fw-semibold">Ubah Status</label>
                                        <div class="col-12">
                                            <select name="id_status" class="form-select form-select w-100"
                                                data-control="select2" data-hide-search="true" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <?php foreach ($status_list as $status): ?>
                                                    <option value="<?= $status->id_status; ?>">
                                                        #<?= $status->id_status; ?> <?= htmlspecialchars($status->status); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-start">
                            <a href="<?= site_url('manajemen/pengaduan'); ?>" class="btn btn-light me-3">
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